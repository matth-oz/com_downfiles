<?php
defined('_JEXEC') or exit();

$document = JFactory::getDocument();
$document->addStylesheet('/administrator/components/com_downfiles/js/jquery.fancybox.css');
$document->addScript('/administrator/components/com_downfiles/js/jquery.fancybox.pack.js','text/javascript',true);
$document->addScript('http://api-maps.yandex.ru/2.1/?lang=ru_RU','text/javascript',true);
$document->addScript('/administrator/components/com_downfiles/js/getip.js','text/javascript',true);
$qd = count($this->itemstat);
?>
<?php if($qd > 0):?>
<table class="table table-stripped">
    <thead>
        <th><?php echo JText::_('COM_DOWNFILES_ITEM_NAME');?></th>        
        <th><?php echo JText::_('COM_DOWNFILES_ITEM_DESC');?></th>
        <th><?php echo JText::_('COM_DOWNFILES_ITEM_DATE');?></th>
        <th><?php echo JText::_('COM_DOWNFILES_ITEM_IP');?></th>
    </thead>
    <tbody>
        <?foreach($this->itemstat as $i => $row):?>
        <tr>
            <?php if($qd > 1):?>
                <?php if($i == 0):?>
                    <td rowspan="<?php echo $qd;?>"><?php echo $row->filename?></td>
                    <td rowspan="<?php echo $qd;?>"><?php echo $row->file_desc?></td>
                <?php endif;?>            
            <?php else:?>
            <td><?php echo $row->filename?></td>
            <td><?php echo $row->file_desc?></td>
            <?php endif;?>
            <td><?php echo $row->date?></td>
            <td>
                <?php if(strpos($row->ip_addr, ":") === false):?>
                    <a href="#" class="get-ipplace"><?php echo $row->ip_addr;?></a>
                <?php else:?>
                    <?php echo $row->ip_addr?></td>
                <?php endif;?>
        </tr>
        <?endforeach;?>
    </tbody>
    <tfoot>
        
    </tfoot>
    
</table>
<div id="ipinfo_full"></div>
<?php endif;?>

