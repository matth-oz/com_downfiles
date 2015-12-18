<?php
 defined('_JEXEC') or die();

 class DownfilesControllerItem extends JControllerLegacy{
     
    public function getModel($name='Item', $prefix='DownfilesModel', $config = array()){
        return parent::getModel($name, $prefix, $config);
    }
     
     public function getfile(){
         $file_id = JFactory::getApplication()->input->get('file_id');
         $model = $this->getModel();
         
         // получаем имя файла по ID
         $file_name = $model->GetFilePathByID($file_id);
         
         // если файл доступен
         // сохраняем в переменную $date дату происходит загрузка
         // сохраняем в переменную $ip_addr IP-адрес посетителя
         // формируем header на основе расширения файла и отправляем заголовки
         // сохраняем в БД id файла, дату, IP-адрес
                  
         echo $file_name;
     }
     
 }