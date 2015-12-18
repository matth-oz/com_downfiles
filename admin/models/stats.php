<?php

defined('_JEXEC') or exit();

class DownfilesModelStats extends JModelList{
    protected function getListQuery(){
        $per = JFactory::getApplication()->input->get('per');
        
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);      
        
        $query->select('#__downfiles.id');
        $query->select('#__downfiles.filename');
        $query->select('#__downfiles.file_desc');
        $query->select('count(#__downfiles_stat.id) AS DwnQuant');
        $query->from('#__downfiles');
        $query->leftJoin('#__downfiles_stat ON #__downfiles.id = #__downfiles_stat.filename_id');
        if(!empty($per)){
           switch($per){
               case '1':
                 $query->where('TO_DAYS(NOW()) - TO_DAYS(#__downfiles_stat.date) <= 30');  
               break;
               case '6':
                 $query->where('TO_DAYS(NOW()) - TO_DAYS(#__downfiles_stat.date) <= 180');
               case '12':
                 $query->where('TO_DAYS(NOW()) - TO_DAYS(#__downfiles_stat.date) <= 365');                     
           }           
        }
        $query->group('#__downfiles.filename');
        
        return $query;
    }
}