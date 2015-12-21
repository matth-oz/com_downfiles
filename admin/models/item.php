<?php
//use Joomla\Registry\Registry;
jimport('joomla.filesystem.file');
defined('_JEXEC') or die();

class DownfilesModelItem extends JModelAdmin{
    public function getForm($data = array(), $loadData = true){
        $form = $this->loadForm(
                'com.downfiles.item',
                'item',
                array(
                    'control' => 'jform',
                    'load_data' => $loadData,
                    )
                );
        
        if(empty($form)){
            return false;
        }
        
        return $form;
    }
    
    public function getItem($pk = null){
        $item = parent::getItem($pk);
        if($item){
            /*$registry = new Registry();
            $registry->loadString($item->filename);
            $item->filename = $registry->toArray();*/
            return $item;
        }
        return false;
    }
    
    protected function loadFormData(){
        $data = $this->getItem();		
        return $data;
    }
    
    protected function prepareTable($table){
         $session = JSession::getInstance();
         $fname = $session->get('FNAME_DB');
         $fsize = $session->get('FSIZE_DB');
         if(!empty($fname)){
             $table->filename = $fname;
             $table->file_size = $fsize; 
         }
    }
    
    public function getTable($type = 'Item', $prefix = 'DownfilesTable', $config = array()){
      // возвращает объект JTable с параметрами нужной таблицы
      return JTable::getInstance($type, $prefix, $config);
    }
}

