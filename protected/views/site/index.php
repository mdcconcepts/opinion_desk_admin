<style>
    #dashboard_graph {
        width		: 100%;
        height		: 500px;
        font-size	: 11px;
    }	
</style>

<div class="row">
    <div class="col-md-12">
        <h2><i class="fa fa-home"></i> Home</h2>
    </div><!--/col-md-12--> 
</div><!--/row--> 
<div class="row">
    <div class="col-md-6">
        <div class="block-web">
            <h3 class="content-header"> Your Statistics
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
                    <td class="fa-border"><button class="btn btn-danger padd-adj" type="button"><?php echo Dashboard_helper::getTotalFeedBackCountForAllBranches(date('Y-m-d'), date('Y-m-d')); ?></button>
                        Total Feedback</td>
                    <td class="fa-border"><button class="btn btn-primary padd-adj" type="button"><?php echo Dashboard_helper::getTotalFeedBackAverageForAllBranches(date('Y-m-d'), date('Y-m-d')); ?></button>
                        Average Ratting</td>

                </tr>
                <tr>
                    <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo Dashboard_helper::getPositiveFeedbackForAllBranches(date('Y-m-d'), date('Y-m-d')); ?></button>
                        Positive Ratting</td>
                    <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo Dashboard_helper::getNegativeFeedbackForAllBranches(date('Y-m-d'), date('Y-m-d')); ?></button>
                        Negative Ratting</td>
                </tr>
            </table>
            <table class="table margin-top-20 weekly" style="display: none;" width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                    <td class="fa-border"><button class="btn btn-danger padd-adj" type="button"><?php echo Dashboard_helper::getTotalFeedBackCountForAllBranches(date('Y-m-d', strtotime('monday this week')), date('Y-m-d')); ?></button>
                        Total Feedback </td>
                    <td class="fa-border"><button class="btn btn-primary padd-adj" type="button"><?php echo Dashboard_helper::getTotalFeedBackAverageForAllBranches(date('Y-m-d', strtotime('monday this week')), date('Y-m-d')); ?></button>
                        Average Ratting</td>

                </tr>
                <tr>
                    <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo Dashboard_helper::getPositiveFeedbackForAllBranches(date('Y-m-d', strtotime('monday this week')), date('Y-m-d')); ?></button>
                        Positive Ratting</td>
                    <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo Dashboard_helper::getNegativeFeedbackForAllBranches(date('Y-m-d', strtotime('monday this week')), date('Y-m-d')); ?></button>
                        Negative Ratting</td>
                </tr>
            </table>
            <table class="table margin-top-20 montly" style="display: none;" width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                    <td class="fa-border"><button class="btn btn-danger padd-adj" type="button"><?php echo Dashboard_helper::getTotalFeedBackCountForAllBranches(date('Y-m-d', strtotime('first day of this month')), date('Y-m-d')); ?></button>
                        Total Feedback </td>
                    <td class="fa-border"><button class="btn btn-primary padd-adj" type="button"><?php echo Dashboard_helper::getTotalFeedBackAverageForAllBranches(date('Y-m-d', strtotime('first day of this month')), date('Y-m-d')); ?></button>
                        Average Ratting</td>

                </tr>
                <tr>
                    <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo Dashboard_helper::getPositiveFeedbackForAllBranches(date('Y-m-d', strtotime('first day of this month')), date('Y-m-d')); ?></button>
                        Positive Ratting</td>
                    <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo Dashboard_helper::getNegativeFeedbackForAllBranches(date('Y-m-d', strtotime('first day of this month')), date('Y-m-d')); ?></button>
                        Negative Ratting</td>
                </tr>
            </table>
            <table class="table margin-top-20 yearly" style="display: none;" width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                    <td class="fa-border"><button class="btn btn-danger padd-adj" type="button"><?php echo Dashboard_helper::getTotalFeedBackCountForAllBranches(date('Y-m-d', strtotime('first day of January this year')), date('Y-m-d')); ?></button>
                        Total Feedback </td>
                    <td class="fa-border"><button class="btn btn-primary padd-adj" type="button"><?php echo Dashboard_helper::getTotalFeedBackAverageForAllBranches(date('Y-m-d', strtotime('first day of January this year')), date('Y-m-d')); ?></button>
                        Average Ratting</td>

                </tr>
                <tr>
                    <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo Dashboard_helper::getPositiveFeedbackForAllBranches(date('Y-m-d', strtotime('first day of January this year')), date('Y-m-d')); ?></button>
                        Positive Ratting</td>
                    <td class="fa-border"><button class="btn btn-info padd-adj" type="button"><?php echo Dashboard_helper::getNegativeFeedbackForAllBranches(date('Y-m-d', strtotime('first day of January this year')), date('Y-m-d')); ?></button>
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
                        <div class="col-xs-6"> <i class="fa fa-users"></i> Your Customer </div>
                        <div class="col-xs-6">
                            <div class="degree"> <?php echo Dashboard_helper::getTodaysTotalCustomerForAllBranches(date('Y-m-d'), date('Y-m-d')); ?> </div>
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
            <h3 class="content-header"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/line_graph.png"/> Quick Stats
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
                <h3> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/calculator.png"/>Customer Count <strong><?php echo Dashboard_helper::getTotalCustomerForAllBranches(); ?></strong></h3>
                <table class="table margin-top-20 today" width="100%" border="0" cellspacing="0" cellpadding="0" >
                    <tr>
                        <td class="fa-border">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/plus.png"/> 
                            <strong><?php echo Dashboard_helper::getTotalNewCustomersForALLBranches(); ?></strong>
                        </td>
                        <td class="fa-border">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/male.png"/> 
                            <strong><?php echo Dashboard_helper::getTotalNewCustomersForALLBranches(); ?></strong>
                        </td>

                    </tr>
                    <tr>
                        <td class="fa-border">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/reload.png"/> 
                            <strong><?php echo Dashboard_helper::getTotalRepeateCustomersForALLBranches(); ?></strong>
                        </td>
                        <td class="fa-border">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/female.png"/> 
                            <strong><?php echo Dashboard_helper::getTotalFEMALECustomerForAllBranches(); ?></strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div><!--/col-md-6-->
        <div class="col-md-4">
            <div class="block-web">
                <h3>Customer <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/age.png"/>  Bounds</h3>
                <table class="table margin-top-20" width="100%" border="0" cellspacing="0" cellpadding="0" >
                    <tr>
                        <?php Dashboard_helper::getAgeBoundsForCustomerForAllBranches(); ?>
                    </tr>
                </table>
            </div>
        </div>
    </div><!--/row end-->
