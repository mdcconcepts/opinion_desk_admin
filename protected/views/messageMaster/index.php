<div class="row">
    <div class="col-md-12">
        <h2>Message</h2>
    </div><!--/col-md-12--> 
</div><!--/row-->

<div class="row">
    <div class="col-sm-3 col-lg-2"> 
        <ul class="nav nav-pills nav-stacked nav-email">
            <li   class="active"> <a href="<?php echo Yii::app()->request->baseUrl . "/index.php/messageMaster/"; ?>"> <span class="badge pull-right"><?php echo MessageHelper::getUnreadMessageCount(); ?></span> <i class="glyphicon glyphicon-inbox"></i> Inbox </a> </li>
            <li><a href="<?php echo Yii::app()->request->baseUrl . "/index.php/messageMaster/archive"; ?>"><i class="glyphicon glyphicon-star"></i> Starred</a></li>
        </ul>
    </div><!-- col-sm-3 -->

    <div class="col-sm-9 col-lg-10">
        <div class="block-web">
            <div class="porlets-content">
                <strong>Inbox</strong>
                <div class="table-responsive">
                    <table class="display table table-email" id="hidden-table-info">
                        <thead style="display: none;">
                            <tr>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Browser</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($messages as $message) {
                                ?>
                                <tr <?php
                                if ($message->read_status == 0) {
                                    echo ' class="unread"';
                                }
                                ?>>
                                    <td><div class="ckbox ckbox-primary">
                                            <input type="checkbox" id="checkbox1">
                                            <label for="checkbox1"></label>
                                        </div></td>
                                    <td><a class="star <?php
                                        if ($message->is_archive == 1) {
                                            echo 'star-checked';
                                        }
                                        ?>" href=""><i class="glyphicon glyphicon-star"></i></a>
                                    </td>
                                    <td>
                                        <a href="<?php echo Yii::app()->request->baseUrl . "/index.php/messageMaster/view/" . $message->id; ?>" style="text-decoration: none;">
                                            <div class="media">
                                                <div class="media-body"> <span class="media-meta pull-right"><?php echo date("jS F Y g:ia ", strtotime($message->schedule_timestamp)); ?></span>
                                                    <h4 class="text-primary">Admin</h4>
                                                    <small class="text-muted"></small>
                                                    <p class="email-summary"><?php echo substr($message->message, strlen($message->message) * -1, 50); ?>... </p>

                                                </div>
                                            </div>
                                        </a> 
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div><!--/table-responsive-->

            </div><!--/porlets-content-->  
        </div><!--/ block-web --> 
    </div><!-- /col-sm-9 --> 
</div><!--/row--> 