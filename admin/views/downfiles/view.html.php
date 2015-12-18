<?php
defined('_JEXEC') or die();

class DownfilesViewDownfiles extends JViewLegacy{
    
    protected $items;
    protected $pagination;
    
    public function display($tpl = null){
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        
        $this->addToolBar();
        parent::display($tpl);
        
        $this->SetDocument();
    }
    
    public function addToolBar(){    
        JToolBarHelper::title(JText::_("COM_DOWNFILES_MANAGER_HEADER"));

        JToolBarHelper::addNew('item.add');

        JToolBarHelper::editList('item.edit');
        
        JToolBarHelper::deleteList('', 'downfiles.delete');
        
        JToolbarHelper::preferences('com_downfiles',550, 875, 'COM_DOWNFILES_PARAMETERS');
    }
    
    protected function SetDocument(){		
			$document = JFactory::getDocument();	
      $document->SetTitle(JText::_("COM_DOWNFILES_MANAGER_TITLE"));
	}
    
}
