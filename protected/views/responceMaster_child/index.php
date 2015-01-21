
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h2>My Reports</h2>
    </div>
    <?php
    $Branches = BranchMaster::model()->findAll(array(
        'condition' => 'customer_id = :customer_id',
        'params' => array(':customer_id' => Yii::app()->user->id)
    ));

    foreach ($Branches as $Branch) {
        ?>


        <div class="col-sm-4 col-md-4">
            <div class="block-web primary-box" onclick="location.href = '<?php echo Yii::app()->request->baseUrl . '/index.php/ResponceMaster_child/viewbranchreport?branch_id=' . $Branch->id; ?>';" style="cursor: pointer;">
                <div class="header" style=" padding: 22px; ">
                    <h3 ><?php echo $Branch->branch_name ?></h3>
                </div>
                <!--                <h3 class="content-header"> Your Branch Statistics
                                    </h3>-->
                <table class="table margin-top-20 today" width="100%" border="0" cellspacing="0" cellpadding="0" >
                    <tr >
                        <td style="border-top: 0px solid #ddd;" ><button class="btn btn-primary padd-adj" type="button"><?php echo BranchDashboard_helper::getTotalFeedBackCountForBranches(date('Y-m-d'), date('Y-m-d'), $Branch->id); ?></button>
                            Total Feedback</td>
                        <td style="border-top: 0px solid #ddd;"><button class="btn btn-primary padd-adj" type="button"><?php echo BranchDashboard_helper::getTotalFeedBackAverageForBranches(date('Y-m-d'), date('Y-m-d'), $Branch->id); ?></button>
                            Average Ratting</td>

                    </tr>
                    <tr >
                        <td  style="border-top: 0px solid #ddd;"><button class="btn btn-primary padd-adj" type="button"><?php echo BranchDashboard_helper::getPositiveFeedbackForBranches(date('Y-m-d'), date('Y-m-d'), $Branch->id); ?></button>
                            Positive Ratting</td>
                        <td  style="border-top: 0px solid #ddd;"><button class="btn btn-primary padd-adj" type="button"><?php echo BranchDashboard_helper::getNegativeFeedbackForBranches(date('Y-m-d'), date('Y-m-d'), $Branch->id); ?></button>
                            Negative Ratting</td>
                    </tr>
                </table>
            </div>
        </div>

        <?php
//    echo json_encode($Branch->branch_name);
    }
    ?>
    <div class="col-sm-4 col-md-4">
        <a href="<?php echo Yii::app()->request->baseUrl . '/index.php//branchMaster_parent/create'; ?>" class="btn btn-primary" style=" font-size: 136px;"> 
            +
        </a>
    </div>
</div>

