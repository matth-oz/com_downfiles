<?php
defined('_JEXEC') or die();

class DownfilesViewDownfiles extends JViewLegacy{
    
    protected $items;
    protected $pagination;
    
    public function display($tpl=null){
        
        $this->items = $this->get('Items');
                        
        $this->pagination = $this->get('Pagination');
        
        parent::display($tpl);
    }
}