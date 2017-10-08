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
			$arCityInfo = Array();

			header('Content-type: text/plain; charset=utf8');
			$xml_file = 'http://api.sypexgeo.net/xml/'.$ip;

			$xml_object = new DOMDocument();
			$xml_object->load($xml_file);

			$error_txt = $xml_object->getElementsByTagName('ip')->item(0)->getAttribute('error');

			if(!empty($error_txt)){
				$ip_num = $xml_object->getElementsByTagName('ip')->item(0)->getAttribute('num');
				$arCityInfo['limit_is_settled'] = $error_txt.' '.$ip_num;
			}

			if(!isset($arCityInfo['limit_is_settled'])){
				$country_id = $xml_object->getElementsByTagName('country')->item(0)->getElementsByTagName('id')->item(0)->nodeValue;

				if(!is_null($country_id)){
					$elem_country = $xml_object->getElementsByTagName('country')->item(0)->getElementsByTagName('name_ru');
					$elem_city = $xml_object->getElementsByTagName('city')->item(0)->getElementsByTagName('name_ru');
					$elem_lat = $xml_object->getElementsByTagName('city')->item(0)->getElementsByTagName('lat');
					$elem_lng = $xml_object->getElementsByTagName('city')->item(0)->getElementsByTagName('lon');

					$arCityInfo['country'] = $elem_country->item(0)->nodeValue;
					$arCityInfo['city'] = $elem_city->item(0)->nodeValue;
					$arCityInfo['lat'] = $elem_lat ->item(0)->nodeValue;
					$arCityInfo['lon'] = $elem_lng->item(0)->nodeValue;

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
