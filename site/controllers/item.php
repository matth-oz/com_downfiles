<?php
 defined('_JEXEC') or die();
 jimport('joomla.filesystem.file');
 
 class DownfilesControllerItem extends JControllerLegacy{
     
    public function getModel($name='Item', $prefix='DownfilesModel', $config = array()){
        return parent::getModel($name, $prefix, $config);
    }
     
     public function getfile(){
         $file_id = JFactory::getApplication()->input->get('file_id');
         
         if(!empty($file_id)){
            $model = $this->getModel();
         
            // получаем имя файла по ID
            $file_name = $model->GetFilePathByID($file_id);
            $file_name = JPATH_SITE.'/'.$file_name;
            // если файл доступен
            if(JFile::exists($file_name)){
                // сохраняем в переменную $date дату происходит загрузка
                $date = date('Y-m-d H:i:s');
                // сохраняем в переменную $ip_addr IP-адрес посетителя
                $ip_addr = $_SERVER["REMOTE_ADDR"];
                // формируем header на основе расширения файла и отправляем заголовки
                $mime = mime_content_type($file_name);
                
				header('Content-Disposition: attachment; filename='.basename($file_name));
				header("Content-Length: " . filesize($file_name));
				header("Content-Type: application/force-download");				
				header("Content-Type: application/download");
				header('Content-Type: '.$mime.'; charset=utf-8');
				header("Pragma: no-cache");
				header("Expires: 0");
                
                
                // сохраняем в БД id файла, дату, IP-адрес            
                if(readfile($file_name)){
                   $res =  $model->saveDownloadStatInfo($file_id, $date, $ip_addr);
                }
                else{
                   JFactory::getApplication()->enqueueMessage(JText::_('COM_DOWNFILES_FILE_NOT_EXIST'), 'error');
                   $this->setRedirect(JRoute::_('index.php?option=com_downfiles'));
                }            
            }
            else{
                JFactory::getApplication()->enqueueMessage(JText::_('COM_DOWNFILES_FILE_NOT_EXIST'), 'error');
                $this->setRedirect(JRoute::_('index.php?option=com_downfiles'));
            }
         }
         else{
             JFactory::getApplication()->enqueueMessage(JText::_('COM_DOWNFILES_FILEID_NOT_SPECIFIED'), 'error');
             $this->setRedirect(JRoute::_('index.php?option=com_downfiles'));
         }         
     }
     
 }