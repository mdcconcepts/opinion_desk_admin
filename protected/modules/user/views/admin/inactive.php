<div class="row">
    <div class="col-sm-3 col-lg-2" style="position: relative;margin-top: 30px;"> 
        <ul class="nav nav-pills nav-stacked nav-email" style="position: fixed;border: 2px solid #44AFB0;border-top-left-radius: 9px;border-top-right-radius: 9px;">
            <li title="View Active Customer"> <a href="<?php echo Yii::app()->createUrl("/user/admin"); ?>"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/selected/branches_menu.png"/> Active Customer </a> </li>
            <li title="View Inactive Customer"  class="active"><a href="<?php echo Yii::app()->createUrl("/user/admin/inactive"); ?>">   <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/question_report.png"/> Inactive Customer</a></li>
            <li title="View Banned Customer"><a href="<?php echo Yii::app()->createUrl("/user/admin/banned"); ?>">   <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/question_testi.png"/> Banned Customer</a></li>
        </ul>

    </div><!-- col-sm-3 -->
    <div class="col-md-10">
        <div class="block-web">
            <div class="header">
                <h3 class="content-header">All Inactive Customer</h3>
            </div>
            <div class="porlets-content">
                <?php if (Yii::app()->user->hasFlash('error')): ?>
                    <div class="alert alert-danger"> 
                        <?php echo Yii::app()->user->getFlash('error'); ?>
                    </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table  class="display table table-bordered table-striped User_Table">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Status(s)</th>
                                <th>Registration Date</th>
                                <th>Expire At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $Users = User::model()->findAll(array(
                                'condition' => 'status = :status',
                                'params' => array(':status' => 0)
                            ));
                            foreach ($Users as $user) {
                                ?>
                                <tr class="gradeX">
                                    <td><?php echo $user->username; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td><a href="#" class="status" data-type="select" data-pk="<?php echo $user->id; ?>" data-value="" data-title="Select Status"><?php echo User::itemAlias('UserStatus', $user->status); ?></a></td>
                                    <td><?php echo $user->create_at; ?></td>
                                    <td><?php echo date("Y-m-d", strtotime($user->create_at) + (3.156e+7)); ?></td>
                                    <td><a class="badge badge-info" title="View Profile" data-toggle="tooltip" href="/account/index.php/user/admin/view/id/<?php echo $user->id; ?>">
                                            <i class="fa fa-user"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div><!--/table-responsive-->
            </div><!--/porlets-content-->


        </div><!--/block-web--> 
    </div><!--/col-md-12--> 
</div><!--/row-->