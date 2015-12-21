<?php
class DownfilesHelper{
    public static function getUplFilename($fieldName = 'jform', $default = null, $filter = 'array'){
        
        $fileInput = new JInput($_FILES);                
        $file = $fileInput->get($fieldName, $default, $filter); 
        return $file;  
        
    }
    
    public static function convertFileSize($fsize){
      if($fsize > 1048576){
          $cfsize = round($fsize/1048576, 2).' '.JText::_('COM_DOWNFILES_SIZE_MB');		
        }
        elseif($fsize > 1024){
          $cfsize = round($fsize/1024, 2).' '.JText::_('COM_DOWNFILES_SIZE_KB');
        }
        else{
          $cfsize = $fsize.' '.JText::_('COM_DOWNFILES_SIZE_BYTES');			
        }
      return $cfsize;
    }
    
}
