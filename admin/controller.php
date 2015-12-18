<?php 
defined('_JEXEC') or die();

class DownfilesController extends JControllerLegacy{
    // переопределяем вид по-умолчанию "downfiles" - /administrator/components/com_downfiles/views/downfiles/
    protected $default_view = "downfiles";
    
    public function execute($task){
        if($task == "display"){
            $input = JFactory::getApplication()->input;
            
            $view = $input->get("view");
            $file_id = $input->get("file_id");
            
            if($view == "itemstat" && empty($file_id)){
                $this->setRedirect('index.php?option=com_downfiles&view=stats');
                return false;
            }            
        }        
        
        parent::execute($task);
    }
    
    
}
?>