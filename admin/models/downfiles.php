<?php
defined('_JEXEC') or die();

class DownfilesModelDownfiles extends JModelList {
    protected function getListQuery(){
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        
        //SELECT
        $query->select('`id`, `filename`, `file_desc`, `published`');
        
        //FROM
        $query->from('#__downfiles');
        
        return $query;
    }
}