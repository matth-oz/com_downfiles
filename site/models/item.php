<?php
defined('_JEXEC') or die();

class DownfilesModelItem extends JModelLegacy{
    public function GetFilePathByID($id=null){
        if($id == null){
            return false;
        }
        else{
           $db = JFactory::getDbo();
           $q = "SELECT `filename` FROM #__downfiles WHERE id = ".(int)$id;
           $res = $db->setQuery($q);                
           $data_row = $res->loadAssoc();
           return $data_row["filename"];          
        }
    }
}