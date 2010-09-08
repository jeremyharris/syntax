<?php
/**
 * Syntax helper
 *
 * @package	   syntax
 * @subpackage syntax.views.helpers
 * @author	   Jeremy Harris <jeremy@42pixels.com>
 * @license	   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link			http://42pixels.com
 */
class SyntaxHelper extends AppHelper {

/**
 * Other helpers used by this helper
 *
 * @var array
 * @access public
 */
	 var $helpers = array(
		  'Html'
	 );

/**
 * Adds appropriate scripts to the layout and instantiates the highlighter
 */
	 function beforeRender() {
		$configs = array(
			'bloggerMode' => Configure::read('Syntax.bloggerMode'),
			'stripBrs' => Configure::read('Syntax.stripBrs'),
			'tagName' => Configure::read('Syntax.tagName')
		);
		$defaults = array(
			 'auto-links' => Configure::read('Syntax.autoLinks'),
			 'class-name' => Configure::read('Syntax.className'),
			 'collapse' => Configure::read('Syntax.collapse'),
			 'gutter' => Configure::read('Syntax.gutter'),
			 'html-script' => Configure::read('Syntax.htmlScript'),
			 'smart-tabs' => Configure::read('Syntax.smartTabs'),
			 'tab-size' => Configure::read('Syntax.tabSize'),
			 'toolbar' => Configure::read('Syntax.toolbar')
		);

		$this->Html->script('/syntax/js/shCore', array('inline' => false));
		$settings = Configure::read('Syntax');
		if (empty($settings)) {
			return;
		}
		foreach ($settings as $title => $value) {
			$lang = explode('-', $title);
			if (($lang[0] == 'language' && isset($lang[1])) && $value) {
				$this->Html->script('/syntax/js/shBrush'.$lang[1], array('inline' => false));
			}
		}
		$this->Html->css('/syntax/css/shCore', 'stylesheet', array('inline' => false));
		$this->Html->css('/syntax/css/shTheme'.ucfirst(Configure::read('Syntax.theme')), 'stylesheet', array('inline' => false));
		 
		$configStr = '';
		foreach ($configs as $config => $value) {
			$value = $this->_valueToJs($config, $value);
			$configStr .= "SyntaxHighlighter.config.$config = $value;\n";
		}
		
		$defaultStr = '';
		foreach ($defaults as $default => $value) {
			$value = $this->_valueToJs($default, $value);
			$defaultStr .= "SyntaxHighlighter.defaults['$default'] = $value;\n";
		}
		$this->Html->scriptBlock("
			".$configStr.";\n
			".$defaultStr.";\n
			SyntaxHighlighter.all();
			", array('inline' => false)
		);
	 }

/**
 * Converts a value to a js value
 *
 * @param string $key
 * @param string $value
 * @return string
 */
	function _valueToJs($key, $value) {		
		switch ($key) {
			case 'class-name':
			case 'tagName':
				return "'$value'";
			break;
			case 'bloggerMode':
			case 'stripBrs':
			case 'auto-links':
			case 'collapse':
			case 'gutter':
			case 'html-script':
			case 'smart-tabs';
			case 'toolbar':
				if ($value) {
					return 'true';
				} else {
					return 'false';
				}
			break;
			case 'tab-size':
				return $value;
			break;
		}
	}

}
?>