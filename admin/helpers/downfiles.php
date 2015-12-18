<?php
class DownfilesHelper{
    public static function getUplFilename($fieldName = 'jform', $default = null, $filter = 'array'){
        
        $fileInput = new JInput($_FILES);                
        $file = $fileInput->get($fieldName, $default, $filter); 
        return $file;  
        
    }
    
}