<?php
/* @var $this ResponceMaster_childController */
/* @var $dataProvider CActiveDataProvider */
/**
  $this->breadcrumbs = array(
  'Responce Masters',
  );

  $menu = array();
  require(dirname(__FILE__) . DIRECTORY_SEPARATOR . '_menu.php');
  $this->menu = array(
  array('label' => 'ResponceMaster', 'url' => array('index'), 'icon' => 'fa fa-list-alt', 'items' => $menu)
  );

  Yii::app()->clientScript->registerScript('search', "
  $('.search-button').click(function(){
  $('.search-form').toggle();
  return false;
  });
  $('.search-form form').submit(function(){
  $.fn.yiiGridView.update('responce-master-grid', {
  data: $(this).serialize()
  });
  return false;
  });
  ");

  Yii::app()->clientScript->registerScript('refreshGridView', "
  // automatically refresh grid on 5 seconds
  //setInterval(\"$.fn.yiiGridView.update('responce-master-grid')\",5000);
  ");
  ?>

  <?php
  $box = $this->beginWidget(
  'bootstrap.widgets.TbBox', array(
  'title' => 'List Responce Masters',
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
  'id' => 'responce-master-grid',
  'dataProvider' => $model->search(),
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
  'name' => 'option_value',
  'value' => '($data->option_value)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  array(
  'name' => 'responce_text',
  'value' => '($data->responce_text)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  array(
  'name' => 'responce_audio_url',
  'value' => '($data->responce_audio_url)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  array(
  'name' => 'responce_vedio_url',
  'value' => '($data->responce_vedio_url)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  array(
  'name' => 'created_at',
  'value' => '($data->created_at)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  array(
  'name' => 'question_id',
  'value' => '($data->question_id)',
  'headerHtmlOptions' => array('style' => 'text-align:center;'),
  ),
  //'client_id',

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
/* array(
  'class' => 'bootstrap.widgets.TbButtonColumn',
  'template' => '{view}',
  'buttons' => array
  (
  'view' => array
  (
  'url' => '$data->id."|".$data->option_value',
  'click' => 'function(){
  data=$(this).attr("href").split("|")
  $("#myModalHeader").html(data[1]);
  $("#myModalBody").load("' . $this->createUrl('view') . '&id="+data[0]+"&asModal=true");
  $("#myModal").modal();
  return false;
  }',
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

  ?>

  <div class="row">
  <div class="col-md-12">
  <div class="block-web full">
  <div class="col-md-12">
  <div class="block-web">
  <div class="header">
  <div class="actions"> <a href="#" class="minimize"><i class="fa fa-chevron-down"></i></a> <a href="#" class="refresh"><i class="fa fa-repeat"></i></a> </div>
  <h3 class="content-header">Create Report</h3>
  </div>
  <!--                    <div class="porlets-content">
  <div class="alert alert-danger"> -->
  <!--                        </div>
  </div>-->

  <div class="porlets-content">
  <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
  </div><!--/porlets-content-->
  </div><!--/block-web-->
  </div><!--/col-md-6-->
  </div><!--/block-web-->
  </div><!--/col-md-8-->
  </div><!--/row-->



  ?>

  <div class="row">
  <div class="col-md-12 col-sm-12">
  <h2>Branch Grids</h2>
  </div>
  <?php
  $Branches = BranchMaster::model()->findAll(array(
  'condition' => 'customer_id = :customer_id',
  'params' => array(':customer_id' => Yii::app()->user->id)
  ));

  foreach ($Branches as $Branch) {
  ?>


  <div class="col-sm-4 col-md-4">
  <div class="block-web primary-box" onclick="location.href = '<?php echo Yii::app()->request->baseUrl . '/index.php/ResponceMaster_child/viewbranchreport?branch_id=' . $Branch->id; ?>';" style="cursor: pointer;">
  <div class="header">
  <h3><?php echo $Branch->branch_name ?></h3>
  </div>
  <!--                <h3 class="content-header"> Your Branch Statistics
  </h3>-->
  <table class="table margin-top-20 today" width="100%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
  <td class="fa-border"><button class="btn btn-danger padd-adj" type="button"><?php echo BranchDashboard_helper::getTotalFeedBackCountForBranches(date('Y-m-d'), date('Y-m-d'), $Branch->id); ?></button>
  Total Feedback</td>
  <td class="fa-border"><button class="btn btn-primary padd-adj" type="button"><?php echo BranchDashboard_helper::getTotalFeedBackAverageForBranches(date('Y-m-d'), date('Y-m-d'), $Branch->id); ?></button>
  Average Ratting</td>

  </tr>
  <tr>
  <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo BranchDashboard_helper::getPositiveFeedbackForBranches(date('Y-m-d'), date('Y-m-d'), $Branch->id); ?></button>
  Positive Ratting</td>
  <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo BranchDashboard_helper::getNegativeFeedbackForBranches(date('Y-m-d'), date('Y-m-d'), $Branch->id); ?></button>
  Negative Ratting</td>
  </tr>
  </table>
  </div>
  </div>

  <?php
  //    echo json_encode($Branch->branch_name);
  }
  ?>

  </div>
 * 
 */
?>