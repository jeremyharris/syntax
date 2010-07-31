<?php
/**
 * Includes
 */
App::import('Core', 'Folder');

/**
 * Syntax Settings Controller
 *
 * @package	   syntax
 * @subpackage syntax.controllers
 * @author	   Jeremy Harris <jeremy@42pixels.com>
 * @license	   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link	   http://42pixels.com
 */
class SyntaxSettingsController extends SyntaxAppController {

	 var $uses = array('Setting');

/**
 * Settings index
 */
	function admin_index() {
		$Folder = new Folder();
		$Folder->cd(APP.'plugins'.DS.'syntax'.DS.'webroot'.DS.'css');
		$cssFiles = $Folder->find();
		$themes = array();
		foreach ($cssFiles as &$file) {
			$themeName = preg_replace('/sh(Core|Theme)/', '', array_shift(explode('.', $file)));
			$syntaxThemes[$themeName] = Inflector::humanize($themeName);
		}
		$syntaxThemes = Set::filter($syntaxThemes);

		$this->set('title_for_layout', __('SyntaxHighlighter Settings', true));

		if(!empty($this->data)) {
			if ($this->Setting->saveAll($this->data['Setting'])) {
				$this->Session->setFlash(__('Settings for updated successfully', true));
			}
		}

		$settings = $this->Setting->find('all', array(
			 'conditions' => array(
				  'Setting.key LIKE "%Syntax.%"',
				  'Setting.key NOT LIKE "%Syntax.language-%"'
			)
		));
		$languages = $this->Setting->find('all', array('conditions' => 'Setting.key LIKE "%Syntax.language-%"'));

		$this->set(compact('settings', 'syntaxThemes', 'languages'));

		if(count($settings) == 0) {
			$this->Setting->setFlash(__('Invalid Setting key', true));
		}

	 }

}
?>