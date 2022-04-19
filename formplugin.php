<?php
/**
 * @package     Joomla.Plugin
 *
 */

defined('_JEXEC') or die;

use Joomla\CMS\Form\Form;
use Joomla\CMS\Form\FormHelper;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Database\ParameterType;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;

/**
 * A Plugin to Add Custom Form Fields In BackEnd Article View And Display The Form Field Values Below The Article In The FrontEnd
 *
 */
class PlgContentformplugin extends CMSPlugin {

    /**
     * @var    \Joomla\Database\DatabaseDriver
     *
     */
    protected $db;

    /**
     * Loading The Language File On Instantiation.
     *
     * @var    boolean
     *
     */
    protected $autoloadLanguage = true;

    /**
     * Runs On Content Preparation
     *
     * @param   string  $context  The Context For The Data
     * @param   object  $data     An Object Containing The Data For The Form.
     *
     * @return  boolean
     *
     */
    public function onContentPrepareData($context, $data) {
        if (!in_array($context, ['com_content.article'])) { // Checking If a Valid Form Is Being Manipulated
            return true;
        }

        if (is_object($data)) {
            $articleID = $data->id ?? 0;
            if (!isset($data->formplugin) && $articleID > 0) { // Checking If The Form Already Has Some Data
                $db = $this->db; // Loading The Table Data From The Database
                $query = $db->getQuery(true)
                    ->select('*')
                    ->from($db->quoteName('#__customform'))
                    ->where('articleID = ' . $articleID);
                $db->setQuery($query);
                $results = $db->loadAssoc();
                $data->formplugin = []; // Inserting Existing Data Into Form Fields
                if (is_array($results) || is_object($results)) {
                    foreach ($results as $k => $v) {
                        $data->formplugin[$k] = $v;
                    }
                }
                else {
                    $data->formplugin = []; // Inserting Article ID (As It Is A Hidden Field)
                    $data->formplugin['articleID'] = $articleID;
                }
            }
            else { 
                $data->formplugin = []; // Inserting Article ID (As It Is A Hidden Field)
                $data->formplugin['articleID'] = $articleID;
            }
        }

        return true;
    }

    /**
     * Adds Custom Form Fields In BackEnd Article View
     *
     * @param   Form   $form  The Form To Be Altered.
     * @param   mixed  $data  The Associated Data For The Form.
     *
     * @return  boolean
     *
     */
    public function onContentPrepareForm(Form $form, $data) {
        $name = $form->getName(); // Checking If a Valid Form Is Being Manipulated

        if (!in_array($name, ['com_content.article'])) {
            return true;
        }

        // Loading The Form Fields
        FormHelper::addFormPath(__DIR__ . '/forms');
        $form->loadFile('formplugin');

        return true;
    }

    /**
     * Saves Form Field Data In The Database
     *
     * @param   string   $context    Context Of The Content Being Passed
     * @param   mixed	 $article    Reference To The JTableContent Object That Is Being Saved
     * @param   boolean  $isNew  	 Set To True If The Content Is About To Be Created
     * @param	mixed	 $data		 The Data To Be Saved
     *
     * @return  boolean
     *
     */
    public function onContentBeforeSave($context, &$article, $isNew, $data) {
        if (isset($data['formplugin']) && count($data['formplugin'])) { // Checking If $data Has The Form Data
            $db = $this->db;

            if (!$isNew) { // Deleting The Existing Row To Add Updated Data
                $res = $db->getQuery(true)
                    ->delete($db->quoteName('#__customform'))
                    ->where('articleID = ' . $article->id);
                $db->setQuery($res);
                $result = $db->execute();
            }

            // Creating Object To Insert Data Into The Database
            $query = new stdClass();
            foreach ($data['formplugin'] as $k => $v) {
                $query->$k = $v;
            }

            $result = $db->insertObject('#__customform', $query);
        }

        return true;
    }

    /**
     * Displays The Form Field Values Below The Article In The FrontEnd
     *
     * @param   string   $context    Context Of The Content Being Passed
     * @param   mixed	 $article    Article That Is Being Rendered By The View
     * @param   mixed  	 $params  	 JRegistry Object Of Merged Article And Menu Item Params
     * @param	int 	 $limitstart Integer That Determines The "page" Of The Content That Is To Be Generated
     *
     * @return  string
     *
     */
    public function onContentAfterDisplay($context, &$article, &$params, &$limitstart) {
        if (!in_array($context, ['com_content.article', 'com_content.category', 'com_content.categories'])) return; // Checking If a Valid Form Is Being Manipulated

        $articleID = $article->id;
        $db = $this->db;
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__customform'))
            ->where('articleID = ' . $articleID);
        $db->setQuery($query);
        // Storing Output Result In The Form Of An Associative Array
        $results = $db->loadAssoc();
        if (is_array($results) || is_object($results)) {
            $str = '';
            foreach ($results as $k => $v) {
                if ($k != 'articleID') $str .= "<p>" . $k . " : " . $v . "</p>";
            }
            // Displaying The Custom Form Field Data
            return $str;
        }
    }

}