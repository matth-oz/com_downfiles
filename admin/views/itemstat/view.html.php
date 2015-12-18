<?php
defined('_JEXEC') or exit();

class DownfilesViewItemstat extends JViewLegacy{
    protected $itemstat;
    protected $pagination;
    
    public function display($tpl = null){
        
        $this->pagination = $this->get('Pagination');
        
        $this->itemstat = $this->get('Items');
        
        $this->addToolBar();
        parent::display($tpl);
        $this->SetDocument();
    }
    
    public function addToolBar(){    
       JToolBarHelper::title(JText::_("COM_DOWNFILES_ITEMSTAT_TITLE"));   
    }
    protected function SetDocument(){		
       $document = JFactory::getDocument();	
       $document->SetTitle(JText::_("COM_DOWNFILES_ITEMSTAT_TITLE"));
    }
}

