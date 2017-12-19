<?php
defined('_JEXEC') or die();
$document = JFactory::getDocument();
$document->addScript('/administrator/components/com_downfiles/js/chk_module.js','text/javascript',true);
?>

<form action="index.php?option=com_downfiles&view=downfiles" method="POST" id="adminForm" name="adminForm">
    <table class="table table-stripped table-hover">
        <thead>
            <th width="1%"><?php echo JText::_("COM_DOWNFILES_ITEM_ID")?></th>
            <th width="1%"><?php echo JHtml::_("grid.checkall")?></th>
            <th width="1%"><?php echo JText::_("COM_DOWNFILES_ITEM_NAME")?></th>
            <th width="1%"><?php echo JText::_("COM_DOWNFILES_ITEM_STATE")?></th>
            <th width="1%"><?php echo JText::_("COM_DOWNFILES_ITEM_DESC")?></th>
			<th width="1%"><?php echo JText::_("COM_DOWNFILES_FILE_LINK_MODULE_VISIBILITY")?></th>
        </thead>
        <tbody>
            <?php if(!empty($this->items)):?>
                <?php foreach($this->items as $i=>$row):?>
                    <?php $link = 'index.php?option=com_downfiles&task=item.edit&id='.$row->id;?>
                   <tr>
                        <td align="center"><?php echo $row->id?></td>
                        <td><?php echo JHtml::_('grid.id', $i, $row->id)?></td>
                        <td><a href="<?php echo $link?>"><?php echo $row->filename?></a></td>                        
                        <td align="center"><?php echo JHtml::_('jgrid.published', $row->published, $i, 'downfiles.', true);?></td>
                        <td><?php echo $row->file_desc?></td>
						<td><button data-id="<?php echo $row->id?>" value="<?php echo $row->module_link?>" class="module-link"><?php if($row->module_link == 1){echo JText::_("COM_DOWNFILES_HIDE_LINK_FROM_MODULE");}else{echo JText::_("COM_DOWNFILES_SHOW_LINK_IN_MODULE");}?></button></td>
				   </tr>
                <?php endforeach;?>
            <?php endif;?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6"></td>
            </tr>  
        </tfoot>
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token');?>
    </table>
</form>