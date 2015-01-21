<div class="row">
    <div class="col-md-12">
        <h2>Message Composer</h2>
    </div><!--/col-md-12--> 
</div><!--/row-->
<div class="row">
    <div class="porlets-content">
        <!--<div class="alert alert-info">--> 
        <?php
        foreach (Yii::app()->user->getFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . "</div>";
        }
        ?>
        <!--</div>-->
    </div>
    <div class="col-lg-12">
        <div class="block-web">
            <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'message-master-form',
//                'action' => Yii::app()->request->baseUrl . '/index.php/MessageMaster/create',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'enableAjaxValidation' => false,
                    // 'htmlOptions'=>array('enctype'=>'multipart/form-data'),
            ));
            ?>
            <div class="compose-mail">

                <div class="form-group">
                    <label class="col-sm-2">To:</label>
                    <div class="col-sm-4">
                        <select  multiple="multiple" name="message_to[]" class="tokenize-sample data_export">
                            <?php
                            $Users = User::model()->findAll();
                            foreach ($Users as $user) {
                                ?>
                                <option value="<?php echo $user->id; ?>" ><?php echo $user->username; ?></option>
                                <?php
                            }
                            ?>
                            <option value="-1" selected="selected">To all</option>
                        </select>
                        <!-- select age range span removed --KK -->
                    </div>
                </div>
                <div class="form-group">
                    <label class=""  for="subject">Subject:</label>
                    <input type="text" class="form-control" id="subject" name="message_subject" value="<?php echo $model['subject'] ?>" tabindex="1">
                </div>
                <div class="compose-editor" style="margin-top:10px;">
                    <textarea class="form-control ckeditor" name="editor1" rows="6"><?php echo $model['message'] ?></textarea>
                </div>
            </div>
            <div class="bottom">
                <button class="btn btn-primary">Send</button>
                <button class="btn btn-success" type="button">Save</button>
            </div>
            <?php $this->endWidget(); ?>
        </div><!--/ block-web --> 
    </div><!-- /col-sm-9 --> 

</div>