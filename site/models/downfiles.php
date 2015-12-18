<?php
defined('_JEXEC') or die();

class DownfilesModelDownfiles extends JModelList{
    
    protected function getListQuery() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true); 
        
       $query->select('`id`, `filename`, `file_desc`');
       $query->from('#__downfiles');
       $query->where('published = "1"');
        
       return $query;
    }
    
}

