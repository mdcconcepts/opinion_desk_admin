<div class="row">
    <div class="col-md-12">
        <h2><i class="fa fa-dashboard"></i>Branch Dashboard</h2>
    </div><!--/col-md-12--> 
</div><!--/row--> 
<input style="display: none;" value="<?php echo $model->id; ?>" id="branch_id" />
<div class="col-sm-4 col-lg-3">
    <ul class="nav nav-pills nav-stacked nav-email">
        <li class="active"> <a href="#"> <i class="glyphicon glyphicon-inbox"></i> Branch </a> </li>
        <li><a href="<?php echo Yii::app()->createUrl("questionMaster_Child?pId=" . $model->id); ?>"><i class="glyphicon glyphicon-star-empty"></i> Questions</a></li>
        <li><a href="<?php echo Yii::app()->createUrl("tabletMaster_child?pId=" . $model->id); ?>"><i class="glyphicon glyphicon-phone"></i> Tablets </a></li>
        <li> <a href="<?php echo Yii::app()->createUrl("branchMaster_parent"); ?>"> <i class="glyphicon glyphicon-th-list"></i> View All Branch </a> </li>
    </ul>
</div><!-- col-sm-3 -->
<div class="col-sm-8 col-lg-8">
    <div class="block-web">
        <div class="pull-right">
            <div class="btn-group">
                <a href="<?php echo Yii::app()->createUrl("branchMaster_parent/update/" . $model->id); ?>" title="" data-toggle="tooltip" type="button" class="btn btn-white tooltips" data-original-title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                <a href="<?php echo Yii::app()->createUrl("branchMaster_parent/delete/" . $model->id); ?>" title="" data-toggle="tooltip" type="button" class="btn btn-white tooltips" data-original-title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
            </div>
        </div> 

        <strong><?php echo $model->branch_name; ?></strong>
        <br/>
        <br/>
        <br/>
        <?php
        $this->widget('bootstrap.widgets.TbDetailView', array(
            'data' => $model,
            'attributes' => array(
                'id',
                'customer_id',
                'branch_name',
                'branch_address',
                'tablet_no',
                'created_at',
                'updated_at',
            ),
        ));
        ?>
    </div><!--/ block-web --> 
</div><!-- /col-sm-9 --> 




<?php
/* @var $this BranchMaster_parentController */
/* @var $model BranchMaster */

/**
  $this->breadcrumbs = array(
  'Branch Masters' => array('index'),
  $model->id,
  );



  if (!isset($_GET['asModal'])) {
  ?>
  <?php
  $box = $this->beginWidget(
  'bootstrap.widgets.TbBox', array(
  'title' => 'View Branch Masters #' . $model->id,
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
  'customer_id',
  'branch_name',
  'branch_address',
  'tablet_no',
  'created_at',
  'updated_at',
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
/**   ),
  ));
  ?>

  <?php
  if (!isset($_GET['asModal'])) {
  $this->endWidget();
  }
  ?>
 * */
?>
<style>
    #dashboard_graph {
        width		: 100%;
        height		: 500px;
        font-size	: 11px;
    }	
    #New_Male_Female_repete_chartdiv {
        width	: 100%;
        height	: 500px;
    }		
</style>

