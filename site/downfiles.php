<?php 
defined('_JEXEC') or die();

$controller = JControllerLegacy::getInstance('downfiles');

$input = JFactory::getApplication()->input;

$controller->execute($input->get('task','display'));

$controller->redirect();

?>