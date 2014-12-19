<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'customer-custom-field-assignment-table-form',
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

<?php
$list = CHtml::listData(CustomerCustomField::model()->findAllByAttributes(array('lob_id' => '1', 'is_reference_field' => '0')), 'id', 'field_name');
echo $form->dropDownList($model, 'customer_custom_field_id', $list);
?>
<input style="display:none" class="span5" value="<?php echo Yii::app()->user->id; ?>" name="CustomerCustomFieldAssignmentTable[user_id]" id="CustomerCustomFieldAssignmentTable_user_id" type="text">


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