</div>



<?php
/* @var $this SiteController */

/**
  $this->pageTitle = Yii::app()->name;
  ?>

  <h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

  <p>Congratulations! You have successfully created your Yii application.</p>

  <p>You may change the content of this page by modifying the following two files:</p>
  <ul>
  <li>View file: <code><?php echo __FILE__; ?></code></li>
  <li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
  </ul>

  <p>For more details on how to further develop this application, please read
  the <a href="http://www.yiiframework.com/doc/">documentation</a>.
  Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
  should you have any questions.</p>
  <?php
  //$field_category_name = SubCustomerCustomFieldAssignment::model()->findAllByAttributes(array('customer_custom_field_assignment_id' =>  3));
  //
  //echo json_encode(var_dump($field_category_name));
  //$customercustomfield = CustomerCustomField::model()->findByPk(1);
  //
  //echo $field_category_name = $customercustomfield->Field_Category->field_category;
  //
  //echo '<br/>';
  //echo $field_category_name = $customercustomfield->field_name;
  //
  //$customer_custom_field_assignment = CustomerCustomFieldAssignmentTable::model()->findByPk(1);
  //echo $customer_custom_field = $customer_custom_field_assignment->Customer_Custom_Fields->Field_Category->field_category;
  ?>
  <h2>Overview</h2>
  <h3>Report For Overall Period</h3>
  <p>How are your customer feel today?</p>
  <strong>Total Feedback : <b>  <?php echo Dashboard_helper::getTotalFeedBackCountForAllBranches('2013-08-29', '2015-08-29'); ?></b></strong>
  <br/>
  <strong>Total Average Feedback : <b>  <?php echo Dashboard_helper::getTotalFeedBackAverageForAllBranches('2013-08-29', '2015-08-29'); ?></b></strong>
  <br/>
  <strong>Total Positive Feedback : <b>  <?php echo Dashboard_helper::getPositiveFeedbackForAllBranches('2013-08-29', '2015-08-29'); ?></b></strong>
  <br/>
  <strong>Total Negative Feedback : <b>  <?php echo Dashboard_helper::getNegativeFeedbackForAllBranches('2013-08-29', '2015-08-29'); ?></b></strong>

  <h3>Report For Customer Analysis</h3>

  <strong>Total Customer : <b>  <?php echo Dashboard_helper::getTotalCustomerForAllBranches('2013-08-29', '2015-08-29'); ?></b></strong>
  <br/>
  <strong>Total Male Customer: <b> <?php echo Dashboard_helper::getTotalMALECustomerForAllBranches('2013-08-29', '2015-08-29'); ?></b></strong>
  <br/>
  <strong>Total female Customer : <b>  <?php echo Dashboard_helper::getTotalFEMALECustomerForAllBranches('2013-08-29', '2015-08-29'); ?></b></strong>
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

  <?php Dashboard_helper::getAgeBoundsForCustomerForAllBranches('2013-08-29', '2015-08-29'); ?>
  </table>

 *
 * 
 */
?>