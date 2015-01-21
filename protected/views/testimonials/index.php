<?php
if (!isset($_GET['media'])&&!isset($_GET['feedback'])) {
//    $branch_id = $Branches[0]->id;
    $this->redirect(Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $_GET['branch_id'] . '&media=all&feedback=all');
}
$Branch = BranchMaster::model()->findAll(array(
            'condition' => 'id = :branch_id',
            'params' => array(':branch_id' => $_GET['branch_id'])
        ))[0];
?>
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
        <h2>  <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/testimonials/testimonials_big.png"/>  View Testimonials (<?php echo $Branch->branch_name ?>)</h2>
    </div><!--/col-md-12--> 
</div><!--/row-->
<div class="row">
    <div class="col-sm-3 col-lg-2" style="position: relative;margin-top: 30px;"> 
        <ul class="nav nav-pills nav-stacked nav-email" style="position: fixed;border: 2px solid #44AFB0;border-top-left-radius: 9px;border-top-right-radius: 9px;">
            <li <?php
            if ($_GET['media'] == 'all') {
                echo 'class = "active"';
            }
            ?> ><a href = "<?php echo Yii::app()->createUrl("testimonials?branch_id=" . $_GET['branch_id'] . "&media=all&feedback=all"); ?>"><img src = "<?php echo Yii::app()->theme->baseUrl; ?>/images/testimonials/<?php
                        if ($_GET['media'] == 'all') {
                            echo 'selected/';
                        }
                        ?>all.png"/>All Format</a></li>
            <li <?php
            if ($_GET['media'] == 'text') {
                echo 'class = "active"';
            }
            ?>> <a href = "<?php echo Yii::app()->createUrl("testimonials?branch_id=" . $_GET['branch_id'] . "&media=text&feedback=all"); ?>"> <img src = "<?php echo Yii::app()->theme->baseUrl; ?>/images/testimonials/<?php
                        if ($_GET['media'] == 'text') {
                            echo 'selected/';
                        }
                        ?>text.png"/> Text Format </a> </li>
            <li <?php
            if ($_GET['media'] == 'vedio') {
                echo 'class = "active"';
            }
            ?>><a href = "<?php echo Yii::app()->createUrl("testimonials?branch_id=" . $_GET['branch_id'] . "&media=vedio&feedback=all"); ?>"> <img src = "<?php echo Yii::app()->theme->baseUrl; ?>/images/testimonials/<?php
                        if ($_GET['media'] == 'vedio') {
                            echo 'selected/';
                        }
                        ?>video.png"/> Video Format</a></li>
            <li <?php
            if ($_GET['media'] == 'audio') {
                echo 'class = "active"';
            }
            ?>><a href = "<?php echo Yii::app()->createUrl("testimonials?branch_id=" . $_GET['branch_id'] . "&media=audio&feedback=all"); ?>"><img src = "<?php echo Yii::app()->theme->baseUrl; ?>/images/testimonials/<?php
                        if ($_GET['media'] == 'audio') {
                            echo 'selected/';
                        }
                        ?>audio.png"/> Audio Format </a></li>

        </ul>
    </div><!--col-sm-3 -->
    <div class = "col-sm-9 col-lg-10" style = " margin-top: 29px; ">

        <div class = "block-web">

            <div class = "row">
                <?php
                switch ($_GET['media']) {
                    case 'all':
                        ?>
                        <img src = "<?php echo Yii::app()->theme->baseUrl; ?>/images/testimonials/all.png"/>
                        <strong style="color: #44AFB0;">All Format</strong>
                        <?php
                        break;
                    case 'text':
                        ?>
                        <img src = "<?php echo Yii::app()->theme->baseUrl; ?>/images/testimonials/text.png"/>
                        <strong style="color: #44AFB0;">Text Format</strong>
                        <?php
                        break;
                    case 'vedio':
                        ?>
                        <img src = "<?php echo Yii::app()->theme->baseUrl; ?>/images/testimonials/video.png"/>
                        <strong style="color: #44AFB0;">Video Format</strong>
                        <?php
                        break;
                    case 'audio':
                        ?>
                        <img src = "<?php echo Yii::app()->theme->baseUrl; ?>/images/testimonials/audio.png"/>
                        <strong style="color: #44AFB0;">Audio Format</strong>
                        <?php
                        break;

                    default:
                        break;
                }
                ?>
                <div>
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'tablet-master-form',
                        'htmlOptions' => array(
                        ),
                        'enableAjaxValidation' => false,
                    ));
                    ?>
                    <input style="display: none;" value="<?php echo $_GET['branch_id'] ?>" name="branch_id" />
                    <input style="display: none;" value="<?php echo $_GET['feedback'] ?>" name="feedback" />

                    <div>
                        <?php
                        $this->widget('bootstrap.widgets.TbButton', array(
                            'buttonType' => 'submit',
                            'type' => 'primary',
                            'htmlOptions' => array(
                                'style' => 'float: right;margin-right: 30px;',
                            ),
                            'label' => $model->isNewRecord ? 'Create' : 'Export',
                        ));
                        ?>
                    </div><!--/form-group-->
                    <!--</form>-->
                    <?php $this->endWidget();
                    ?>
                </div>
                <div class="btn-group" style="float: right;margin-right: 30px;">
                    <button class="btn btn-primary"> <?php TestimonialsHelper::getSelectedFeedbackValueStars(); ?></button>
                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"> <span class="caret"></span> </button>
                    <ul class="dropdown-menu">
                        <li> <a href="<?php echo Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $_GET['branch_id'] . '&media=' . $_GET['media'] . '&feedback=0'; ?> ">
                                <?php
                                for ($index = 0; $index < 5; $index++) {
                                    ?>
                                    <i class="fa fa-star-o"></i> 
                                    <?php
                                }
                                ?></a> </li>
                        <li> <a href="<?php echo Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $_GET['branch_id'] . '&media=' . $_GET['media'] . '&feedback=1'; ?> "><i class="fa fa-star"></i> <?php
                                for ($index = 0; $index < 4; $index++) {
                                    ?>
                                    <i class="fa fa-star-o"></i> 
                                    <?php
                                }
                                ?> </a> </li>
                        <li> <a href="<?php echo Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $_GET['branch_id'] . '&media=' . $_GET['media'] . '&feedback=2'; ?> "><i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i><?php
                                for ($index = 0; $index < 3; $index++) {
                                    ?>
                                    <i class="fa fa-star-o"></i> 
                                    <?php
                                }
                                ?> </a> </li>
                        <li> <a href="<?php echo Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $_GET['branch_id'] . '&media=' . $_GET['media'] . '&feedback=3'; ?> "><?php
                                for ($index = 0; $index < 3; $index++) {
                                    ?>
                                    <i class="fa fa-star"></i> 
                                    <?php
                                }
                                ?> <i class="fa fa-star-o"></i> 
                                <i class="fa fa-star-o"></i> </a> </li>
                        <li> <a href="<?php echo Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $_GET['branch_id'] . '&media=' . $_GET['media'] . '&feedback=4'; ?> "><?php
                                for ($index = 0; $index < 4; $index++) {
                                    ?>
                                    <i class="fa fa-star"></i> 
                                    <?php
                                }
                                ?> <i class="fa fa-star-o"></i> 
                            </a> 
                        </li>
                        <li> <a href="<?php echo Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $_GET['branch_id'] . '&media=' . $_GET['media'] . '&feedback=5'; ?> "><?php
                                for ($index = 0; $index < 5; $index++) {
                                    ?>
                                    <i class="fa fa-star"></i> 
                                    <?php
                                }
                                ?> 
                            </a> 
                        </li>
                        <li> <a href="<?php echo Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $_GET['branch_id'] . '&media=' . $_GET['media'] . '&feedback=all'; ?> "> All
                            </a> 
                        </li>

                    </ul>
                </div>
            </div>
            <hr/>
            <div class = "block-web">
                <div class="row">
                    <?php
                    foreach ($testimonials as $testimonial) {


                        if (($testimonial['responce_text'] == '') && $_GET['media'] == 'text') {
                            continue;
                        }
                        if (($testimonial['responce_vedio_url'] == '') && $_GET['media'] == 'vedio') {
                            continue;
                        }
                        if (($testimonial['responce_audio_url'] == '') && $_GET['media'] == 'audio') {
                            continue;
                        }
                        ?>
                        <?php
                        if (($testimonial['responce_audio_url'] != '')) {
                            ?>
                            <div class="col-lg-6">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <p>
                                                <?php
                                                if (!isset($_GET['feedback'])) {
                                                    for ($index = 0; $index < 5; $index++) {
                                                        ?>
                                                        <i class="fa fa-star-o"></i> 
                                                        <?php
                                                    }
                                                } else {


                                                    switch ($testimonial['Total_AVG']) {
                                                        case 0:
                                                            for ($index = 0; $index < 5; $index++) {
                                                                ?>
                                                                <i class="fa fa-star-o"></i> 
                                                                <?php
                                                            }
                                                            break;
                                                        case 1:
                                                            ?> <i class = "fa fa-star"></i> <?php
                                                            for ($index = 0; $index < 4; $index++) {
                                                                ?>
                                                                <i class="fa fa-star-o"></i> 
                                                                <?php
                                                            }
                                                            break;
                                                        case 2:
                                                            ?>
                                                            <i class="fa fa-star"></i> 
                                                            <i class="fa fa-star"></i><?php
                                                            for ($index = 0; $index < 3; $index++) {
                                                                ?>
                                                                <i class="fa fa-star-o"></i> 
                                                                <?php
                                                            }
                                                            break;
                                                        case 3:
                                                            for ($index = 0; $index < 3; $index++) {
                                                                ?>
                                                                <i class="fa fa-star"></i> 
                                                                <?php
                                                            }
                                                            ?> <i class="fa fa-star-o"></i> 
                                                            <i class="fa fa-star-o"></i> </a> 
                                                            <?php
                                                            break;
                                                        case 4:
                                                            for ($index = 0; $index < 4; $index++) {
                                                                ?>
                                                                <i class="fa fa-star"></i> 
                                                                <?php
                                                            }
                                                            ?> <i class="fa fa-star-o"></i> <?php
                                                            break;
                                                        case 5:

                                                            for ($index = 0; $index < 5; $index++) {
                                                                ?>
                                                                <i class="fa fa-star"></i> 
                                                                <?php
                                                            }
                                                            break;
                                                        default:
                                                            break;
                                                    }
                                                }
                                                ?>

                                            </p>
                                            <b><?php echo $testimonial['name'] ?></b>
                                            <b><?php echo $testimonial['mobile_no'] ?></b>
                                            <p style="font-size: 12px;"><?php echo date('jS \, F Y '); ?></p>

                                        </div>
                                        <div class="col-lg-12">
                                            <?php
                                            if (isset($testimonial['responce_audio_url'])) {
                                                ?>
                                                <video id="example_video_1" class="video-js vjs-default-skin"controls preload="none" height="100" width="400"
                                                       data-setup="{}">
                                                    <source src="http://opiniondesk.in/account/<?php echo $testimonial['responce_audio_url']; ?>" type='video/mp4' />
                                                </video>
                                                <?php
                                            }
                                            ?>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            continue;
                        }
                        ?>
                        <div class="col-lg-6">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-4">

                                        <p>
                                            <?php
                                            if (!isset($_GET['feedback'])) {
                                                for ($index = 0; $index < 5; $index++) {
                                                    ?>
                                                    <i class="fa fa-star-o"></i> 
                                                    <?php
                                                }
                                            } else {


                                                switch ($testimonial['Total_AVG']) {
                                                    case 0:
                                                        for ($index = 0; $index < 5; $index++) {
                                                            ?>
                                                            <i class="fa fa-star-o"></i> 
                                                            <?php
                                                        }
                                                        break;
                                                    case 1:
                                                        ?> <i class = "fa fa-star"></i> <?php
                                                        for ($index = 0; $index < 4; $index++) {
                                                            ?>
                                                            <i class="fa fa-star-o"></i> 
                                                            <?php
                                                        }
                                                        break;
                                                    case 2:
                                                        ?>
                                                        <i class="fa fa-star"></i> 
                                                        <i class="fa fa-star"></i><?php
                                                        for ($index = 0; $index < 3; $index++) {
                                                            ?>
                                                            <i class="fa fa-star-o"></i> 
                                                            <?php
                                                        }
                                                        break;
                                                    case 3:
                                                        for ($index = 0; $index < 3; $index++) {
                                                            ?>
                                                            <i class="fa fa-star"></i> 
                                                            <?php
                                                        }
                                                        ?> <i class="fa fa-star-o"></i> 
                                                        <i class="fa fa-star-o"></i> </a> 
                                                        <?php
                                                        break;
                                                    case 4:
                                                        for ($index = 0; $index < 4; $index++) {
                                                            ?>
                                                            <i class="fa fa-star"></i> 
                                                            <?php
                                                        }
                                                        ?> <i class="fa fa-star-o"></i> <?php
                                                        break;
                                                    case 5:

                                                        for ($index = 0; $index < 5; $index++) {
                                                            ?>
                                                            <i class="fa fa-star"></i> 
                                                            <?php
                                                        }
                                                        break;
                                                    default:
                                                        break;
                                                }
                                            }
                                            ?>

                                        </p>
                                        <b><?php echo $testimonial['name'] ?></b>
                                        <b><?php echo $testimonial['mobile_no'] ?></b>
                                        <p style="font-size: 12px;"><?php echo date('jS \, F Y '); ?></p>

                                    </div>
                                    <div class="col-lg-8">
                                        <?php
                                        if ($testimonial['responce_text'] != "") {
                                            ?>
                                            <p style="color: #515151;"> <?php echo $testimonial['responce_text'] ?><p>
                                                <?php
                                            } elseif (isset($testimonial['responce_vedio_url'])) {
                                                ?>
                                            <div class="panel" style="padding: 10px;">
                                                <iframe id="player" type="text/html" style="width: 100%;"
                                                        src="http://www.youtube.com/embed/<?php echo $testimonial['responce_vedio_url'] ?>"
                                                        frameborder="0">
                                                </iframe>
                                            </div>
                                            <?php
                                        } elseif (isset($testimonial['responce_audio_url'])) {
                                            ?>
                                            <video id="example_video_1" class="video-js vjs-default-skin" style="width: 100%;" controls preload="none" height="50"
                                                   data-setup="{}">
                                                <source src="<?php echo $testimonial['responce_audio_url']; ?>" type='video/mp4' />
                                            </video>
                                            <?php
                                        }
                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php /*
              <div class="row">
              <div class="col-md-12">
              <div class="porlets-content">



              <div class="table-responsive">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
              <th>Customer Name</th>
              <th>Customer Phone</th>
              <th>Text Testimonials</th>
              <th>Video Testimonials</th>
              <th>Audio Testimonials</th>
              </tr>
              </thead>
              <tbody>
              <?php
              foreach ($testimonials as $testimonial) {
              ?>
              <tr class="gradeX">
              <td><?php echo $testimonial['name'] ?></td>
              <td><?php echo $testimonial['mobile_no'] ?></td>
              <td><?php echo $testimonial['responce_text'] ?></td>
              <td><?php echo $testimonial['responce_audio_url'] ?></td>
              <td>
              <iframe id="player" type="text/html" width="400" height="200"
              src="http://www.youtube.com/embed/<?php echo $testimonial['responce_vedio_url'] ?>"
              frameborder="0"></iframe>
              </td>
              </tr>
              <?php
              }
              ?>

              </tbody>
              <tfoot>
              <tr>
              <th>Rendering engine</th>
              <th>Browser</th>
              <th>Platform(s)</th>
              <th class="hidden-phone">Engine version</th>
              <th class="hidden-phone">CSS grade</th>
              </tr>
              </tfoot>
              </table>
              </div><!--/table-responsive-->


              </div><!--/porlets-content-->
              </div><!--/col-md-12-->
              </div>
             * 
             */
            ?>

        </div><!--/ block-web --> 
    </div><!-- /col-sm-9 --> 
</div><!--/row--> 
