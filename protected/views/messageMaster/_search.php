<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

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
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
