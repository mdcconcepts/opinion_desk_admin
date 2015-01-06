<?php
//$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Registration");
//$this->breadcrumbs = array(
//    UserModule::t("Registration"),
//);
?>
<div class="login-container">
    <div class="middle-login" style="top:30%;width: 700px;margin-left: -340px;">
        <div class="block-web">
            <div class="head">
                <h3 class="text-center">Opinion Desk : Registration</h3>
            </div>
            <div class="porlets-content">
                <?php if (Yii::app()->user->hasFlash('registration')): ?>
                    <div class="alert alert-success"> <strong>Well done!</strong> <?php echo Yii::app()->user->getFlash('registration'); ?> </div>
                <?php else: ?>
                    <?php if (Yii::app()->user->hasFlash('error')) { ?>
                        <div class="alert alert-danger">  <?php echo Yii::app()->user->getFlash('error'); ?></div>
                    <?php } ?>
                <?php endif; ?>
            </div>
            <div style="background:#fff;padding: 10px;">
                <?php
                $form = $this->beginWidget('UActiveForm', array(
                    'id' => 'registration-form',
                    'enableAjaxValidation' => true,
                    'disableAjaxValidationAttributes' => array('RegistrationForm_verifyCode'),
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                    'htmlOptions' => array('enctype' => 'multipart/form-data',
                        'class' => 'form-horizontal')
                ));
                ?>
                <div class="porlets-content">
                    <!--<div class="alert alert-info">--> 
                    <?php echo CHtml::errorSummary($model, null, null, array('class' => 'alert alert-danger')); ?>
                    <?php
                    echo CHtml::errorSummary($profile, null, null, array('class' => 'alert alert-danger'));
                    ?>
                    <!--</div>-->
                </div>
                <div id="progressWizard" class="basic-wizard">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#ptab1" data-toggle="tab"><span>Step 1:</span> Account Info</a></li>
                        <li><a href="#ptab2" data-toggle="tab"><span>Step 2:</span> Personal Info</a></li>
                        <li><a href="#ptab3" data-toggle="tab"><span>Step 3:</span> Business Info</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="progress progress-striped active">
                            <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="tab-pane" id="ptab1">
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => 'Username')); ?>
                                        </div>
                                        <?php echo $form->error($model, 'username'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => 'Email Address')); ?>
                                        </div>
                                        <?php echo $form->error($model, 'email'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                                            <input class="form-control" placeholder="Password" name="RegistrationForm[password]" id="RegistrationForm_password" type="password" maxlength="128">
                                            <?php // echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Password')); ?>

                                        </div>
                                        <?php echo $form->error($model, 'password'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="input-group"> 
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input class="form-control" placeholder="Verify Password" name="RegistrationForm[verifyPassword]" id="RegistrationForm_verifyPassword" type="password">
                                            <?php // echo $form->passwordField($model, 'verifyPassword', array('class' => 'form-control', 'placeholder' => 'Verify Password')); ?>

                                        </div>
                                        <?php echo $form->error($model, 'verifyPassword'); ?>
                                    </div>
                                </div>

                            </fieldset> 
                        </div>
                        <div class="tab-pane" id="ptab2">
                            <fieldset>

                                <?php
                                $profileFields = $profile->getFields();
                                if ($profileFields) {
                                    foreach ($profileFields as $field) {
                                        if ($field->category != 1) {
                                            continue;
                                        }
                                        ?>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="input-group"> 
                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                                    <?php
                                                    if ($widgetEdit = $field->widgetEdit($profile)) {
                                                        echo $widgetEdit;
                                                    } elseif ($field->range) {
                                                        echo $form->dropDownList($profile, $field->varname, Profile::range($field->range), array('class' => 'form-control'));
                                                    } elseif ($field->field_type == "TEXT") {
                                                        echo $form->textArea($profile, $field->varname, array('rows' => 6, 'cols' => 50), array('class' => 'form-control'));
                                                    } elseif ($field->varname == "dob") {
                                                        ?>
                                                        <input class="form-control form-control-inline input-medium default-date-picker" name="Profile[dob]" id="Profile_dob" type="text" placeholder="Birth Date" value="<?php echo $profile->dob; ?>" />
                        <!--                                                    echo '<input type="date" name="Profile[dob]" id="Profile_dob" >';-->
                                                        <?php
                                                    } elseif ($field->varname == "annivarsary") {
                                                        ?>
                                                        <input class="form-control form-control-inline input-medium default-date-picker" name="Profile[annivarsary]" id="Profile_annivarsary" placeholder="Anniversary"  type="text" value="<?php echo $profile->annivarsary; ?>" />
                                                        <?php
                                                    } elseif ($field->varname == "gender") {
                                                        echo $form->dropDownList($profile, $field->varname, ['' => 'Select', 'male' => 'Male', 'female' => 'Female', 'other' => 'Other'], array('class' => 'form-control'));
                                                    } elseif ($field->varname == "lob") {
                                                        ?>
                                                        <select name="Profile[lob]" id="lob_gender" class="form-control">
                                                            <?php LobMaster::getLOBTypes(null) ?>

                                                        </select>
                                                        <?php
                                                    } else {
                                                        echo $form->textField($profile, $field->varname, array('class' => 'form-control', 'placeholder' => $field->varname, 'size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
                                                    }
                                                    ?>

                                                </div>
                                                <?php echo $form->error($profile, $field->varname); ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </fieldset>
                        </div>
                        <div class="tab-pane" id="ptab3">
                            <fieldset>

                                <?php
                                if ($profileFields) {
                                    foreach ($profileFields as $field) {
                                        if ($field->category != 2) {
                                            continue;
                                        }
                                        ?>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="input-group"> 
                                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                                    <?php
                                                    if ($widgetEdit = $field->widgetEdit($profile)) {
                                                        echo $widgetEdit;
                                                    } elseif ($field->range) {
                                                        echo $form->dropDownList($profile, $field->varname, Profile::range($field->range), array('class' => 'form-control'));
                                                    } elseif ($field->field_type == "TEXT") {
                                                        echo $form->textArea($profile, $field->varname, array('rows' => 6, 'cols' => 50), array('class' => 'form-control'));
                                                    } elseif ($field->varname == "dob") {
                                                        ?>
                                                        <input class="form-control form-control-inline input-medium default-date-picker" name="Profile[dob]" id="Profile_dob" type="text" placeholder="Birth Date" value="<?php echo $profile->dob; ?>" />
                        <!--                                                    echo '<input type="date" name="Profile[dob]" id="Profile_dob" >';-->
                                                        <?php
                                                    } elseif ($field->varname == "annivarsary") {
                                                        ?>
                                                        <input class="form-control form-control-inline input-medium default-date-picker" name="Profile[annivarsary]" id="Profile_annivarsary" placeholder="Anniversary"  type="text" value="<?php echo $profile->annivarsary; ?>" />
                                                        <?php
                                                    } elseif ($field->varname == "lob") {
                                                        ?>
                                                        <select name="Profile[lob]" id="lob_gender" class="form-control">
                                                            <?php LobMaster::getLOBTypes(null) ?>

                                                        </select>
                                                        <?php
                                                    } elseif ($field->varname == "theme_color") {
                                                        echo $form->textField($profile, $field->varname, array('class' => 'colorpicker-default form-control', 'placeholder' => $field->varname, 'size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
                                                    } else {
                                                        echo $form->textField($profile, $field->varname, array('class' => 'form-control', 'placeholder' => $field->varname, 'size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
                                                    }
                                                    ?>

                                                </div>
                                                <?php echo $form->error($profile, $field->varname); ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </fieldset>
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <?php if (UserModule::doCaptcha('registration')): ?>
                                            <div class="row">
                                                <?php echo $form->labelEx($model, 'verifyCode'); ?>

                                                <?php $this->widget('CCaptcha'); ?>
                                                <?php echo $form->textField($model, 'verifyCode'); ?>
                                                <?php echo $form->error($model, 'verifyCode'); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <a href="#" style="float: right;"> <button class="btn btn-primary" data-dismiss="modal" type="submit">Register</button></a>
                            </fieldset>
                        </div>
                    </div><!-- /tab-content -->

                    <ul class="pager wizard">
                        <a style="float: left;margin-right: 20px;" href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/login"><button type="button" data-dismiss="modal" class="btn btn-default">cancel</button></a>
                        <li class="previous"><a href="javascript:void(0)">Previous</a></li>
                        <li class="next"><a href="javascript:void(0)">Next</a></li>
                    </ul>
                </div><!--/progressWizard-->
                <?php $this->endWidget(); ?>
            </div>
        </div>
        <div class="text-center out-links"><a href="#">&copy;  Copyright WebProAdmin 2014. </a></div>
    </div>
</div>


<?php /* if (Yii::app()->user->hasFlash('registration')): ?>
  <div class="success">
  <?php echo Yii::app()->user->getFlash('registration'); ?>
  </div>
  <?php else: ?>
  <?php if (Yii::app()->user->hasFlash('error')) { ?>
  <div class="errorMessage">
  <?php echo Yii::app()->user->getFlash('error'); ?>
  </div>
  <?php } ?>

  <div class="form">
  <?php
  $form = $this->beginWidget('UActiveForm', array(
  'id' => 'registration-form',
  'enableAjaxValidation' => true,
  'disableAjaxValidationAttributes' => array('RegistrationForm_verifyCode'),
  'clientOptions' => array(
  'validateOnSubmit' => true,
  ),
  'htmlOptions' => array('enctype' => 'multipart/form-data',
  'class' => 'form-horizontal')
  ));
  ?>

  <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

  <?php echo $form->errorSummary(array($model, $profile)); ?>


  <div class="row">
  <?php echo $form->labelEx($model, 'username'); ?>
  <?php echo $form->textField($model, 'username'); ?>
  <?php echo $form->error($model, 'username'); ?>
  </div>

  <div class="row">
  <?php echo $form->labelEx($model, 'password'); ?>
  <?php echo $form->passwordField($model, 'password'); ?>
  <?php echo $form->error($model, 'password'); ?>
  <p class="hint">
  <?php echo UserModule::t("Minimal password length 4 symbols."); ?>
  </p>
  </div>

  <div class="row">
  <?php echo $form->labelEx($model, 'verifyPassword'); ?>
  <?php echo $form->passwordField($model, 'verifyPassword'); ?>
  <?php echo $form->error($model, 'verifyPassword'); ?>
  </div>

  <div class="row">
  <?php echo $form->labelEx($model, 'email'); ?>
  <?php echo $form->textField($model, 'email'); ?>
  <?php echo $form->error($model, 'email'); ?>
  </div>

  <?php
  $profileFields = $profile->getFields();
  if ($profileFields) {
  foreach ($profileFields as $field) {
  ?>
  <div class="row">
  <?php echo $form->labelEx($profile, $field->varname); ?>
  <?php
  if ($widgetEdit = $field->widgetEdit($profile)) {
  echo $widgetEdit;
  } elseif ($field->range) {
  echo $form->dropDownList($profile, $field->varname, Profile::range($field->range));
  } elseif ($field->field_type == "TEXT") {
  echo $form->textArea($profile, $field->varname, array('rows' => 6, 'cols' => 50));
  } elseif ($field->varname == "dob") {
  echo '<input type="date" name="Profile[dob]" id="Profile_dob" >';
  } elseif ($field->varname == "annivarsary") {
  echo '<input type="date" name="Profile[annivarsary]" id="Profile_annivarsary" >';
  } elseif ($field->varname == "gender") {
  echo '<select name="Profile[gender]" id="Profile_gender">
  <option value="male">male</option>
  <option value="female">female</option>
  <option value="other">other</option>
  </select>';
  } elseif ($field->varname == "lob") {
  ?>
  <select name="Profile[lob]" id="lob_gender">
  <?php LobMaster::getLOBTypes(null) ?>

  </select>
  <?php
  } else {
  echo $form->textField($profile, $field->varname, array('size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
  }
  ?>
  <?php echo $form->error($profile, $field->varname); ?>
  </div>
  <?php
  }
  }
  ?>
  <?php if (UserModule::doCaptcha('registration')): ?>
  <div class="row">
  <?php echo $form->labelEx($model, 'verifyCode'); ?>

  <?php $this->widget('CCaptcha'); ?>
  <?php echo $form->textField($model, 'verifyCode'); ?>
  <?php echo $form->error($model, 'verifyCode'); ?>

  <p class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
  <br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
  </div>
  <?php endif; ?>

  <div class="row submit">
  <?php echo CHtml::submitButton(UserModule::t("Register")); ?>
  </div>

  <?php $this->endWidget(); ?>
  </div><!-- form -->
  <?php endif; ?>
 * 
 */
?>