<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'tablet-master-form',
    'htmlOptions' => array(
        'class' => 'form-horizontal row-border',
    ),
// Please note: When you enable ajax validation, make sure the corresponding
// controller action is handling ajax validation correctly.
// There is a call to performAjaxValidation() commented in generated controller code.
// See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        // 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
        ));
?>
<style>
    .tokenize-sample { width: 600px;}
</style>
<div class="porlets-content">
    <div class="alert alert-info"> 

        <?php
        $this->widget('bootstrap.widgets.TbAlert', array(
            'block' => false, // display a larger alert block?
            'fade' => true, // use transitions?
            'closeText' => '&times;', // close link text - if set to false, no close link is displayed
            'alerts' => array(// configurations per alert type
                'success' => array('block' => true, 'fade' => true, 'closeText' => '&times;', 'class' => 'alert alert-danger'), //success, info, warning, error or danger
                'info' => array('block' => true, 'fade' => true, 'closeText' => '&times;', 'class' => 'alert alert-danger'), //success, info, warning, error or danger
                'warning' => array('block' => true, 'fade' => true, 'closeText' => '&times;', 'class' => 'alert alert-danger'), //success, info, warning, error or danger
                'error' => array('block' => true, 'fade' => true, 'closeText' => '&times;', 'class' => 'alert alert-danger'), //success, info, warning, error or danger
                'danger' => array('block' => true, 'fade' => true, 'closeText' => '&times;', 'class' => 'alert alert-danger'), //success, info, warning, error or danger
            ),
        ));
        ?>
        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

    </div>
</div>
<input style="display: none;" value="<?php echo $_GET['branch_id'] ?>" name="branch_id" />
<div class="form-group">
    <label class="col-sm-2">Date Format</label>
    <div class="col-md-6">
        <div class="input-group input-large" data-date="2013-07-13" data-date-format="yyyy-mm-dd">
            <input type="text" class="form-control dpd1" required name="date_range_from">
            <span class="input-group-addon">To</span>
            <input type="text" class="form-control dpd2" required name="date_range_to">
        </div>
        <span class="help-block">Select date range</span> </div>
</div><!--/form-group-->
<div class="form-group">
    <label class="col-sm-2">Age Range</label>
    <div class="col-sm-4">
        <select class="form-control" name="age_range_from">
            <?php
            for ($index = 18; $index < 60; $index++) {
                ?>
                <option value="<?php echo $index; ?>"><?php echo $index; ?></option>
                <?php
            }
            ?>
        </select>
        <span class="help-block">Select Age range</span> 
    </div>
    <div class="col-sm-4">
        <select class="form-control" name="age_range_to">
            <?php
            for ($index = 18; $index < 60; $index++) {
                ?>
                <option value="<?php echo $index; ?>"><?php echo $index; ?></option>
                <?php
            }
            ?>
        </select>
        <!-- select date range removed KK--> 
        <span class="help-block"></span> 
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2">Gender Filter</label>
    <div class="col-sm-6">
        <label class="radio-inline">
            <input type="radio" name="gender" value="1" >
            <span class="custom-radio"></span> Male </label>
        <label class="radio-inline">
            <input type="radio" name="gender"  value="0" >
            <span class="custom-radio"></span> Female </label>
        <label class="radio-inline">
            <input type="radio" name="gender"  value="both" checked>
            <span class="custom-radio"></span> Both </label>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2">Repeat or New Filter</label>
    <div class="col-sm-6">
        <label class="radio-inline">
            <input type="radio" name="repeat_new" value="new" >
            <span class="custom-radio"></span> New </label>
        <label class="radio-inline">
            <input type="radio" name="repeat_new"  value="repeat" >
            <span class="custom-radio"></span> Repeat </label>
        <label class="radio-inline">
            <input type="radio" name="repeat_new"  value="both" checked>
            <span class="custom-radio"></span> Both </label>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2">Feedback</label>
    <div class="col-sm-10">
        <label class="radio-inline">
            <input type="radio" name="feedback" value="0" >
            <span class="custom-radio"></span> <?php
            for ($index = 0; $index < 5; $index++) {
                ?>
                <i class="fa fa-star-o"></i> 
                <?php
            }
            ?></label>
        <label class="radio-inline">
            <input type="radio" name="feedback" value="1" >
            <span class="custom-radio"></span> <i class="fa fa-star"></i> <?php
            for ($index = 0; $index < 4; $index++) {
                ?>
                <i class="fa fa-star-o"></i> 
                <?php
            }
            ?> </label>
        <label class="radio-inline">
            <input type="radio" name="feedback" value="2" >
            <span class="custom-radio"></span> <i class="fa fa-star"></i> 
            <i class="fa fa-star"></i><?php
            for ($index = 0; $index < 3; $index++) {
                ?>
                <i class="fa fa-star-o"></i> 
                <?php
            }
            ?>  </label>
        <label class="radio-inline">
            <input type="radio" name="feedback"  value="3" >
            <span class="custom-radio"></span><?php
            for ($index = 0; $index < 3; $index++) {
                ?>
                <i class="fa fa-star"></i> 
                <?php
            }
            ?> <i class="fa fa-star-o"></i> 
            <i class="fa fa-star-o"></i> </label>
        <label class="radio-inline">
            <input type="radio" name="feedback"  value="4" >
            <span class="custom-radio"></span> <?php
            for ($index = 0; $index < 4; $index++) {
                ?>
                <i class="fa fa-star"></i> 
                <?php
            }
            ?> <i class="fa fa-star-o"></i> 
        </label>
        <label class="radio-inline">
            <input type="radio" name="feedback" value="5" >
            <span class="custom-radio"></span> <?php
            for ($index = 0; $index < 5; $index++) {
                ?>
                <i class="fa fa-star"></i> 
                <?php
            }
            ?> </label>
        <label class="radio-inline">
            <!-- default checked values removed KK-->
            <input type="radio" name="feedback" value="all" checked>
            <span class="custom-radio"></span> All </label>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2">Testimonies</label>
    <div class="col-sm-6">
        <label class="checkbox-inline">
            <input type="checkbox" name="testimonies" value="testimonies" id="inlinecheckbox1">
            <span class="custom-checkbox"></span> Add Testimonies In Report </label>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2">Data to export</label>
    <?php
    $customer_custom_field_assignment = CustomerCustomFieldAssignmentTable::model()->findByPk(1);
    echo $customer_custom_field = $customer_custom_field_assignment->Customer_Custom_Fields->Field_Category->field_category;
    ?>
    <div class="col-sm-4">
        <select  multiple="multiple" name="data_export[]" class="tokenize-sample data_export">
            <option value="-1" selected="selected">Name</option>
            <option value="-2"  selected="selected">Mobile</option>
            <option value="-3"  selected="selected">Email</option>
            <option value="-4" selected="selected">Age</option>
            <?php
            $Fields = CustomerCustomFieldAssignmentTable::model()->findAll(array(
                'condition' => 'branch_id = :branch_id',
                'params' => array(':branch_id' => $branch_id)
            ));


            foreach ($Fields as $Field) {
                ?>
                <option value="<?php echo $Field->id; ?>" ><?php echo CustomerCustomField::model()->findByPk($Field->customer_custom_field_id)->field_name; ?></option>
                <?php
            }
            ?>

        </select>

        <!-- select age range span removed --KK -->
    </div>
