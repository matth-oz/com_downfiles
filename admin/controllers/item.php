<?php
defined('_JEXEC') or die();

jimport('joomla.filesystem.file');

class DownfilesControllerItem extends JControllerForm{
    protected $view_list = "downfiles";
    
    public function save($key = null, $urlVar = null) {
            require_once JPATH_COMPONENT.'/helpers/downfiles.php';
            
            $session = JSession::getInstance();
            $session->clear('FNAME_DB');
            
            // получаем параметры компонента
            $params = JComponentHelper::getParams('com_downfiles');
            $targetFld = $params->get('trgfolder');
            $arAllowFiles = explode(',', $params->get('alwflstypes')); 
           
            // инфа о звгружаемом файле
            //$arrUplfile = $this->getUplFilename();
            $arrUplfile = DownfilesHelper::getUplFilename();
            $uplFilename = $targetFld .'/'.$arrUplfile['name']['filename'];
            
            $dest = JPATH_ROOT.'/'.$uplFilename;
            
            $data  = JFactory::getApplication()->input->post->get('jform', array(), 'array');
                       
            
            if(!empty($data["id"])){
                // редактирование                
                $sessFilename = $session->get("CUR_FILENAME");
                if($uplFilename == $sessFilename || JFile::exists($dest)){                   
                    $this->setError(JText::_('COM_DOWNFILES_ERR_FILE_EXISTS'));
                    $this->setMessage($this->getError(), 'error');
                    $this->setRedirect(JRoute::_('index.php?option=com_downfiles&task=item.edit&id=' . $data['id'], false));
                                
                    return false;
                } 
                else{
                    JFile::delete(JPATH_ROOT.'/'.$sessFilename);                     
                     // расширение загружаемого файла
                    $fext = substr(strrchr($uplFilename, '.'), 1);
                    if(in_array($fext, $arAllowFiles)){
                        $src = $arrUplfile['tmp_name']['filename'];  
                        //$dest = JPATH_ROOT.'/'.$uplFilename;
                        JFile::upload($src, $dest);
                        $session->set('FNAME_DB', $uplFilename);
                    }
                    else{                       
                        $this->setError(JText::_('COM_DOWNFILES_ERR_FILE_FORMAT'));
                        $this->setMessage($this->getError(), 'error');
                        $this->setRedirect(JRoute::_('index.php?option=com_downfiles&task=item.edit&id=' . $data['id'], false));
                        return false;
                    }
                }
            }
            else{
                // добавление
                //$dest = JPATH_ROOT.'/'.$uplFilename;
                if(JFile::exists($dest)){                    
                    // файл существует
                    $this->setError(JText::_('COM_DOWNFILES_ERR_FILE_EXISTS'));
                    $this->setMessage($this->getError(), 'error');
                    $this->setRedirect(JRoute::_('index.php?option=com_downfiles&task=item.add', false));
                    return false;
                }
                else{
                    // файл не существует
                    $fext = substr(strrchr($uplFilename, '.'), 1);
                    if(in_array($fext, $arAllowFiles)){
                        $src = $arrUplfile['tmp_name']['filename'];  
                        //$dest = JPATH_ROOT.'/'.$uplFilename;
                        JFile::upload($src, $dest);
                        $session->set('FNAME_DB', $uplFilename);
                    }
                    else{
                        $this->setError(JText::_('COM_DOWNFILES_ERR_FILE_FORMAT'));
                        $this->setMessage($this->getError(), 'error');
                        $this->setRedirect(JRoute::_('index.php?option=com_downfiles&task=item.add', false));
                        return false;
                    }
                }
            }
        parent::save($key, $urlVar);
    }
   
    /*protected function getUplFilename(){
        $fileInput = new JInput($_FILES);                
        $file = $fileInput->get('jform', null, 'array'); 
        return $file;
    }*/
    
}