<div class="row">
    <div class="col-md-6">
        <div class="block-web">
            <h3 class="content-header"> Your Current Setup
                <div data-toggle="buttons" class="button-group pull-right"> 
                    <a class="btn small  border-gray active" href="javascript:;"> <span class="button-content" style=" padding: 3px; ">
                            <input type="radio" name="dashboard_radio_index" value="today">
                            Today </span> </a> 
                    <a class="btn small border-gray" href="javascript:;"> <span class="button-content" style=" padding: 3px; ">
                            <input type="radio" name="dashboard_radio_index"  value="weekly">
                            Weekly </span> </a> 
                    <a class="btn small border-gray" href="javascript:;"> <span class="button-content" style=" padding: 3px; ">
                            <input type="radio" name="dashboard_radio_index"  value="montly">
                            Monthly </span> </a>
                    <a class="btn small border-gray" href="javascript:;"> <span class="button-content" style=" padding: 3px; ">
                            <input type="radio" name="dashboard_radio_index"  value="yearly">
                            Yearly </span> </a>
                </div>
            </h3>
            <table class="table margin-top-20 today" width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                    <td class="fa-border"><button class="btn btn-danger padd-adj" type="button"><?php echo BranchDashboard_helper::getTotalFeedBackCountForBranches(date('Y-m-d'), date('Y-m-d'), $model->id); ?></button>
                        Total Feedback</td>
                    <td class="fa-border"><button class="btn btn-primary padd-adj" type="button"><?php echo BranchDashboard_helper::getTotalFeedBackAverageForBranches(date('Y-m-d'), date('Y-m-d'), $model->id); ?></button>
                        Average Ratting</td>

                </tr>
                <tr>
                    <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo BranchDashboard_helper::getPositiveFeedbackForBranches(date('Y-m-d'), date('Y-m-d'), $model->id); ?></button>
                        Positive Ratting</td>
                    <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo BranchDashboard_helper::getNegativeFeedbackForBranches(date('Y-m-d'), date('Y-m-d'), $model->id); ?></button>
                        Negative Ratting</td>
                </tr>
            </table>

            <table class = "table margin-top-20 weekly" style="display: none;" width = "100%" border = "0" cellspacing = "0" cellpadding = "0" >
                <tr>
                    <td class = "fa-border"><button class = "btn btn-danger padd-adj" type = "button"><?php echo BranchDashboard_helper::getTotalFeedBackCountForBranches(date('Y-m-d', strtotime('monday this week')), date('Y-m-d'), $model->id); ?></button>
                        Total Feedback </td>
                    <td class="fa-border"><button class="btn btn-primary padd-adj" type="button"><?php echo BranchDashboard_helper::getTotalFeedBackAverageForBranches(date('Y-m-d', strtotime('monday this week')), date('Y-m-d'), $model->id); ?></button>
                        Average Ratting</td>

                </tr>
                <tr>
                    <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo BranchDashboard_helper::getPositiveFeedbackForBranches(date('Y-m-d', strtotime('monday this week')), date('Y-m-d'), $model->id); ?></button>
                        Positive Ratting</td>
                    <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo BranchDashboard_helper::getNegativeFeedbackForBranches(date('Y-m-d', strtotime('monday this week')), date('Y-m-d'), $model->id); ?></button>
                        Negative Ratting</td>
                </tr>
            </table>
            <table class="table margin-top-20 montly"  style="display: none;" width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                    <td class="fa-border"><button class="btn btn-danger padd-adj" type="button"><?php echo BranchDashboard_helper::getTotalFeedBackCountForBranches(date('Y-m-d', strtotime('first day of this month')), date('Y-m-d'), $model->id); ?></button>
                        Total Feedback </td>
                    <td class="fa-border"><button class="btn btn-primary padd-adj" type="button"><?php echo BranchDashboard_helper::getTotalFeedBackAverageForBranches(date('Y-m-d', strtotime('first day of this month')), date('Y-m-d'), $model->id); ?></button>
                        Average Ratting</td>

                </tr>
                <tr>
                    <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo BranchDashboard_helper::getPositiveFeedbackForBranches(date('Y-m-d', strtotime('first day of this month')), date('Y-m-d'), $model->id); ?></button>
                        Positive Ratting</td>
                    <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo BranchDashboard_helper::getNegativeFeedbackForBranches(date('Y-m-d', strtotime('first day of this month')), date('Y-m-d'), $model->id); ?></button>
                        Negative Ratting</td>
                </tr>
            </table>
            <table class="table margin-top-20 yearly"  style="display: none;" width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                    <td class="fa-border"><button class="btn btn-danger padd-adj" type="button"><?php echo BranchDashboard_helper::getTotalFeedBackCountForBranches(date('Y-m-d', strtotime('first day of January this year')), date('Y-m-d'), $model->id); ?></button>
                        Total Feedback </td>
                    <td class="fa-border"><button class="btn btn-primary padd-adj" type="button"><?php echo BranchDashboard_helper::getTotalFeedBackAverageForBranches(date('Y-m-d', strtotime('first day of January this year')), date('Y-m-d'), $model->id); ?></button>
                        Average Ratting</td>

                </tr>
                <tr>
                    <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo BranchDashboard_helper::getPositiveFeedbackForBranches(date('Y-m-d', strtotime('first day of January this year')), date('Y-m-d'), $model->id); ?></button>
                        Positive Ratting</td>
                    <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo BranchDashboard_helper::getNegativeFeedbackForBranches(date('Y-m-d', strtotime('first day of January this year')), date('Y-m-d'), $model->id); ?></button>
                        Negative Ratting</td>
                </tr>
            </table>


        </div>
    </div>
    <div class="col-md-3">
        <div class="block-web">
            <h3 class="content-header text-center">Message Board</h3>
            <div class="panel-icon-add"><i class="fa fa-thumb-tack"></i></div>
            <p class="text-center">Please be informed that server 3 will be offline from <strong>11:00 AM</strong> to <strong>12:00 AM</strong></p>
        </div><!--/block-web-->
    </div><!--/col-md-3-->
    <div class="col-md-3">
        <div class="panel">
            <div class="weather-bg">
                <div class="panel-body">
                    <div class="row">
                        <h3 style="color: white;">Today</h3>
                        <div class="col-xs-6"> <i class="fa fa-users"></i> Your Costomer </div>
                        <div class="col-xs-6">
                            <div class="degree"> <?php echo BranchDashboard_helper::getTotalCustomerForAllBranches(date('Y-m-d'), date('Y-m-d'), $model->id); ?> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/panel-->
    </div><!--/col-md-3-->
