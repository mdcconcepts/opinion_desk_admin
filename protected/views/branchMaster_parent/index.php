
<div class="row">
    <div class="panel-body">
        <?php
        $Branches = BranchMaster::model()->findAll(array(
            'condition' => 'customer_id = :customer_id',
            'params' => array(':customer_id' => Yii::app()->user->id)
        ));

        foreach ($Branches as $Branch) {
            ?>

                                                                                                                    <!--onclick="location.href = '<?php // echo Yii::app()->request->baseUrl . '/index.php//branchMaster_parent/' . $Branch->id;                              ?>';"-->
            <div class="col-sm-4 col-md-4">
                <div class="block-web branch_index_grid_border" style=" padding-top: 0px; ">
                    <div class="row primary-box" >
                        <p style="color: #fff;font-size: 18px;margin-top: 6px;font-weight: normal;text-align: center;"><?php echo $Branch->branch_name ?></p>
                    </div>
                    <!--                <div class="primary-box" style=" padding: 10px; ">
                                            <h3 style=" text-align: center; "><?php // echo $Branch->branch_name              ?></h3>
                                        </div>-->
                    <div class="row" style="text-align: center;">
                        <div class="col-lg-4">
                            <div class="panel-body">
                                <a href = "<?php echo Yii::app()->request->baseUrl; ?>/index.php/branchMaster_parent/<?php echo $Branch->id; ?>" >
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/branch_index_dashBoard.png" />
                                    <strong class="groid_text" style="font-size: 10px;color: #169B9D;text-decoration: none;">Dashboard</strong>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel-body">
                                <a href = "<?php echo Yii::app()->request->baseUrl; ?>/index.php/ResponceMaster_child/viewbranchreport?branch_id=<?php echo $Branch->id; ?>" >
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/branch_index_reports.png" />
                                    <strong class="groid_text" style="font-size: 10px;color: #169B9D;text-decoration: none;">Branch Report</strong>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel-body">
                                <a href = "<?php echo Yii::app()->request->baseUrl; ?>/index.php/testimonials?branch_id=<?php echo $Branch->id; ?>" >
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/branch_index_testimonials.png"/>
                                    <strong class="groid_text" style="font-size: 10px;color: #169B9D;text-decoration: none;">Testimonials</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
//    echo json_encode($Branch->branch_name);
        }
        ?>
        <div class="col-sm-4 col-md-4">
            <a href="<?php echo Yii::app()->request->baseUrl . '/index.php//branchMaster_parent/create'; ?>" class="btn btn-primary" style=" font-size: 100px;"> 
                +
            </a>
        </div>
    </div>
</div>

<?php
/*
  <div class="row">
  <div class="col-md-12">
  <div class="block-web">
  <div class="header">
  <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
  <h3 class="content-header">All Branches</h3>
  </div>
  <div class="porlets-content">
  <?php if (Yii::app()->user->hasFlash('error')): ?>
  <div class="alert alert-danger">
  <?php echo Yii::app()->user->getFlash('error'); ?>
  </div>
  <?php endif; ?>
  <div class="btn-group" style="margin-bottom: 20px;">
  <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/branchMaster_parent/create" class="btn btn-primary">
  Add New <i class="fa fa-plus"></i>
  </a>
  </div>
  <div class="table-responsive">
  <?php
  $this->widget('zii.widgets.grid.CGridView', array(
  'dataProvider' => $model->getActiveUsers(),
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
  'name' => 'branch_name',
  'value' => '($data->branch_name)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  array(
  'name' => 'branch_address',
  'value' => '($data->branch_address)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  array(
  'name' => 'tablet_no',
  'value' => '($data->tablet_no)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  array(
  'name' => 'created_at',
  'value' => '($data->created_at)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  array(
  'name' => 'updated_at',
  'value' => '($data->updated_at)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  array(
  'class' => 'bootstrap.widgets.TbButtonColumn',
  'htmlOptions' => array('style' => 'width:90px'),
  'template' => '{detail}',
  'buttons' => array
  (
  'detail' => array
  (
  'label' => 'View Branch',
  'icon' => 'fa fa-folder-open',
  'url' => 'array("view","id"=>$data->id)',
  'options' => array(
  'class' => 'badge badge-info',
  ),
  ),
  //                                    'delete' => array
  //                                        (
  //                                        'label' => 'Update Branch',
  //                                        'icon' => 'fa fa-trash-o',
  //                                        'url' => 'array("delete","id"=>$data->id)',
  //                                        'options' => array(
  //                                            'class' => 'badge badge-info',
  //                                        ),
  //                                    ),
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
  /* @var $this BranchMaster_parentController */
/* @var $dataProvider CActiveDataProvider */

/**
  $this->breadcrumbs = array(
  'Branch Masters',
  );

  $menu = array();
  require(dirname(__FILE__) . DIRECTORY_SEPARATOR . '_menu.php');
  $this->menu = array(
  array('label' => 'BranchMaster', 'url' => array('index'), 'icon' => 'fa fa-list-alt', 'items' => $menu)
  );

  Yii::app()->clientScript->registerScript('search', "
  $('.search-button').click(function(){
  $('.search-form').toggle();
  return false;
  });
  $('.search-form form').submit(function(){
  $.fn.yiiGridView.update('branch-master-grid', {
  data: $(this).serialize()
  });
  return false;
  });
  ");

  Yii::app()->clientScript->registerScript('refreshGridView', "
  // automatically refresh grid on 5 seconds
  //setInterval(\"$.fn.yiiGridView.update('branch-master-grid')\",5000);
  ");
  ?>

  <?php
  $box = $this->beginWidget(
  'bootstrap.widgets.TbBox', array(
  'title' => 'List Branch Masters',
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
  'id' => 'branch-master-grid',
  'dataProvider' => $model->getActiveUsers(),
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
  'name' => 'customer_id',
  'value' => '($data->customer_id)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  array(
  'name' => 'branch_name',
  'value' => '($data->branch_name)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  array(
  'name' => 'branch_address',
  'value' => '($data->branch_address)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  array(
  'name' => 'tablet_no',
  'value' => '($data->tablet_no)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  array(
  'name' => 'created_at',
  'value' => '($data->created_at)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  array(
  'name' => 'updated_at',
  'value' => '($data->updated_at)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
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
/**
  array(
  'class' => 'bootstrap.widgets.TbButtonColumn',
  'template' => '{view} {detail}',
  'buttons' => array
  (
  'view' => array
  (
  'url' => '$data->id."|".$data->customer_id',
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
 * 
 */
?>