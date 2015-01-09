<div class = "leftside-navigation">
    <div class = "sidebar-section sidebar-user clearfix">
        <div class = "sidebar-user-avatar" title="Profile"> <a href = "<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/profile"> <img alt = "avatar" src = "<?php echo Yii::app()->request->baseUrl . '/' . User::model()->findByPK(Yii::app()->user->id)->profile->organisation_logo; ?>"> </a></div>
        <div class = "sidebar-user-name" title="Profile"><a  href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/profile"><?php echo Yii::app()->user->name; ?></a></div>
        <div class = "sidebar-user-links" > <a title = "" data-placement = "bottom" data-toggle = "" href = "<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/profile" data-original-title = "User"><i class = "fa fa-user"></i></a> 
            <a title="Profile" title = "" data-placement = "bottom" data-toggle = "" href = "inbox.html" data-original-title = "Messages"><i class = "fa fa-envelope-o"></i></a> 
            <a title="Logout" title = "" data-placement = "bottom" data-toggle = "" href = "<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/logout" data-original-title = "Logout"><i class = "fa fa-sign-out"></i></a> 
        </div>
    </div>
    <?php
    $Branches = BranchMaster::model()->findAll(array(
        'condition' => 'customer_id = :customer_id',
        'params' => array(':customer_id' => Yii::app()->user->id)
    ));
    ?>
    <ul id = "nav-accordion" class = "sidebar-menu">
        <li> <a href = "<?php echo Yii::app()->request->baseUrl; ?>/index.php" <?php
            if (Yii::app()->controller->id == 'site') {
                echo 'class = "active"';
            }
            ?>>
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/left_menu/<?php
                if (Yii::app()->controller->id == 'site') {
                    echo 'selected/';
                }
                ?>home.png"/> <span>Home</span> </a> 
        </li>
        <?php
        if (UserModule::isAdmin()) {
            ?>
            <li> <a href = "<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/admin" <?php
                if (Yii::app()->controller->id == 'admin') {
                    echo 'class = "active"';
                }
                ?>>
                    <i class = "fa fa-dashboard"></i> <span>Manage User</span> </a> 
            </li>

            <?php
        } else {
            ?>
            <li class="sub-menu dcjq-parent-li"> <a href="javascript:;" class="dcjq-parent <?php
                if (Yii::app()->controller->id == 'branchMaster_parent') {
                    echo 'active';
                }
                ?>"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/left_menu/<?php
                                                        if (Yii::app()->controller->id == 'branchMaster_parent') {
                                                            echo 'selected/';
                                                        }
                                                        ?>branch.png"/> <span>My Branches</span></a>
                <ul class="sub">

                    <?php
                    foreach ($Branches as $Branch) {
                        ?>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/branchMaster_parent/<?php echo $Branch->id; ?>"><i class="fa fa-angle-right"></i> <?php echo $Branch->branch_name; ?></a></li>
                        <?php
                    }
                    ?>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/branchMaster_parent/create"><i class="fa fa-angle-right"></i> Create Branch</a></li>

                </ul>
            </li>
            <li class="sub-menu dcjq-parent-li"> <a href="javascript:;" class="dcjq-parent <?php
                if (Yii::app()->controller->id == 'responceMaster_child') {
                    echo 'active';
                }
                ?>"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/left_menu/<?php
                                                        if (Yii::app()->controller->id == 'responceMaster_child') {
                                                            echo 'selected/';
                                                        }
                                                        ?>report.png"/><span>Reports</span></a>
                <ul class="sub">

                    <?php
                    foreach ($Branches as $Branch) {
                        ?>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/ResponceMaster_child/viewbranchreport?branch_id=<?php echo $Branch->id; ?>"><i class="fa fa-angle-right"></i> <?php echo $Branch->branch_name; ?></a></li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <li class="sub-menu dcjq-parent-li"> <a href="javascript:;" class="dcjq-parent <?php
                if (Yii::app()->controller->id == 'testimonials') {
                    echo 'active';
                }
                ?>"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/left_menu/<?php
                                                        if (Yii::app()->controller->id == 'testimonials') {
                                                            echo 'selected/';
                                                        }
                                                        ?>testi.png"/><span>Testimonials</span></a>
                <ul class="sub">

                    <?php
                    foreach ($Branches as $Branch) {
                        ?>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/testimonials?branch_id=<?php echo $Branch->id; ?>"><i class="fa fa-angle-right"></i> <?php echo $Branch->branch_name; ?></a></li>
                            <?php
                        }
                        ?>
                </ul>
            </li>

            <?php
        }
        ?>


    </ul><!--/nav-accordion sidebar-menu-->
</div><!--/leftside-navigation-->