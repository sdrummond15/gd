<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_travel
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

$app = JFactory::getApplication();
$assoc = JLanguageAssociations::isEnabled();
?>
<script src="<?php echo JURI::base(); ?>components/com_travels/assets/js/jquery.maskMoney.js" type="text/javascript"></script>
<script src="<?php echo JURI::base(); ?>components/com_travels/assets/js/script.js" type="text/javascript"></script>
<script type="text/javascript">
    Joomla.submitbutton = function (task)
    {
        if (task == 'travel.cancel' || document.formvalidator.isValid(document.id('travel-form')))
        {
            Joomla.submitform(task, document.getElementById('travel-form'));
        }
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_travels&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="travel-form" class="form-validate">

    <?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>
    <div class="form-personalizado">
        <div class="form-horizontal">
            <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

            <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', empty($this->item->id) ? JText::_('COM_TRAVEL_NEW_TRAVEL', true) : JText::_('COM_TRAVEL_EDIT_TRAVEL', true)); ?>
            <div class="row-fluid">
                <div class="span9">
                    <div class="row-fluid form-horizontal-desktop">
                        <div class="span12">
                            <?php echo $this->form->renderField('destiny'); ?>
                            <?php echo $this->form->renderField('photo_featured'); ?>
                            <?php echo $this->form->renderField('photos'); ?>
                            <?php echo $this->form->renderField('descriptions'); ?>
                            <?php echo $this->form->renderField('date_out'); ?>
                            <?php echo $this->form->renderField('date_in'); ?>
                            <?php echo $this->form->renderField('price'); ?>
                            <?php echo $this->form->renderField('conditions'); ?>
                            <?php echo $this->form->renderField('included_in_package'); ?>
                            <?php echo $this->form->renderField('people'); ?>
                            <?php echo $this->form->renderField('children'); ?>
                            <?php echo $this->form->renderField('childrens'); ?>
                            <?php echo $this->form->renderField('hotel'); ?>
                            <?php echo $this->form->renderField('accommodations'); ?>
                            <?php echo $this->form->renderField('period'); ?>
                            <?php echo $this->form->renderField('rates'); ?>
                            <?php echo $this->form->renderField('external_link'); ?>
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
                </div>
            </div>
            <?php echo JHtml::_('bootstrap.endTab'); ?>



            <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('JGLOBAL_FIELDSET_PUBLISHING', true)); ?>
            <div class="row-fluid form-horizontal-desktop">
                <div class="span6">
                    <?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>
                </div>
                <div class="span6">
                    <?php echo JLayoutHelper::render('joomla.edit.metadata', $this); ?>
                </div>
            </div>
            <?php echo JHtml::_('bootstrap.endTab'); ?>

            <?php if ($assoc) : ?>
                <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'associations', JText::_('JGLOBAL_FIELDSET_ASSOCIATIONS', true)); ?>
                <?php echo $this->loadTemplate('associations'); ?>
                <?php echo JHtml::_('bootstrap.endTab'); ?>
            <?php endif; ?>

            <?php echo JHtml::_('bootstrap.endTabSet'); ?>
        </div>
    </div>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
</form>
