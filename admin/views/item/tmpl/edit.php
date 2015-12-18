<?php
  defined('_JEXEC') or die();
	JHtml::_('formbehavior.chosen', 'select');
	JHtml::_('behavior.formvalidation'); //JHtmlBehavior

$document = JFactory::getDocument();
$document->addStyleDeclaration('.fileInpWrap{display:none;}');
$document->addScriptDeclaration("jQuery(document).ready(function(){jQuery('#showFileInput').click(function(e){jQuery('.fileInpWrap').css('display','block');e.preventDefault();})});");
?>
<form enctype="multipart/form-data" action="index.php?option=com_downfiles&layout=edit&id=<?php echo $this->item->id?>" method="POST" id="adminForm" name="adminForm" class="form-validate">
    <div class="form-horizontal">
       	<?php foreach($this->form->getFieldsets() as $name => $fieldset):?>
            <fieldset class="adminform">
                <legend><?php echo JText::_($fieldset->label)?></legend>
                <div class="row-fluid">
                    <div class="span6">
                        <?php foreach($this->form->getFieldset() as $field):?>
                        <div class="control-group">
                            <div class="control-label" style="width:auto; max-width:100%;"><?php echo $field->label?></div>
                            <div class="controls">
                                <?php if($field->type == "File" && strlen($field->value) > 0):?>
                                <span style="font-weight: bold;"><?php echo $field->value?></span>&nbsp;<a href="#" id="showFileInput">Заменить?</a>
                                <div class="fileInpWrap">
                                    <?php echo $field->input?>
                                </div>                                    
                                <?php else:?>
                                    <?php echo $field->input?>
                                <?php endif;?>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </fieldset>
        <?php endforeach;?>
    </div>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_("form.token");?>
</form>



