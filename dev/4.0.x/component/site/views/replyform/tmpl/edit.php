<?php
/**
 * @package      Projectfork
 *
 * @author       Tobias Kuhn (eaxs)
 * @copyright    Copyright (C) 2006-2012 Tobias Kuhn. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();


JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.calendar');
JHtml::_('behavior.formvalidation');


// Create shortcut to parameters.
$params = $this->state->get('params');

// This checks if the editor config options have ever been saved. If they haven't they will fall back to the original settings.
$editoroptions = isset($params->show_publishing_options);
if (!$editoroptions) $params->show_urls_images_frontend = '0';
?>
<script type="text/javascript">
    Joomla.submitbutton = function(task) {
        if (task == 'replyform.cancel' || task == 'replyform.setProject' || document.formvalidator.isValid(document.id('adminForm'))) {
            <?php echo $this->form->getField('description')->save(); ?>
            Joomla.submitform(task);
        } else {
            alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
        }
    }
</script>
<div class="edit item-page<?php echo $this->pageclass_sfx; ?>">
<?php if ($params->get('show_page_heading', 0)) : ?>
<h1>
    <?php echo $this->escape($params->get('page_heading')); ?>
</h1>
<?php endif; ?>

<form action="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-inline">
    <fieldset>
        <div class="formelm-buttons btn-toolbar">
            <button class="btn btn-primary" type="button" onclick="Joomla.submitbutton('replyform.save')">
                <?php echo JText::_('JSAVE') ?>
            </button>
            <button class="btn" type="button" onclick="Joomla.submitbutton('replyform.cancel')">
                <?php echo JText::_('JCANCEL') ?>
            </button>
        </div>
        <div class="formelm control-group">
            <div class="control-label">
                <?php echo $this->form->getLabel('description'); ?>
            </div>
            <div class="controls">
                <?php echo $this->form->getInput('description'); ?>
            </div>
        </div>
    </fieldset>

    <?php echo JHtml::_('tabs.start', 'replyform', array('useCookie' => 'true')) ;?>
    <?php echo JHtml::_('tabs.panel', 'Publishing', 'reply-publishing') ;?>
    <fieldset>
        <div class="formelm control-group">
            <div class="control-label">
                <?php echo $this->form->getLabel('state'); ?>
            </div>
            <div class="controls">
                <?php echo $this->form->getInput('state'); ?>
            </div>
        </div>
        <?php if ($this->item->modified_by) : ?>
            <div class="formelm control-group">
                <div class="control-label">
                    <?php echo $this->form->getLabel('modified_by'); ?>
                </div>
                <div class="controls">
                    <?php echo $this->form->getInput('modified_by'); ?>
                </div>
            </div>
            <div class="formelm control-group">
                <div class="control-label">
                    <?php echo $this->form->getLabel('modified'); ?>
                </div>
                <div class="controls">
                    <?php echo $this->form->getInput('modified'); ?>
                </div>
            </div>
        <?php endif; ?>
    </fieldset>

    <?php echo JHtml::_('tabs.panel', 'Permissions', 'reply-permissions') ;?>
    <fieldset>
        <div class="formelm control-group">
            <div class="control-label">
                <?php echo $this->form->getLabel('access'); ?>
            </div>
            <div class="controls">
                <?php echo $this->form->getInput('access'); ?>
            </div>
        </div>
        <div class="formelm control-group" id="jform_access_exist-li">
            <label id="jform_access_exist-lbl" class="hasTip" title="<?php echo JText::_('COM_PROJECTFORK_FIELD_EXISTING_ACCESS_GROUPS_DESC');?>">
                <?php echo JText::_('COM_PROJECTFORK_FIELD_EXISTING_ACCESS_GROUPS_LABEL');?>
            </label>
        </div>
        <div class="formelm control-group" id="jform_access_groups-li">
            <div id="jform_access_groups controls">
                <div class="clr"></div>
                <?php echo $this->form->getInput('rules'); ?>
            </div>
        </div>
    </fieldset>

    <?php echo JHtml::_('tabs.panel', 'Options', 'reply-options') ;?>
        <?php $fieldSets = $this->form->getFieldsets('attribs'); ?>
            <?php foreach ($fieldSets as $name => $fieldSet) : ?>
                <fieldset>
                    <?php foreach ($this->form->getFieldset($name) as $field) : ?>
                        <div class="formelm control-group" id="jform_access-li">
                            <div class="control-label">
                                <?php echo $field->label; ?>
                            </div>
                            <div class="controls">
                                <?php echo $field->input; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </fieldset>
            <?php endforeach; ?>
    <?php echo JHtml::_('tabs.end') ;?>

    <?php
        echo $this->form->getInput('project_id');
        echo $this->form->getInput('topic_id');
        echo $this->form->getInput('created');
        echo $this->form->getInput('id');
    ?>
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="return" value="<?php echo $this->return_page;?>" />
    <?php echo JHtml::_( 'form.token' ); ?>
</form>
</div>
