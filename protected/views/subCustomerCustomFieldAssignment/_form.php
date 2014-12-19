<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'sub-customer-custom-field-assignment-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        // 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
        ));
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'value', array('class' => 'span5', 'maxlength' => 45)); ?>
<?php // echo $form->textFieldRow($model, 'customer_custom_field_assignment_id', array('class' => 'span5')); ?>
<input style="display:none" class="span5" value="<?php echo $pId; ?>" name="SubCustomerCustomFieldAssignment[customer_custom_field_assignment_id]" id="SubCustomerCustomFieldAssignment_customer_custom_field_assignment_id" type="text">


<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
