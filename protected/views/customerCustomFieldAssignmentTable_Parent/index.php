<?php
//Displaying branch name on each page 
//session value is set from branchMasterParent view.php 
$branch_name = Yii::app()->session['branch_name'];
?>
<h2><i class="fa fa-sitemap" style="margin-right: 10px;"></i>My Branch / <?php echo $branch_name ?></h2>

<div class="row">
    <div class="col-sm-3 col-lg-2" style="position: relative;margin-top: 30px;"> 
        <ul class="nav nav-pills nav-stacked nav-email" style="position: fixed;border: 2px solid #44AFB0;border-top-left-radius: 9px;border-top-right-radius: 9px;">
            <li title="View Branch" > <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/branchMaster_parent/<?php echo $_GET['pId']; ?>"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/branches_menu.png"/> Branch </a> </li>
            <li title="View Report"><a href="<?php echo Yii::app()->createUrl("ResponceMaster_child/viewbranchreport?branch_id=" . $_GET['pId']); ?>">   <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/question_report.png"/> Report</a></li>
            <li title="View testimonial"><a href="<?php echo Yii::app()->createUrl("testimonials?branch_id=" . $_GET['pId']); ?>">   <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/question_testi.png"/> Testimonials</a></li>
            <li title="View Questions" ><a href="<?php echo Yii::app()->createUrl("questionMaster_Child?pId=" . $_GET['pId']); ?>">  <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/question_branch.png"/>  Questions</a></li>
            <li title="View Tablets"><a href="<?php echo Yii::app()->createUrl("tabletMaster_child?pId=" . $_GET['pId']); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/tablet.png"/>  Tablets </a></li>
            <li title="View Custom Fields" class="active"><a href="<?php echo Yii::app()->createUrl("customerCustomFieldAssignmentTable_Parent?pId=" . $_GET['pId']); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/selected/custom_fields.png"/> Custom Fields</a></li>
        <!-- <li title="View All Branch"> <a href="<?php // echo Yii::app()->createUrl("branchMaster_parent");  ?>"> <i class="glyphicon glyphicon-th-list"></i> View All Branch </a> </li>-->
            <!-- View all branches removed - KK -->
        </ul>
    </div><!-- col-sm-3 -->
    <div class="col-md-10" style=" margin-top: 30px; ">
        <div class="block-web">
            <div class="header">
                <h3 class="content-header">All Customer Fields</h3>
            </div>
            <div class="porlets-content">
                <?php if (Yii::app()->user->hasFlash('error')): ?>
                    <div class="alert alert-danger"> 
                        <?php echo Yii::app()->user->getFlash('error'); ?>
                    </div>
                <?php endif; ?>
                <div class="btn-group" style="margin-bottom: 20px;">
                    <ul class="demo-btns">
                        <li> <a class="btn btn-labeled btn-primary" href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/branchMaster_parent/<?php echo $_GET['pId']; ?>"> <span class="btn-label"><i class="glyphicon glyphicon-chevron-left"></i></span>Back </a> </li>
                        <li> <a class="btn btn-labeled btn-primary" href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/customerCustomFieldAssignmentTable_Parent/create?pId=<?php echo $pId; ?>"> <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span> Add Custom Field </a> </li>
                    </ul>
                </div>
                <div class="table-responsive">
                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'dataProvider' => $model->getDataFromPK($pId),
                        'summaryText' => '',
                        'itemsCssClass' => 'display table table-bordered table-striped Branch_master',
                        'htmlOptions' => array('class' => ''),
                        'columns' => array(
                            array('header' => 'No', 'value' => '($this->grid->dataProvider->pagination->currentPage*
                                    $this->grid->dataProvider->pagination->pageSize
                                    )+
                                    array_search($data,$this->grid->dataProvider->getData())+1',
                                'htmlOptions' => array('style' => 'width: 25px; text-align:center;'),
                            ),
                            array(
                                'name' => 'customer_custom_field_id',
                                'value' => '($data->Customer_Custom_Fields_Val->field_name)',
                                'headerHtmlOptions' => array('style' => 'text-align:center;'),
                            ),
                            array(
                                'class' => 'bootstrap.widgets.TbButtonColumn',
                                'htmlOptions' => array('style' => 'width:30px'),
                                'template' => '{detail}',
                                'buttons' => array
                                    (
//                                    'detail' => array
//                                        (
//                                        'label' => 'View Branch',
//                                        'icon' => 'fa fa-level-down',
//                                        'url' => 'array("view","id"=>$data->id)',
//                                        'options' => array(
//                                            'class' => 'badge badge-info',
//                                        ),
//                                    ),
                                    'detail' => array
                                        (
                                        'label' => 'View Details',
                                        'icon' => 'fa fa-folder-open',
                                        'url' => 'array("view","id"=>$data->id,"pId"=>$_GET["pId"])',
                                        'options' => array(
                                            'class' => 'badge badge-info',
                                        ),
                                    ),
                                )
                            ),
                        ),
                    ));
                    ?>
                </div><!--/table-responsive-->
            </div><!--/porlets-content-->


        </div><!--/block-web--> 
    </div><!--/col-md-12--> 
</div><!--/row-->


