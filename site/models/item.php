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
    
    public function saveDownloadStatInfo($file_id, $date, $ip){

        $db = JFactory::getDbo();

        $file_id = intval($file_id);
	    $date = JFactory::getDate($date)->toSQL();

        $q = "INSERT INTO `#__downfiles_stat`(`filename_id`, `date`, `ip_addr`) VALUES ('".$file_id."', '".$date."', '".$ip."')";
        
        $res = $db->setQuery($q)->execute();
        
        return $res;
    }
    
  
    
}