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
			$extension = strtolower(substr(strrchr($_GET['file'],"."),1));
			$file_name = JPATH_SITE.'/'.$file_name;

            // если файл доступен
            if(JFile::exists($file_name)){

                // сохраняем в переменную $date дату происходит загрузка
                $date = date('Y-m-d H:i:s');
                // сохраняем в переменную $ip_addr IP-адрес посетителя
                $ip_addr = $_SERVER["REMOTE_ADDR"];
				
			  switch ($extension) {
				case "txt": $ctype="text/plain"; break;
				case "pdf": $ctype="application/pdf"; break;
				case "exe": $ctype="application/octet-stream"; break;
				case "zip": $ctype="application/zip"; break;
				case "doc": $ctype="application/msword"; break;
				case "xls": $ctype="application/vnd.ms-excel"; break;
				case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
				case "gif": $ctype="image/gif"; break;
				case "png": $ctype="image/png"; break;
				case "jpeg": $ctype="image/jpg"; break;
				case "jpg": $ctype="image/jpg"; break;
				default: $ctype="application/force-download";
			  }
			  
				header('Content-Type: '.$ctype.'; charset=utf-8');
				header('Content-Disposition: attachment; filename='.basename($file_name));

				ob_clean();
				$read_res = readfile($file_name);			
				
				// сохраняем в БД id файла, дату, IP-адрес
                if($read_res !== false){
                   $res =  $model->saveDownloadStatInfo($file_id, $date, $ip_addr);
                }
                else{
                   JFactory::getApplication()->enqueueMessage(JText::_('COM_DOWNFILES_FILE_NOT_EXIST'), 'error');
                   $this->setRedirect(JRoute::_('index.php?option=com_downfiles'));
                } 
				exit();				
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