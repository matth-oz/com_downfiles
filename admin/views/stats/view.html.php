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
  
  protected function getStatInfo(){
      $db = JFactory::getDBO();
      $query = $db->getQuery(true);
      
      $query->select('#__downfiles.filename');
      $query->select('count(#__downfiles_stat.id) AS DwnQuant');
      $query->from('#__downfiles');
      $query->leftJoin('#__downfiles_stat ON #__downfiles.id = #__downfiles_stat.filename_id');
      $query->where('TO_DAYS(NOW()) - TO_DAYS(#__downfiles_stat.date) <= 30');
      $query->group('#__downfiles.filename');
      
      echo $query;
      
  }
  
}