</div>
<?php
/*
  <input style="display:none" class="span5" value="<?php echo $_GET['pId']; ?>" name="TabletMaster[branch_id]" id="TabletMaster_branch_id" type="text">
  <div class="form-group">
  <?php echo $form->labelEx($model, 'first_name_user', array('class' => 'col-sm-3 control-label')); ?>
  <div class="col-sm-9">
  <?php echo $form->textFieldRow($model, 'first_name_user', array('class' => 'span5 form-control', 'maxlength' => 45)); ?>
  <?php echo $form->error($model, 'first_name_user', array('style' => 'color:red;')); ?>
  </div>
  </div><!--/form-group-->
  <div class="form-group">
  <?php echo $form->labelEx($model, 'last_name_user', array('class' => 'col-sm-3 control-label')); ?>
  <div class="col-sm-9">
  <?php echo $form->textFieldRow($model, 'last_name_user', array('class' => 'span5 form-control', 'maxlength' => 45)); ?>
  <?php echo $form->error($model, 'last_name_user', array('style' => 'color:red;')); ?>
  </div>
  </div><!--/form-group-->
  <div class="form-group">
  <?php echo $form->labelEx($model, 'username', array('class' => 'col-sm-3 control-label')); ?>
  <div class="col-sm-9">
  <?php echo $form->textFieldRow($model, 'username', array('class' => 'span5 form-control', 'maxlength' => 45)); ?>
  <?php echo $form->error($model, 'username', array('style' => 'color:red;')); ?>
  </div>
  </div><!--/form-group-->
  <div class="form-group">
  <?php echo $form->labelEx($model, 'password', array('class' => 'col-sm-3 control-label')); ?>
  <div class="col-sm-9">
  <?php echo $form->textFieldRow($model, 'password', array('class' => 'span5 form-control', 'maxlength' => 45)); ?>
  <?php echo $form->error($model, 'password', array('style' => 'color:red;')); ?>
  </div>
  </div><!--/form-group-->
 * 
 */
?>
<div class="bottom">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
    <a href="<?php echo Yii::app()->request->getBaseUrl(); ?>/index.php/tabletMaster_child?pId=<?php echo $_GET['pId']; ?>" class="btn btn-default" >Cancel</a>
</div><!--/form-group-->
<!--</form>-->
<?php $this->endWidget();
?>


<?php
/**
  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
  'id' => 'tablet-master-form',
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
  <?php echo $form->textFieldRow($model, 'first_name_user', array('class' => 'span5', 'maxlength' => 45)); ?>
  <?php echo $form->textFieldRow($model, 'last_name_user', array('class' => 'span5', 'maxlength' => 45)); ?>
  <?php
  //echo $form->datepickerRow($model, 'joining_date', array(
  //    'options' => array(
  //        'language' => 'id',
  //        'format' => 'yyyy-mm-dd',
  //        'weekStart' => 1,
  //        'autoclose' => 'true',
  //        'keyboardNavigation' => true,
  //    ),
  //        ), array(
  //    'prepend' => '<i class="icon-calendar"></i>'
  //        )
  //);
  //;
  //
  ?>
  <?php echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 45)); ?>
  <?php echo $form->textFieldRow($model, 'password', array('class' => 'span5', 'maxlength' => 75)); ?>

  <input style="display:none" class="span5" value="<?php echo $pId; ?>" name="TabletMaster[branch_id]" id="TabletMaster_branch_id" type="text">


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
 * 
 */
?>