</div><!--/row-->

<div class="row">
    <div class="col-md-12">
        <div class="block-web">
            <h3 class="content-header"> Quick Stats
                <div data-toggle="buttons" class="button-group pull-right"> 
                    <a class="btn active small border-gray" href="javascript:;"> <span class="button-content" style=" padding: 3px; ">
                            <input type="radio" name="dashboard_radio_feedback_index"  value="weekly">
                            Weekly </span> </a> 
                    <a class="btn small border-gray" href="javascript:;"> <span class="button-content" style=" padding: 3px; ">
                            <input type="radio" name="dashboard_radio_feedback_index"  value="montly">
                            Monthly </span> </a>
                    <a class="btn small border-gray" href="javascript:;"> <span class="button-content" style=" padding: 3px; ">
                            <input type="radio" name="dashboard_radio_feedback_index"  value="yearly">
                            Yearly </span> </a>
                </div>
            </h3>
            <div id="dashboard_graph" class="custom-bar-chart">

                <?php // echo Dashboard_helper::getWeeklyReportForBranch();  ?>

            </div><!--/custom-bar-chart-->
        </div><!--/block-web-->
    </div><!--/col-md-6-->
    <div class="row">
        <div class="col-md-8">
            <div class="block-web">
                <h3>Customer Count <strong><?php echo BranchDashboard_helper::getTotalCustomerForBranches($model->id); ?></strong></h3>
                <table class="table margin-top-20 today" width="100%" border="0" cellspacing="0" cellpadding="0" >
                    <tr>
                        <td class="fa-border"><button class="btn btn-danger padd-adj" type="button"><?php echo BranchDashboard_helper::getTotalNewCustomers($model->id); ?></button>
                            New </td>
                        <td class="fa-border"><button class="btn btn-primary padd-adj" type="button"><?php echo BranchDashboard_helper::getTotalMALECustomerForBranches($model->id); ?></button>
                            Male</td>

                    </tr>
                    <tr>
                        <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo BranchDashboard_helper::getTotalRepeateCustomers($model->id); ?></button>
                            Repeat</td>
                        <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo BranchDashboard_helper::getTotalFEMALECustomerForBranches($model->id); ?></button>
                            Female</td>
                    </tr>
                </table>
            </div>
        </div><!--/col-md-6-->
        <div class="col-md-4">
            <div class="block-web">
                <h3>Customer Age Bounds</h3>
                <table class="table margin-top-20" width="100%" border="0" cellspacing="0" cellpadding="0" >
                    <tr>
                        <?php BranchDashboard_helper::getAgeBoundsForCustomerForBranches($model->id); ?>
                    </tr>
                </table>
            </div>
        </div>
    </div><!--/row end-->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="block-web">
            <h3 class="content-header"> Feedback Across Category
                <div data-toggle="buttons" class="button-group pull-right"> 
                    <a class="btn small active border-gray" href="javascript:;"> <span class="button-content" style=" padding: 3px; ">
                            <input type="radio" name="dashboard_radio_category_index"  value="today">
                            Today </span> </a>
                    <a class="btn  small border-gray" href="javascript:;"> <span class="button-content" style=" padding: 3px; ">
                            <input type="radio" name="dashboard_radio_category_index"  value="weekly">
                            Weekly </span> </a> 
                    <a class="btn small border-gray" href="javascript:;"> <span class="button-content" style=" padding: 3px; ">
                            <input type="radio" name="dashboard_radio_category_index"  value="montly">
                            Monthly </span> </a>
                    <a class="btn small border-gray" href="javascript:;"> <span class="button-content" style=" padding: 3px; ">
                            <input type="radio" name="dashboard_radio_category_index"  value="yearly">
                            Yearly </span> </a>
                </div>
            </h3>
            <div id="dashboard_graph_category" class="custom-bar-chart">

                <?php // echo Dashboard_helper::getWeeklyReportForBranch();  ?>

            </div><!--/custom-bar-chart-->
        </div><!--/block-web-->
    </div><!--/col-md-6-->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="block-web">
            <h3 class="content-header"> Visitors Feedback Over Time
                <div data-toggle="buttons" class="button-group pull-right"> 
                    <a class="btn active small border-gray" href="javascript:;"> <span class="button-content" style=" padding: 3px; ">
                            <input type="radio" name="dashboard_radio_Female_Male_index"  value="weekly">
                            Weekly </span> </a> 
                    <a class="btn small border-gray" href="javascript:;"> <span class="button-content" style=" padding: 3px; ">
                            <input type="radio" name="dashboard_radio_Female_Male_index"  value="montly">
                            Monthly </span> </a>
                    <a class="btn small border-gray" href="javascript:;"> <span class="button-content" style=" padding: 3px; ">
                            <input type="radio" name="dashboard_radio_Female_Male_index"  value="yearly">
                            Yearly </span> </a>
                </div>
            </h3>
            <div id="New_Male_Female_repete_chartdiv" class="custom-bar-chart">

                <?php // echo Dashboard_helper::getWeeklyReportForBranch();  ?>

            </div><!--/custom-bar-chart-->
        </div><!--/block-web-->
    </div><!--/col-md-6-->
