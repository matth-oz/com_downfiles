<?php
defined('_JEXEC') or exit();

class DownfilesTableItem extends JTable{
	public function __construct(&$db){
		parent::__construct('#__downfiles', 'id', $db);
	}
}
