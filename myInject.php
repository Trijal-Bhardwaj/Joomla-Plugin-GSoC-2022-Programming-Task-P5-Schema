<?php
// Using System Plugin (onAfterRender,onBeforeCompileHead,onContntPrepare)
//To prevent accessing the document directly, enter this code:
// no direct access
defined('_JEXEC') or die('Access Deny');

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\Event;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class PlgSystemmyInject extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.6
	 */
	public function __construct()
	{
		// Define the minumum versions to be supported.
		$this->minimumJoomla = '3.9';
		$this->minimumPhp    = '7.2.5';
	}
	public function onBeforeCompileHead()
	{
		$app = JFactory::getApplication();
		$document = JFactory::getDocument();
		// $body = JResponse::getBody(); 													deprecated joomla 3.0
		$content = $app->getBody();
		//JResponse::setBody($body); 														deprecated
		$params = $app->getParams();
		$replacetext = $params->get('Inputarea');

		echo "<script type='text/javascript'>";
		echo " alert('$replacetext')";
		echo "</script>";

		if (preg_match_all('/(<h1.*?)(class *= *"|\')(.*)("|\')(.*>)/is', $content, $matches)) {

			$content = preg_replace(
				'/(<h1.*?)(class *= *"|\')(.*)("|\')(.*>)/is',
				'<h1>' . $replacetext . '</h1>',
				$content
			);
		} elseif (preg_match_all('/(<h1.*?)(.*>)/is', $content, $matches)) {
			$content = preg_replace(
				'/(<h1.*?)(.*>)/is',
				'<h1>' . $replacetext . '</h1>',
				$content
			);
		}

		JFactory::getApplication()->setBody($content);
	}
}
