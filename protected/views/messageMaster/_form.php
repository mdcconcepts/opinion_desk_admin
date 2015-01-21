<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'message-master-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	// 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<?php echo $form->textAreaRow($model,'message',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<?php echo $form->textFieldRow($model,'message_to',array('class'=>'span5')); ?>
<?php echo $form->textFieldRow($model,'message_from',array('class'=>'span5')); ?>
<?php echo $form->textFieldRow($model,'is_broadcast',array('class'=>'span5')); ?>
<?php echo $form->textFieldRow($model,'read_status',array('class'=>'span5')); ?>
<?php echo $form->textFieldRow($model,'priority',array('class'=>'span5')); ?>
<?php echo $form->textFieldRow($model,'schedule_timestamp',array('class'=>'span5')); ?>
<?php echo $form->textFieldRow($model,'created_at',array('class'=>'span5')); ?>


<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
