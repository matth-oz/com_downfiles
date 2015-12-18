<?php
defined('_JEXEC') or exit();

class DownfilesModelItemstat extends JModelList{
    protected function getListQuery() {
        $fileID = JFactory::getApplication()->input->get('file_id');
        
        $db = JFactory::getDBO();
        $query = $db->getQuery(true); 
        
        $query->select('#__downfiles.id');
        $query->select('#__downfiles.filename');
        $query->select('#__downfiles.file_desc');
        $query->select('#__downfiles_stat.date');
        $query->select('#__downfiles_stat.ip_addr');
        $query->from('#__downfiles');
        $query->leftJoin('#__downfiles_stat ON #__downfiles.id = #__downfiles_stat.filename_id');
        $query->where('TO_DAYS(NOW()) - TO_DAYS(#__downfiles_stat.date) <= 30 AND #__downfiles_stat.filename_id = '.$fileID);
        
        return $query;
    }
}
