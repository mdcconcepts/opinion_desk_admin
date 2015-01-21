<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message')); ?>:</b>
	<?php echo CHtml::encode($data->message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message_to')); ?>:</b>
	<?php echo CHtml::encode($data->message_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message_from')); ?>:</b>
	<?php echo CHtml::encode($data->message_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_broadcast')); ?>:</b>
	<?php echo CHtml::encode($data->is_broadcast); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('read_status')); ?>:</b>
	<?php echo CHtml::encode($data->read_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('priority')); ?>:</b>
	<?php echo CHtml::encode($data->priority); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('schedule_timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->schedule_timestamp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	*/ ?>

</div>