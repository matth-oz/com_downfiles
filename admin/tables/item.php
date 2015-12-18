<?php
defined('_JEXEC') or exit();
jimport('joomla.filesystem.file');

class DownfilesTableItem extends JTable{
	public function __construct(&$db){
		parent::__construct('#__downfiles', 'id', $db);
	}
}
