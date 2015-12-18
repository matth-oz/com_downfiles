<?php
defined('_JEXEC') or die();

class DownfilesViewItem extends JViewLegacy{
   protected $form;
   protected $item;
    
   public function display($tpl = null){
       
       $this->form = $this->get("Form"); //DownfilesModelItem::getForm()
       
       $this->item = $this->get("Item"); // DownfilesModelItem::getItem()
       
       $itemID  = JFactory::getApplication()->input->get('id');
       
       if(!empty($itemID)){
            //записываем в сессию имя текущего файла           
            $session = JSession::getInstance();
            $session->set("CUR_FILENAME", $this->item->filename);           
       }
       
       $this->addToolBar();
       
       parent::display($tpl);
       
       $this->setDocument();
   }
   
   protected function addToolBar(){
       JToolbarHelper::title(JText::_("COM_DOWNFILES_MANAGER_NEW")); 
       
       JToolbarHelper::save('item.save');
       
       JToolBarHelper::cancel('item.cancel');
       
       //JToolbarHelper::preferences('com_downfiles',550, 875, 'COM_DOWNFILES_PARAMETERS');
   }
   
   protected function setDocument(){
       $document = JFactory::getDocument();
       $document->setTitle(JText::_("COM_DOWNFILES_MANAGER_TITLE"));
   }
   
   
}
