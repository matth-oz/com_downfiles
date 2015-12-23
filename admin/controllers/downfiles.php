<?php
defined('_JEXEC') or exit();

class DownfilesControllerDownFiles extends JControllerAdmin{
        
    public function getModel($name='Item', $prefix='DownfilesModel', $config = array()){
        return parent::getModel($name, $prefix, $config);
    }
      
    
    public function delete(){
        
        /*
         * получаем имя файла из записи по ID
         * удаляем файл
         * выполняем родительский метод
         */
        
        $cid = JFactory::getApplication()->input->get('cid', array(), 'array');
        if(is_array($cid) && count($cid)>0){
            $arFilesToDelete = array();
            
            foreach($cid as $id){
                $db = JFactory::getDBO();            
                $q = "SELECT `id`, `filename` FROM #__downfiles WHERE id = $id";
                $res = $db->setQuery($q);                
                $data_row = $res->loadAssoc();                
                $arFilesToDelete[] = $data_row["filename"];
            }
                jimport('joomla.filesystem.file');
                foreach($arFilesToDelete as $fname){
                    JFile::delete(JPATH_ROOT.'/'.$fname);                    
                }
        }
        else{
           JLog::add(JText::_($this->text_prefix . '_NO_ITEM_SELECTED'), JLog::WARNING, 'jerror');
        }
        parent::delete();
    }
    
    public function getipinfo(){
         $ip = JFactory::getApplication()->input->get('ip');
         if(!empty($ip)){
            header('Content-type: text/plain; charset=utf8');
            require_once(JPATH_COMPONENT.'/geo/SxGeo.php');
            $SxGeo = new SxGeo(JPATH_COMPONENT.'/geo/SxGeoCity.dat');
            $info = $SxGeo->get(trim($ip));
    
            echo json_encode($info['city']);
            die();
         }
         else{
            return false; 
         }
    }
}