</div>

<?php /**
  <h2>Overview</h2>
  <h3>Report For Overall Period</h3>
  <p>How are your customer feel today?</p>
  <strong>Total Feedback : <b> <?php echo BranchDashboard_helper::getTotalFeedBackCountForBranches('2013-08-29', '2015-08-29', $model->id); ?></b></strong>
  <br/>
  <strong>Total Average Feedback : <b> <?php echo BranchDashboard_helper::getTotalFeedBackAverageForBranches('2013-08-29', '2015-08-29', $model->id); ?></b></strong>
  <br/>
  <strong>Total Positive Feedback : <b> <?php echo BranchDashboard_helper::getPositiveFeedbackForBranches('2013-08-29', '2015-08-29', $model->id); ?></b></strong>
  <br/>
  <strong>Total Negative Feedback : <b> <?php echo BranchDashboard_helper::getNegativeFeedbackForBranches('2013-08-29', '2015-08-29', $model->id); ?></b></strong>

  <h3>Report For Customer Analysis</h3>

  <strong>Total Customer : <b> <?php echo BranchDashboard_helper::getTotalCustomerForBranches('2013-08-29', '2015-08-29', $model->id); ?></b></strong>
  <br/>
  <strong>Total Male Customer: <b> <?php echo BranchDashboard_helper::getTotalMALECustomerForBranches('2013-08-29', '2015-08-29', $model->id); ?></b></strong>
  <br/>
  <strong>Total female Customer : <b> <?php echo BranchDashboard_helper::getTotalFEMALECustomerForBranches('2013-08-29', '2015-08-29', $model->id); ?></b></strong>
  <br/>
  <strong>Customer Age Bounds</strong>
  <table style="border: 1px;">
  <tr>
  <th>
  Ageband
  </th>
  <th>
  Total Customer
  </th>
  </tr>

  <?php BranchDashboard_helper::getAgeBoundsForCustomerForBranches('2013-08-29', '2015-08-29', $model->id); ?>
  </table>
  <div  style="float: left;padding: 30px">
  <strong>Visitor Feedback Yearly</strong>
  <table style="border: 1px;">
  <tr>
  <th>
  year
  </th>
  <th>
  Total Visits
  </th>
  </tr>

  <?php BranchDashboard_helper::getYearlyReportForBranch($model->id); ?>
  </table>
  </div>
  <div  style="float: left;padding: 30px">
  <strong>Visitor Feedback Monthly</strong>
  <table style="border: 1px;">
  <tr>
  <th>
  Month
  </th>
  <th>
  Total Visits
  </th>
  </tr>

  <?php BranchDashboard_helper::getMonthlyReportForBranch($model->id); ?>
  </table>
  </div>
  <div  style="float: left;padding: 30px">
  <strong>Visitor Feedback Weekly</strong>
  <table style="border: 1px;">
  <tr>
  <th>
  Week
  </th>
  <th>
  Total Visits
  </th>
  </tr>

  <?php BranchDashboard_helper::getWeeklyReportForBranch($model->id); ?>
  </table>
  </div>
  <div style="clear: both;"></div>
  <div  style="padding: 30px">
  <strong>Category Wise Reports</strong>
  <table style="border: 1px;">
  <tr>
  <th>
  Category
  </th>
  <th>
  Total Count
  </th>
  </tr>

  <?php BranchDashboard_helper::getCategoryWiseReportForBranch($model->id); ?>
  </table>
  </div>
 * 
 */
?>  

<?php
//$menu = array();
//require(dirname(__FILE__) . DIRECTORY_SEPARATOR . '_menu.php');
//
//$this->menu = array(
//    array('label' => 'View BranchMaster', 'url' => array('view', 'id' => $model->id), 'icon' => 'fa fa-eye', 'active' => true),
//    // Add child model
//    array('label' => 'Tablets', 'url' => Yii::app()->createUrl("tabletMaster_child?pId=" . $model->id), 'icon' => 'fa fa-mobile'),
//    array('label' => 'Questions', 'url' => Yii::app()->createUrl("QuestionMaster_Child?pId=" . $model->id), 'icon' => 'fa fa-list-alt'),
//        //    array('label' => 'Child Model 3', 'url' => Yii::app()->createUrl("'Child Model 3", array("pId" => $model->id)), 'icon' => 'fa fa-list-alt'),
//);
//
//
//$menu2 = array(
//    array('label' => 'BranchMaster', 'url' => array('index'), 'icon' => 'fa fa-list-alt', 'items' => $menu)
//);
?>
