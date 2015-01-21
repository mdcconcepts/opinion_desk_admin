
<div class="row">
    <div class="col-md-12">
        <h2>View Mail</h2>
    </div><!--/col-md-12--> 
</div><!--/row-->

<div class="row">
    <div class="col-sm-3 col-lg-2"> 
        <ul class="nav nav-pills nav-stacked nav-email">
            <li><a href="<?php echo Yii::app()->request->baseUrl . "/index.php/messageMaster/"; ?>"> <span class="badge pull-right"><?php echo MessageHelper::getUnreadMessageCount(); ?></span> <i class="glyphicon glyphicon-inbox"></i> Inbox </a> </li>
            <li><a href="#"><i class="glyphicon glyphicon-star"></i> Starred</a></li>
        </ul>
    </div><!-- col-sm-3 -->
    <!-- col-sm-3 -->

    <div class="col-sm-9 col-lg-10">
        <div class="block-web">
            <div class="pull-right">
                <div class="btn-group">
                    <button title="" data-toggle="tooltip" type="button" class="btn btn-white tooltips" data-original-title="Archive"><i class="glyphicon glyphicon-hdd"></i></button>
                    <button title="" data-toggle="tooltip" type="button" class="btn btn-white tooltips" data-original-title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
                </div>
            </div>


            <!--            <div class="btn-group">
                            <button title="" data-toggle="tooltip" type="button" class="btn btn-white tooltips" data-original-title="Read Previous Email"><i class="glyphicon glyphicon-chevron-left"></i></button>
                            <button title="" data-toggle="tooltip" type="button" class="btn btn-white tooltips" data-original-title="Read Next Email"><i class="glyphicon glyphicon-chevron-right"></i></button>
                        </div>-->
            <div class="read-panel">
                <div class="media"> <a class="pull-left" href="#"> <img class="media-object" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/admin.png" alt=""> </a>
                    <div class="media-body"> <span class="media-meta pull-right"><?php echo date("jS F Y g:ia ", strtotime($model->schedule_timestamp)); ?></span>
                        <h4 class="text-primary"><?php echo $model->subject; ?></h4>
                        <small class="text-muted">From: Admin</small> </div>
                </div>

                <?php echo $model->message; ?>
            </div><!--/ read-panel -->    
        </div><!--/ block-web --> 
    </div><!-- /col-sm-9 --> 
</div><!--/row--> 