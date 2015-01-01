<?php
if (!isset($_GET['branch_id'])) {
    $Branches = BranchMaster::model()->findAll(array(
        'condition' => 'customer_id = :customer_id',
        'params' => array(':customer_id' => Yii::app()->user->id)
    ));
    $branch_id = $Branches[0]->id;
    $this->redirect(Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $branch_id);
}
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
        <h2><i class="fa fa-dashboard"></i>View Testimonials</h2>
    </div><!--/col-md-12--> 
</div><!--/row-->
<div class="row">
    <div class="col-sm-3 col-lg-2" style="position: relative;"> 
        <ul class="nav nav-pills nav-stacked nav-email" style="position: fixed;">
            <?php
            $Branches = BranchMaster::model()->findAll(array(
                'condition' => 'customer_id = :customer_id',
                'params' => array(':customer_id' => Yii::app()->user->id)
            ));

            foreach ($Branches as $Branch) {
                ?>
                <li <?php
                if ($Branch->id == $_GET['branch_id']) {
                    echo ' class="active" ';
                }
                ?>><a href="<?php echo Yii::app()->createUrl("testimonials?branch_id=" . $Branch->id); ?>"><i class="glyphicon glyphicon-briefcase"></i> <?php echo $Branch->branch_name; ?></a></li>
                    <?php
                }
                ?>
        </ul>
    </div><!-- col-sm-3 -->

    <div class="col-sm-9 col-lg-10">

        <div class="block-web">

            <div class="row">
                <div>
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'tablet-master-form',
                        'htmlOptions' => array(
//                            'class' => 'form-horizontal row-border',
                        ),
// Please note: When you enable ajax validation, make sure the corresponding
// controller action is handling ajax validation correctly.
// There is a call to performAjaxValidation() commented in generated controller code.
// See class documentation of CActiveForm for details on this.
                        'enableAjaxValidation' => false,
                            // 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
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
                    <button class="btn btn-primary"> Feedbacks</button>
                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"> <span class="caret"></span> </button>
                    <ul class="dropdown-menu">
                        <li> <a href="<?php echo Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $_GET['branch_id'] . '&feedback=0'; ?> ">
                                <?php
                                for ($index = 0; $index < 5; $index++) {
                                    ?>
                                    <i class="fa fa-star-o"></i> 
                                    <?php
                                }
                                ?></a> </li>
                        <li> <a href="<?php echo Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $_GET['branch_id'] . '&feedback=1'; ?> "><i class="fa fa-star"></i> <?php
                                for ($index = 0; $index < 4; $index++) {
                                    ?>
                                    <i class="fa fa-star-o"></i> 
                                    <?php
                                }
                                ?> </a> </li>
                        <li> <a href="<?php echo Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $_GET['branch_id'] . '&feedback=2'; ?> "><i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i><?php
                                for ($index = 0; $index < 3; $index++) {
                                    ?>
                                    <i class="fa fa-star-o"></i> 
                                    <?php
                                }
                                ?> </a> </li>
                        <li> <a href="<?php echo Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $_GET['branch_id'] . '&feedback=3'; ?> "><?php
                                for ($index = 0; $index < 3; $index++) {
                                    ?>
                                    <i class="fa fa-star"></i> 
                                    <?php
                                }
                                ?> <i class="fa fa-star-o"></i> 
                                <i class="fa fa-star-o"></i> </a> </li>
                        <li> <a href="<?php echo Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $_GET['branch_id'] . '&feedback=4'; ?> "><?php
                                for ($index = 0; $index < 4; $index++) {
                                    ?>
                                    <i class="fa fa-star"></i> 
                                    <?php
                                }
                                ?> <i class="fa fa-star-o"></i> 
                            </a> 
                        </li>
                        <li> <a href="<?php echo Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $_GET['branch_id'] . '&feedback=5'; ?> "><?php
                                for ($index = 0; $index < 5; $index++) {
                                    ?>
                                    <i class="fa fa-star"></i> 
                                    <?php
                                }
                                ?> 
                            </a> 
                        </li>
                        <li> <a href="<?php echo Yii::app()->request->baseUrl . '/index.php/testimonials?branch_id=' . $_GET['branch_id'] . '&feedback=all'; ?> "> All
                            </a> 
                        </li>

                    </ul>
                </div>
            </div>

            <?php
            foreach ($testimonials as $testimonial) {
                ?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="panel">
                            <div class="panel-body">
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
                                <p><?php echo date('jS \, F Y '); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="panel">
                            <div class="panel-body">
                                <p><strong>Testimonials</strong></p>
                                <?php
                                if ($testimonial['responce_text'] != "") {
                                    ?>
                                    <p style="color: #515151;"> <?php echo $testimonial['responce_text'] ?><p>
                                        <?php
                                    } elseif (isset($testimonial['responce_vedio_url'])) {
                                        ?>
                                    <div class="panel" style="padding: 10px;">
                                        <iframe id="player" type="text/html" width="300" height="200"
                                                src="http://www.youtube.com/embed/<?php echo $testimonial['responce_vedio_url'] ?>"
                                                frameborder="0">
                                        </iframe>
                                    </div>
                                    <?php
                                } elseif (isset($testimonial['responce_audio_url'])) {
                                    ?>
                                    <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                                    <div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
                                        <div class="jp-type-single">
                                            <div class="jp-gui jp-interface">
                                                <div class="jp-controls">
                                                    <button class="jp-play" role="button" tabindex="0">play</button>
                                                    <button class="jp-stop" role="button" tabindex="0">stop</button>
                                                </div>
                                                <div class="jp-progress">
                                                    <div class="jp-seek-bar">
                                                        <div class="jp-play-bar"></div>
                                                    </div>
                                                </div>
                                                <div class="jp-volume-controls">
                                                    <button class="jp-mute" role="button" tabindex="0">mute</button>
                                                    <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                                                    <div class="jp-volume-bar">
                                                        <div class="jp-volume-bar-value"></div>
                                                    </div>
                                                </div>
                                                <div class="jp-time-holder">
                                                    <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                                                    <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                                                    <div class="jp-toggles">
                                                        <button class="jp-repeat" role="button" tabindex="0">repeat</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="jp-details">
                                                <div class="jp-title" aria-label="title">&nbsp;</div>
                                            </div>
                                            <div class="jp-no-solution">
                                                <span>Update Required</span>
                                                To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <?php /* <tr class="gradeX">
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
                 * 
                 */
                ?>
                <?php
            }
            ?>
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
