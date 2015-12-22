<?php
defined('_JEXEC') or die();
$document = JFactory::getDocument();
$document->addStyleSheet('/components/com_downfiles/css/downfiles.css');
?>

<?php if(!empty($this->items)):?>
<ul class="downfiles-list">
    <?php foreach($this->items as $item):?>
    <?php $ext = substr(strrchr($item->filename, '.'), 1);?>
    <li>
        <a href="index.php?option=com_downfiles&task=item.getfile&file_id=<?php echo $item->id?>"><?php echo $item->file_desc?></a> (<?php echo $ext.", ".$item->file_size;?>)
    </li> 
    <?php endforeach;?>
<?php endif;?>
</ul>

