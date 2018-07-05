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

        // получаем параметры компонента
        $params = JComponentHelper::getParams('com_downfiles');
        $ipGeoDataFld = $params->get('geodatafolder');

        $ip = JFactory::getApplication()->input->get('ip');
        if(!empty($ip)){
            $arCityInfo = Array();

            if(!empty($ipGeoDataFld)){
                header('Content-type: text/plain; charset=utf8');
                require_once JPATH_COMPONENT.'/helpers/SxGeo.php';
                $SxGeo = new SxGeo(JPATH_ROOT.'/'.$ipGeoDataFld.'/SxGeoCity.dat');

                $arCityData = $SxGeo->getCityFull($ip);

                if($arCityData['city']['id'] != 0){
                    $arCityInfo['country'] =  $arCityData['country']['name_ru'];
                    $arCityInfo['city'] =  $arCityData['city']['name_ru'];
                    $arCityInfo['lat'] = $arCityData['city']['lat'];
                    $arCityInfo['lon'] = $arCityData['city']['lon'];
                }
                else{
                    // не определено по IP
                    $arCityInfo['unknown_ip'] = JText::_('COM_DOWNFILES_GEO_NOT_DETERMINED');
                }
            }

            echo json_encode($arCityInfo);
            die();
        }
        else{
            return false;
        }
    }
	
	public function operateonlink(){
		$action = JFactory::getApplication()->input->get('action');
		$recId = JFactory::getApplication()->input->get('recId');
		if(!empty($action) && !empty($recId)){
			
			$module_link = ($action == 'enable_link') ? 1 : 0;
			$db = JFactory::getDBO(); 
			$q = "UPDATE #__downfiles SET `module_link`= $module_link WHERE id = $recId;";
			$db->setQuery($q);
			$res = $db->execute();
			
			$arRes = Array();
			$arRes['result'] = ($res === true) ? 'success' : 'failure';
						
			echo json_encode($arRes);
		}
		else{
			return false;
		}		
	}	
}
