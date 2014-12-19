<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'responce-master-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	// 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'option_value',array('class'=>'span5')); ?>
<?php echo $form->textFieldRow($model,'responce_text',array('class'=>'span5','maxlength'=>200)); ?>
<?php echo $form->textFieldRow($model,'responce_audio_url',array('class'=>'span5','maxlength'=>45)); ?>
<?php echo $form->textFieldRow($model,'responce_vedio_url',array('class'=>'span5','maxlength'=>45)); ?>
<?php echo $form->textFieldRow($model,'created_at',array('class'=>'span5')); ?>
<?php echo $form->textFieldRow($model,'question_id',array('class'=>'span5')); ?>
<?php echo $form->textFieldRow($model,'client_id',array('class'=>'span5')); ?>


<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