<?php
/* @var $this CustomerCustomFieldAssignmentTable_ParentController */
/* @var $dataProvider CActiveDataProvider */
/**
  $this->breadcrumbs = array(
  'Customer Custom Field Assignment Tables',
  );

  $menu = array();
  require(dirname(__FILE__) . DIRECTORY_SEPARATOR . '_menu.php');
  $this->menu = array(
  array('label' => 'CustomerCustomFieldAssignmentTable', 'url' => array('index'), 'icon' => 'fa fa-list-alt', 'items' => $menu)
  );

  Yii::app()->clientScript->registerScript('search', "
  $('.search-button').click(function(){
  $('.search-form').toggle();
  return false;
  });
  $('.search-form form').submit(function(){
  $.fn.yiiGridView.update('customer-custom-field-assignment-table-grid', {
  data: $(this).serialize()
  });
  return false;
  });
  ");

  Yii::app()->clientScript->registerScript('refreshGridView', "
  // automatically refresh grid on 5 seconds
  //setInterval(\"$.fn.yiiGridView.update('customer-custom-field-assignment-table-grid')\",5000);
  ");
  ?>

  <?php
  $box = $this->beginWidget(
  'bootstrap.widgets.TbBox', array(
  'title' => 'List Customer Custom Field Assignment Tables',
  'headerIcon' => 'icon- fa fa-list-ol',
  'headerButtons' => array(
  array(
  'class' => 'bootstrap.widgets.TbButtonGroup',
  'type' => 'success',
  // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
  'buttons' => $this->menu
  ),
  )
  )
  );
  ?>
  <?php /** $this->widget('bootstrap.widgets.TbListView',array(
  'dataProvider'=>$dataProvider,
  'itemView'=>'_view',
  )); * */
?>
<?php
/**
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
  ?><p>
  You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
  &lt;&gt;</b>
  or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
  </p>

  <?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button btn')); ?>
  <div class="search-form" style="display:none">
  <?php
  $this->renderPartial('_search', array(
  'model' => $model,
  ));
  ?>
  </div><!-- search-form -->

  <?php echo CHtml::beginForm(array('export')); ?>
  <?php
  $this->widget('bootstrap.widgets.TbGridView', array(
  'id' => 'customer-custom-field-assignment-table-grid',
  'dataProvider' =>  ,
  'filter' => $model,
  'type' => 'striped hover', //bordered condensed
  'columns' => array(
  array('header' => 'No', 'value' => '($this->grid->dataProvider->pagination->currentPage*
  $this->grid->dataProvider->pagination->pageSize
  )+
  array_search($data,$this->grid->dataProvider->getData())+1',
  'htmlOptions' => array('style' => 'width: 25px; text-align:center;'),
  ),
  array(
  'name' => 'customer_custom_field_id',
  'value' => '($data->Customer_Custom_Fields->field_name)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  //        array(
  //            'name' => 'user_id',
  //            'value' => '($data->user_id)',
  //            'headerHtmlOptions' => array('style' => 'text-align:center;'),
  //        ),
  /*
  //Contoh
  array(
  'header' => 'Level',
  'name'=> 'ref_level_id',
  'type'=>'raw',
  'value' => '($data->Level->name)',
  // 'value' => '($data->status)?"on":"off"',
  // 'value' => '@Admin::model()->findByPk($data->createdBy)->username',
  ),
 */
/**  array(
  'class' => 'bootstrap.widgets.TbButtonColumn',
  'template' => '{view} {detail}',
  'buttons' => array
  (
  'view' => array
  (
  'url' => '$data->id."|".$data->customer_custom_field_id',
  'click' => 'function(){
  data=$(this).attr("href").split("|")
  $("#myModalHeader").html(data[1]);
  $("#myModalBody").load("' . $this->createUrl('view') . '&id="+data[0]+"&asModal=true");
  $("#myModal").modal();
  return false;
  }',
  ),
  'detail' => array
  (
  'label' => 'View data under this data',
  'icon' => 'fa fa-level-down',
  'url' => 'array("view","id"=>$data->id)',
  'options' => array(
  'class' => 'badge badge-info',
  ),
  ),
  )
  ),
  ),
  ));
  ?>

  <select name="fileType" style="width:150px;">
  <option value="Excel5">EXCEL 5 (xls)</option>
  <option value="Excel2007">EXCEL 2007 (xlsx)</option>
  <option value="HTML">HTML</option>
  <option value="PDF">PDF</option>
  <option value="WORD">WORD (docx)</option>
  </select>
  <br>

  <?php
  $this->widget('bootstrap.widgets.TbButton', array(
  'buttonType' => 'submit', 'icon' => 'fa fa-print', 'label' => 'Export', 'type' => 'primary'));
  ?>
  <?php echo CHtml::endForm(); ?>
  <?php $this->endWidget(); ?>
  <?php
  $this->beginWidget(
  'bootstrap.widgets.TbModal', array('id' => 'myModal')
  );
  ?>

  <div class="modal-header">
  <a class="close" data-dismiss="modal">&times;</a>
  <h4 id="myModalHeader">Modal header</h4>
  </div>

  <div class="modal-body" id="myModalBody">
  <p>One fine body...</p>
  </div>

  <div class="modal-footer">
  <?php
  $this->widget(
  'bootstrap.widgets.TbButton', array(
  'label' => 'Close',
  'url' => '#',
  'htmlOptions' => array('data-dismiss' => 'modal'),
  )
  );
  ?>
  </div>

  <?php $this->endWidget(); ?>
 * 
 */
?>
