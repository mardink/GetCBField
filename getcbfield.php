<?php
/**
 * Getcbfield plugin for Joomla! 1.7
 * Version: 2.0
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v2.0.
 * @by martijn Hiddink
 * @Copyright (C) 2011
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.plugin.plugin' );
class  plgContentGetcbfield extends JPlugin
{
public function __construct(& $subject, $config) {
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}
	function plgContentGetcbfield (& $subject) {
		parent::__construct($subject);
	}

public function onContentPrepare($context, &$article, &$params, $page = 0) 
{

//Get parameter
$field = $this->params->get('getfield', 'username');
//Get logged in userid
$user = &JFactory::getUser();
$userid = $user->id;
$db = &JFactory::getDBO();
$select1 = "SELECT $field FROM #__comprofiler where id=$userid;";
$select2 = "SELECT $field FROM #__users where id=$userid;";
//Select correct table
if ($field==name || $field==email || $field==lastvisitDate || $field==registerDate || $field==username || $field==params) {$select=$select2;} else {$select=$select1;}
$db->setQuery($select);
$fieldname = $db->loadresult();
//Determine logged in or Guest
	if ($userid==0) $name=JText::_( 'PLG_CONTENT_GETCBFIELD_GUEST' );
else $name=$fieldname;
$searchword = '/{getcbfield}/i';
$article->text =preg_replace("$searchword",$name,$article->text);
	return true;
}
}
?>