
<div class="col-sm-4 col-lg-3">
    <ul class="nav nav-pills nav-stacked nav-email">
        <li class="active"> <a href="#"> <i class="glyphicon glyphicon-inbox"></i> Branch </a> </li>
        <li> <a href="<?php echo Yii::app()->createUrl("customerCustomFieldAssignmentTable_Parent?pId=" . $pId); ?>"> <i class="glyphicon glyphicon-th-list"></i> View All Custom Fields </a> </li>
    </ul>
</div><!-- col-sm-3 -->
<div class="col-sm-8 col-lg-8">
    <div class="block-web">
        <div class="pull-right">
            <div class="btn-group">
                <a href="<?php echo Yii::app()->createUrl("customerCustomFieldAssignmentTable_Parent/update/" . $model->id . "?pId=" . $pId); ?>" title="" data-toggle="tooltip" type="button" class="btn btn-white tooltips" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                <a href="<?php echo Yii::app()->createUrl("customerCustomFieldAssignmentTable_Parent/delete/" . $model->id . "?pId=" . $pId); ?>" title="" data-toggle="tooltip" type="button" class="btn btn-white tooltips" data-original-title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
            </div>
        </div> 

        <strong><?php // echo $model->branch_name;            ?></strong>
        <br/>
        <br/>
        <br/>
        <?php
        $this->widget('bootstrap.widgets.TbDetailView', array(
            'data' => $model,
            'attributes' => array(
                'id',
                'customer_custom_field_id',
                'branch_id',
            ),
        ));
        ?>
    </div><!--/ block-web -->
</div><!-- /col-sm-9 -->

<?php
/* @var $this CustomerCustomFieldAssignmentTable_ParentController */
/* @var $model CustomerCustomFieldAssignmentTable */
/*
  $this->breadcrumbs = array(
  'Customer Custom Field Assignment Tables' => array('index'),
  $model->id,
  );

  $menu = array();
  require(dirname(__FILE__) . DIRECTORY_SEPARATOR . '_menu.php');

  $this->menu = array(
  array('label' => 'View CustomerCustomFieldAssignmentTable', 'url' => array('view', 'id' => $model->id), 'icon' => 'fa fa-eye', 'active' => true),
  // Add child model
  array('label' => 'SubCustomerCustomFieldAssignment', 'url' => Yii::app()->createUrl("SubCustomerCustomFieldAssignment?pId=" . $model->id), 'icon' => 'fa fa-list-alt'),
  //    array('label' => 'Child Model 2', 'url' => Yii::app()->createUrl("'Child Model 2", array("pId" => $model->id)), 'icon' => 'fa fa-list-alt'),
  //    array('label' => 'Child Model 3', 'url' => Yii::app()->createUrl("'Child Model 3", array("pId" => $model->id)), 'icon' => 'fa fa-list-alt'),
  );


  $menu2 = array(
  array('label' => 'CustomerCustomFieldAssignmentTable', 'url' => array('index'), 'icon' => 'fa fa-list-alt', 'items' => $menu)
  );

  if (!isset($_GET['asModal'])) {
  ?>
  <?php
  $box = $this->beginWidget(
  'bootstrap.widgets.TbBox', array(
  'title' => 'View Customer Custom Field Assignment Tables #' . $model->id,
  'headerIcon' => 'icon- fa fa-eye',
  'headerButtons' => array(
  array(
  'class' => 'bootstrap.widgets.TbButtonGroup',
  'type' => 'success',
  // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
  'buttons' => $menu2
  ),
  )
  )
  );
  ?>
  <?php
  }
  ?>

  <?php
  $this->widget('bootstrap.widgets.TbAlert', array(
  'block' => false, // display a larger alert block?
  'fade' => true, // use transitions?
  'closeText' => '&times;', // close link text - if set to false, no close link is displayed
  'alerts' => array(// configurations per alert type
  'success' => array('block' => true, 'fade' => true, 'closeText' => '&times;'), //success, info, warning, error or danger
  'info' => array('block' => true, 'fade' => true, 'closeText' => '&times;'), //success, info, warning, error or danger
  'warning' => array('block' => true, 'fade' => true, 'closeText' => '&times;'), //success, info, warning, error or danger
  'error' => array('block' => true, 'fade' => true, 'closeText' => '&times;'), //success, info, warning, error or danger
  'danger' => array('block' => true, 'fade' => true, 'closeText' => '&times;'), //success, info, warning, error or danger
  ),
  ));
  ?>
  <?php
  $this->widget('bootstrap.widgets.TbDetailView', array(
  'data' => $model,
  'attributes' => array(
  'id',
  'customer_custom_field_id',
  'user_id',
  /*
  //CONTOH
  array(
  'header' => 'Level',
  'name'=> 'ref_level_id',
  'type'=>'raw',
  'value' => ($model->Level->name),
  // 'value' => ($model->status)?"on":"off",
  // 'value' => @Admin::model()->findByPk($model->createdBy)->username,
  ),

 */
/* ),
  ));
  ?>

  <?php
  if (!isset($_GET['asModal'])) {
  $this->endWidget();
  }
  ?>
 * 
 */
?>