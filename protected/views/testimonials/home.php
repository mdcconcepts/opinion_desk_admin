
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h2>Testimonials</h2>
    </div>
    <?php
    $Branches = BranchMaster::model()->findAll(array(
        'condition' => 'customer_id = :customer_id',
        'params' => array(':customer_id' => Yii::app()->user->id)
    ));

    foreach ($Branches as $Branch) {
        ?>


        <div class="col-sm-4 col-md-3">
            <div class="block-web primary-box" onclick="location.href = '<?php echo Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $Branch->id . '&media=all&feedback=all'; ?>';" style="cursor: pointer;">
                <h3 ><?php echo $Branch->branch_name ?></h3>
                <!--                <div class="header" style=" padding: 22px; ">
                                                        
                                                    </div>-->
                <!--                <h3 class="content-header"> Your Branch Statistics
                                    </h3>-->
<!--                <table class="table margin-top-20 today" width="100%" border="0" cellspacing="0" cellpadding="0" >
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
                </table>-->
            </div>
        </div>

        <?php
//    echo json_encode($Branch->branch_name);
    }
    ?>
<!--    <div class="col-sm-4 col-md-4">
        <a href="<?php // echo Yii::app()->request->baseUrl . '/index.php//branchMaster_parent/create'; ?>" class="btn btn-primary" style=" font-size: 136px;"> 
            +
        </a>
    </div>-->
</div>
