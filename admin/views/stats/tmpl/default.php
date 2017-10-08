<?php
defined('_JEXEC') or die();?>
<?php $per = JFactory::getApplication()->input->get('per');?>
<div>
    <?php echo JText::_('COM_DOWNFILES_SHOW_STATFILTER_TITLE');?>
    <?php if($per == 1):?>
    <span style="font-weight:bold;"><?php echo JText::_('COM_DOWNFILES_STATFILTER_MONTH_1')?></span>
    <?else:?>
    <?php echo JHtml::link(JRoute::_('index.php?option=com_downfiles&view=stats&per=1'),JText::_('COM_DOWNFILES_STATFILTER_MONTH_1'));?>
    <?php endif;?>
    <?php if($per == 6):?>
    <span style="font-weight:bold;"><?php echo JText::_('COM_DOWNFILES_STATFILTER_MONTH_6')?></span>
    <?else:?>
    <?php echo JHtml::link(JRoute::_('index.php?option=com_downfiles&view=stats&per=6'),JText::_('COM_DOWNFILES_STATFILTER_MONTH_6'));?>
    <?php endif;?>
    <?php if($per == 12):?>
    <span style="font-weight:bold;"><?php echo JText::_('COM_DOWNFILES_STATFILTER_MONTH_12')?></span>
    <?else:?>
    <?php echo JHtml::link(JRoute::_('index.php?option=com_downfiles&view=stats&per=12'),JText::_('COM_DOWNFILES_STATFILTER_MONTH_12'));?>
    <?php endif;?>
    <?if(isset($per)):?>
        <?php echo JHtml::link(JRoute::_('index.php?option=com_downfiles&view=stats'),JText::_('COM_DOWNFILES_STATFILTER_NON'));?>    
    <?php endif;?>
</div>
<?if(count($this->statInfo) > 0):?>
<table class="table table-stripped table-hover">
    <thead>
        <th><?php echo JText::_('COM_DOWNFILES_ITEM_ID')?></th>
        <th><?php echo JText::_('COM_DOWNFILES_ITEM_NAME')?></th>
        <th><?php echo JText::_('COM_DOWNFILES_ITEM_DESC')?></th>
        <th><?php echo JText::_('COM_DOWNFILES_ITEM_TOTAL')?></th>
    </thead>
    <tbody>
        <?foreach($this->statInfo as $row):?>
        <tr>
            <td><?php echo $row->id?></td>
            <td><?php echo JHtml::link('index.php?option=com_downfiles&view=itemstat&file_id='.$row->id, $row->filename);?></td>
            <td><?php echo $row->file_desc?></td>
            <td><?php echo $row->DwnQuant?></td>
        </tr>
        <?endforeach?>
    </tbody>
    <tfoot>
        
    </tfoot>    
</table>
<?php else:?>
    <div><?php echo JText::_('COM_DOWNFILES_EMPTY_STATISTIC')?></div>
<?php endif;?>
