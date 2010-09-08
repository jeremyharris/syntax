<?php
/**
 * Syntax Activator
 *
 * @package	   syntax
 * @subpackage syntax.config
 * @author	   Jeremy Harris <jeremy@42pixels.com>
 * @license	   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link			http://42pixels.com
 */
class SyntaxActivation extends Object {

/**
 * Languages offered
 * 
 * @var array
 */
	 var $syntaxLanguages = array(
		 'AS3' => 'ActionScript3',
		 'Bash' => 'Bash/shell',
		 'ColdFusion' => 'ColdFusion',
		 'Sharp' => 'C#',
		 'Cpp' => 'C++',
		 'Css' => 'CSS',
		 'Delphi' => 'Delphi',
		 'Diff' => 'Diff',
		 'Erlang' => 'Erlang',
		 'Groovy' => 'Groovy',
		 'JScript' => 'JavaScript',
		 'Java' => 'Java',
		 'JavaFX' => 'JavaFX',
		 'Perl' => 'Perl',
		 'Php' => 'PHP',
		 'Plain' => 'Plain Text',
		 'PowerShell' => 'PowerShell',
		 'Python' => 'Python',
		 'Ruby' => 'Ruby',
		 'Scala' => 'Scala',
		 'Sql' => 'SQL',
		 'Vb' => 'Visual Basic',
		 'Xml' => 'XML'
	);

/**
 * onActivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
    public function beforeActivation(&$controller) {
        return true;
    }

/**
 * Called after activating the hook in ExtensionsHooksController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    public function onActivation(&$controller) {
		$settings = array(
			array(
				'key' => 'Syntax.theme',
				'value' => 'default',
				'title' => 'Syntax theme',
				'input_type' => 'select',
				'editable' => 0
			),
			array(
				'key' => 'Syntax.bloggerMode',
				'value' => true,
				'title' => 'Blogger integration',
				'input_type' => 'checkbox',
				'editable' => 0
			),
			array(
				'key' => 'Syntax.stripBrs',
				'value' => false,
				'title' => 'Strip Brs',
				'input_type' => 'checkbox',
				'editable' => 0
			),
			array(
				'key' => 'Syntax.tagName',
				'value' => 'pre',
				'title' => 'The HTML tag to replace',
				'input_type' => 'text',
				'editable' => 0
			),
			array(
				'key' => 'Syntax.autoLinks',
				'value' => true,
				'title' => 'Allows you to turn detection of links in the highlighted element on and off.',
				'input_type' => 'checkbox',
				'editable' => 0
			),
			array(
				'key' => 'Syntax.className',
				'value' => '',
				'title' => 'Allows you to add a custom class (or multiple classes) to every highlighter element that will be created on the page.',
				'input_type' => 'text',
				'editable' => 0
			),
			array(
				'key' => 'Syntax.collapse',
				'value' => false,
				'title' => 'Allows you to force highlighted elements on the page to be collapsed by default.',
				'input_type' => 'checkbox',
				'editable' => 0
			),
			array(
				'key' => 'Syntax.gutter',
				'value' => true,
				'title' => 'Allows you to turn gutter with line numbers on and off.',
				'input_type' => 'checkbox',
				'editable' => 0
			),
			array(
				'key' => 'Syntax.htmlScript',
				'value' => false,
				'title' => 'Allows you to highlight a mixture of HTML/XML code and a script which is very common in web development. ',
				'input_type' => 'checkbox',
				'editable' => 0
			),
			array(
				'key' => 'Syntax.smartTabs',
				'value' => true,
				'title' => 'Allows you to turn smart tabs feature on and off.',
				'input_type' => 'checkbox',
				'editable' => 0
			),
			array(
				'key' => 'Syntax.tabSize',
				'value' => 4,
				'title' => 'Allows you to adjust tab size.',
				'input_type' => 'text',
				'editable' => 0
			),
			array(
				'key' => 'Syntax.toolbar',
				'value' => true,
				'title' => 'Toggles toolbar on/off.',
				'input_type' => 'checkbox',
				'editable' => 0
			)
		);

		foreach ($this->syntaxLanguages as $language => $title) {
			$autoCheck = ($language == 'Php');
			$settings[] = array(
				 'key' => 'Syntax.language-'.$language,
				 'value' => $autoCheck,
				 'title' => $title,
				 'input_type' => 'checkbox'
			);
		}

		foreach ($settings as $setting) {
			$controller->Setting->create();
			$controller->Setting->save($setting);
		}

		$controller->Croogo->addPluginBootstrap('Syntax');
    }

/**
 * onDeactivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
    public function beforeDeactivation(&$controller) {
        return true;
    }

/**
 * Called after deactivating the hook in ExtensionsHooksController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    public function onDeactivation(&$controller) {
		$settings = $controller->Setting->find('all', array('conditions' => 'Setting.key LIKE "%Syntax.%"'));
		if (count($settings) > 0) {
			foreach($settings as $setting) {
				$controller->Setting->delete($setting['Setting']['id']);
			}
		}

		// Bootstrap: remove
		$controller->Croogo->removePluginBootstrap('Syntax');
    }

    
}
?>