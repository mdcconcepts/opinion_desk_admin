<input style="display: none;" value="<?php echo $model->id; ?>" id="branch_id" />
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
    <div class="col-md-12">
        <h2><i class="fa fa-sitemap" style="margin-right: 10px;"></i>Branch Home</h2>
    </div><!--/col-md-12--> 
</div><!--/row-->
<div class="row">
    <div class="col-sm-3 col-lg-2" style="position: relative;margin-top: 30px;"> 
        <ul class="nav nav-pills nav-stacked nav-email" style="position: fixed;border: 2px solid #44AFB0;border-top-left-radius: 9px;border-top-right-radius: 9px;">
            <li class="active"> <a href="#"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/selected/branches_menu.png"/> Branch </a> </li>
            <li><a href="<?php echo Yii::app()->createUrl("questionMaster_Child?pId=" . $model->id); ?>">  <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/question_branch.png"/>  Questions</a></li>
            <li><a href="<?php echo Yii::app()->createUrl("tabletMaster_child?pId=" . $model->id); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/tablet.png"/>  Tablets </a></li>
            <li><a href="<?php echo Yii::app()->createUrl("customerCustomFieldAssignmentTable_Parent?pId=" . $model->id); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/custom_fields.png"/> Custom Fields</a></li>
            <li> <a href="<?php echo Yii::app()->createUrl("branchMaster_parent"); ?>"> <i class="glyphicon glyphicon-th-list"></i> View All Branch </a> </li>
        </ul>
    </div><!-- col-sm-3 -->
    <div class="col-md-10">
        <div class="porlets-content">
            <?php echo CHtml::errorSummary($model, null, null, array('class' => 'alert alert-danger')); ?>
        </div>
        <div class="block-web full">
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a data-toggle="tab" href="#about"><i class="fa fa-user"></i> About</a></li>
                <li><a data-toggle="tab" href="#edit-profile"><i class="fa fa-pencil"></i> Edit</a></li>
                <li><a data-toggle="tab" href="#user-activities"><i class="fa fa-laptop"></i> Activities</a></li>
                <li><a data-toggle="tab" href="#mymessage"><i class="fa fa-envelope"></i> Message</a></li>
            </ul>

            <div class="tab-content"> 
                <div id="about" class="tab-pane active animated fadeInRight">
                    <strong><?php echo $model->branch_name; ?></strong>
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="#" onclick="delete_data('Are you sure you want to DELETE this Field?', '<?php echo Yii::app()->createUrl("branchMaster_parent/delete/" . $model->id); ?>')" title="" data-toggle="tooltip" type="button" class="btn btn-white tooltips" data-original-title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                        </div>
                    </div>
                    <div class="user-profile-content">
                        <div class="col-sm-6">
                            <h5><strong>ABOUT</strong> <?php echo $model->branch_name; ?></h5>
                            <address>
                                <strong>Branch Unique Identity</strong><br>
                                <abbr title="id"><?php echo $model->id; ?></abbr>
                            </address>
                            <address>
                                <strong>Branch Address</strong><br>
                                <abbr title="branch_address"><?php echo $model->branch_address; ?></abbr>
                            </address>

                        </div>
                        <div class="col-sm-6">
                            <h5><strong>ABOUT</strong> Tablets</h5>
                            <address>
                                <strong>Table Used for Branch <?php echo $model->branch_name; ?></strong><br>
                                <abbr title="Tablet Consume"><?php echo BranchMaster::getTablet_count($model->id); ?></abbr>
                            </address>
                            <hr/>
                            <address>
                                <strong>Table Allowed for Branch <?php echo $model->branch_name; ?></strong><br>
                                <abbr title="Date Of Birth"><?php echo $model->tablet_no; ?></abbr>
                            </address>
                        </div>
                    </div>
                </div>

                <div id="edit-profile" class="tab-pane animated fadeInRight">
                    <div class="user-profile-content">
                        <div class="porlets-content">
                            <?php
                            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                'id' => 'branch-master-form',
                                'action' => Yii::app()->request->baseUrl . '/index.php/branchMaster_parent/update/' . $model->id,
                                // Please note: When you enable ajax validation, make sure the corresponding
                                // controller action is handling ajax validation correctly.
                                // There is a call to performAjaxValidation() commented in generated controller code.
                                // See class documentation of CActiveForm for details on this.
                                'enableAjaxValidation' => false,
                                    // 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
                            ));
                            ?>

                            <input style="display:none" class="span5" value="<?php echo Yii::app()->user->id; ?>" name="BranchMaster[customer_id]" id="BranchMaster_customer_id" type="text">
                            <div class="form-group">
                                <?php // echo $form->labelEx($model, 'branch_name', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-9">
                                    <?php echo $form->textFieldRow($model, 'branch_name', array('class' => 'span5 form-control', 'maxlength' => 45)); ?>       
                                    <?php echo $form->error($model, 'branch_name', array('style' => 'color:red;')); ?>
                                </div>
                            </div><!--/form-group--> 
                            <div class="form-group">
                                <?php // echo $form->labelEx($model, 'branch_address', array('class' => 'col-sm-3 control-label')); ?>
                                <div class="col-sm-9" style="margin-bottom:  30px;">
                                    <?php echo $form->textFieldRow($model, 'branch_address', array('class' => 'span5 form-control', 'maxlength' => 45)); ?>       
                                    <?php echo $form->error($model, 'branch_address', array('style' => 'color:red;')); ?>
                                </div >
                            </div><!--/form-group--> 
                            <div class="bottom">
                                <?php
                                $this->widget('bootstrap.widgets.TbButton', array(
                                    'buttonType' => 'submit',
                                    'type' => 'primary',
                                    'label' => $model->isNewRecord ? 'Create' : 'Save',
                                ));
                                ?>
                                <a href="<?php echo Yii::app()->request->getBaseUrl(); ?>/index.php/branchMaster_parent" class="btn btn-default" >Cancel</a>
                            </div><!--/form-group-->
                            <!--</form>-->
                            <?php $this->endWidget(); ?>
                        </div><!--/porlets-content-->
                    </div>
                </div>

                <div id="user-activities" class="tab-pane">
                    <ul class="media-list">
                        <li class="media"> <a href="#">
                                <p><strong>John Doe</strong> Uploaded a photo <strong>"DSC000254.jpg"</strong> <br>
                                    <i>2 minutes ago</i></p>
                            </a> </li>
                        <li class="media"> <a href="#">
                                <p><strong>Imran Tahir</strong> Created an photo album <strong>"Indonesia Tourism"</strong> <br>
                                    <i>8 minutes ago</i></p>
                            </a> </li>
                        <li class="media"> <a href="#">
                                <p><strong>Colin Munro</strong> Posted an article <strong>"London never ending Asia"</strong> <br>
                                    <i>an hour ago</i></p>
                            </a> </li>
                        <li class="media"> <a href="#">
                                <p><strong>Corey Anderson</strong> Added 3 products <br>
                                    <i>3 hours ago</i></p>
                            </a> </li>
                        <li class="media"> <a href="#">
                                <p><strong>Morne Morkel</strong> Send you a message <strong>"Lorem ipsum dolor..."</strong> <br>
                                    <i>12 hours ago</i></p>
                            </a> </li>
                        <li class="media"> <a href="#">
                                <p><strong>Imran Tahir</strong> Updated his avatar <br>
                                    <i>Yesterday</i></p>
                            </a> </li>
                    </ul>
                </div>
                <div id="mymessage" class="tab-pane">
                    <ul class="media-list">
                        <li class="media"> <a href="#" class="pull-left"> <img alt="Avatar" src="images/avatar.jpg" class="media-object"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#fakelink">John Doe</a> <small>Just now</small></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                            </div>
                        </li>
                        <li class="media"> <a href="#" class="pull-left"> <img alt="Avatar" src="images/avatar.jpg" class="media-object"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#fakelink">Tim Southee</a> <small>Yesterday at 04:00 AM</small></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus</p>
                            </div>
                        </li>
                        <li class="media"> <a href="#" class="pull-left"> <img alt="Avatar" src="images/avatar.jpg" class="media-object"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#fakelink">Kane Williamson</a> <small>January 17, 2014 05:35 PM</small></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                            </div>
                        </li>
                        <li class="media"> <a href="#" class="pull-left"> <img alt="Avatar" src="images/avatar.jpg" class="media-object"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#fakelink">Lonwabo Tsotsobe</a> <small>January 17, 2014 05:35 PM</small></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                            </div>
                        </li>
                        <li class="media"> <a href="#" class="pull-left"> <img alt="Avatar" src="images/avatar.jpg" class="media-object"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#fakelink">Dale Steyn</a> <small>January 17, 2014 05:35 PM</small></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                            </div>
                        </li>
                        <li class="media"> <a href="#" class="pull-left"> <img alt="Avatar" src="images/avatar.jpg" class="media-object"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#fakelink">John Doe</a> <small>Just now</small></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!--/tab-content--> 
        </div><!--/block-web--> 
        <div class="block-web">
            <div class="row">
                <div class="col-md-6">
                    <div class="block-web">
                        <h3 class="content-header"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/pie_graph.png"/>Your Branch Statistics
                            <br/>
                            <br/>
                            <div data-toggle="buttons" class="button-group " style="margin-left: 10px;"> 
                                <a class="btn small  border-gray active" href="javascript:;"> <span class="button-content" style=" padding: 5px; ">
                                        <input type="radio" name="dashboard_radio_index" value="today">
                                        Today </span> </a> 
                                <a class="btn small border-gray" href="javascript:;"> <span class="button-content" style=" padding: 5px; ">
                                        <input type="radio" name="dashboard_radio_index"  value="weekly">
                                        Weekly </span> </a> 
                                <a class="btn small border-gray" href="javascript:;"> <span class="button-content" style=" padding: 5px; ">
                                        <input type="radio" name="dashboard_radio_index"  value="montly">
                                        Monthly </span> </a>
                                <a class="btn small border-gray" href="javascript:;"> <span class="button-content" style=" padding: 5px; ">
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
                <div class="col-md-6" style="margin-top: 55px;" >
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
        </div>
        <div class="block-web">
            <div class="row">
                <div class="col-md-12">
                    <div class="block-web">
                        <h3 class="content-header"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/line_graph.png"/> Quick Stats
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
                            <h3> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/calculator.png"/>Customer Count <strong><?php echo BranchDashboard_helper::getTotalCustomerForBranches($model->id); ?></strong></h3>
                            <table class="table margin-top-20 today" width="100%" border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                    <td class="fa-border">
                                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/plus.png"/> 
                                        <strong><?php echo BranchDashboard_helper::getTotalNewCustomers($model->id); ?></strong>
                                    </td>
                                    <td class="fa-border">
                                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/male.png"/> 
                                        <strong><?php echo BranchDashboard_helper::getTotalMALECustomerForBranches($model->id); ?></strong>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="fa-border">
                                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/reload.png"/> 
                                        <strong><?php echo BranchDashboard_helper::getTotalRepeateCustomers($model->id); ?></strong>
                                    </td>
                                    <td class="fa-border">
                                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/female.png"/> 
                                        <strong><?php echo BranchDashboard_helper::getTotalFEMALECustomerForBranches($model->id); ?></strong>
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
                                    <?php BranchDashboard_helper::getAgeBoundsForCustomerForBranches($model->id); ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div><!--/row end-->
            </div>
        </div>
        <div class="block-web">
            <div class="row">
                <div class="col-md-12">
                    <div class="block-web">
                        <h3 class="content-header"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/report.png"/> Feedback Across Category
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
        </div>
        <div class="block-web">
            <div class="row">
                <div class="col-md-12">
                    <div class="block-web">
                        <h3 class="content-header"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/report_time.png"/>Visitors Feedback Over Time
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
        </div>
    </div><!--/col-md-8--> 
    <div class="col-sm-9 col-lg-10">


    </div><!-- /col-sm-9 --> 
</div><!--/row--> 






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
