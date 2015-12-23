<?php
defined('_JEXEC') or die();

class DownfilesViewStats extends JViewLegacy{
    
    protected $statInfo;
    protected $pagination;
    
    public function display($tpl = null) {
        
       $this->statInfo = $this->get('Items'); 
        
       //$this->getStatInfo();
       $this->pagination = $this->get('Pagination'); 
       
        $this->addToolBar();
        parent::display($tpl);
        $this->setDocument();
    }
    
    
 public function addToolBar(){    
   JToolBarHelper::title(JText::_("COM_DOWNFILES_STATS_TITLE"));   
   }
  protected function SetDocument(){		
			$document = JFactory::getDocument();	
      $document->SetTitle(JText::_("COM_DOWNFILES_STATS_TITLE"));
	}  
}

