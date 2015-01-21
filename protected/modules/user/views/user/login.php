<div class="login-container">

    <div class="middle-login">
        <div class="right_shadow">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/right_shadow.png"/>
        </div>
        <div class="left_shadow">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/theme_images/left_shadow.png" />
        </div>
        <div class="block-web">
            <div class="head">
                <h3 class="text-center"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/opinion_desk_logo_large.png"/></h3>
            </div>
            <div style="background:#fff;">


                <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/login" method="post"  class="form-horizontal" style="margin-bottom: 0px !important;">

                    <div class="porlets-content">
                        <!--<div class="alert alert-info">--> 
                        <?php echo CHtml::errorSummary($model, null, null, array('class' => 'alert alert-info')); ?>
                        <!--</div>-->
                    </div>

                    <div class="content">
                        <!--<h4 class="title">Login Access</h4>-->
                        <div class="form-group">
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control login_input" style="border-radius: 9px; padding: 6px 11px !important; border: 2px solid #E5E9EC; width: 224px;"  name="UserLogin[username]" id="UserLogin_username" placeholder="Username"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <div class="input-group"> 
                                    <input type="password" class="form-control login_input"  style="border-radius: 9px; padding: 6px 11px !important; border: 2px solid #E5E9EC; width: 224px;"  name="UserLogin[password]" id="UserLogin_password" placeholder="Password"/>
                                </div>
                            </div>
                        </div>
                        <div class="foot login_footer">
                        <div style="display: block;
float: right;
right:53px" class="input-group-btn">
                            <button  type="submit" name="yt1"  class="btn btn-primary" style="border-radius: 5px;font-size: 12px;padding: 3px;">Login</button>
                        </div>

<!--                        <a href="<?php // echo Yii::app()->request->baseUrl;                                       ?>/index.php/user/registration"><button type="button" data-dismiss="modal" class="btn btn-default">Register</button></a>
<input type="submit" name="yt1" class="btn btn-primary" value="Login">-->
                    </div>
                        
                        <div style="padding-left: 10px;padding-right: 3px; clear:both;">
                            <?php echo CHtml::link(UserModule::t("Forgot Password?"), Yii::app()->getModule('user')->recoveryUrl, array('style' => 'color: #8e8e8e; font-size: 11px;')); ?>
                            <?php echo CHtml::link(UserModule::t("Registration"), Yii::app()->request->baseUrl . '/index.php/user/registration', array('style' => 'color: #8e8e8e; font-size: 12px;margin-left: 68px;')); ?>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>

        <div class="text-center out-links"><a href="#">&copy;  Copyright Opinion Desk 2014. </a></div>
    </div>
</div>
<?php
/*
  $this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Login");
  $this->breadcrumbs = array(
  UserModule::t("Login"),
  );
  ?>

  <h1><?php echo UserModule::t("Login"); ?></h1>

  <?php if (Yii::app()->user->hasFlash('loginMessage')): ?>

  <div class="success">
  <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
  </div>

  <?php endif; ?>

  <p><?php echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>

  <div class="form">
  <?php echo CHtml::beginForm(); ?>

  <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

  <?php echo CHtml::errorSummary($model); ?>

  <div class="row">
  <?php echo CHtml::activeLabelEx($model, 'username'); ?>
  <?php echo CHtml::activeTextField($model, 'username') ?>
  </div>

  <div class="row">
  <?php echo CHtml::activeLabelEx($model, 'password'); ?>
  <?php echo CHtml::activePasswordField($model, 'password') ?>
  </div>

  <div class="row">
  <p class="hint">
  <?php echo CHtml::link(UserModule::t("Register"), Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"), Yii::app()->getModule('user')->recoveryUrl); ?>
  </p>
  </div>

  <div class="row rememberMe">
  <?php echo CHtml::activeCheckBox($model, 'rememberMe'); ?>
  <?php echo CHtml::activeLabelEx($model, 'rememberMe'); ?>
  </div>

  <div class="row submit">
  <?php echo CHtml::submitButton(UserModule::t("Login")); ?>
  </div>

  <?php echo CHtml::endForm(); ?>
  </div><!-- form -->


  <?php
  $form = new CForm(array(
  'elements' => array(
  'username' => array(
  'type' => 'text',
  'maxlength' => 32,
  ),
  'password' => array(
  'type' => 'password',
  'maxlength' => 32,
  ),
  'rememberMe' => array(
  'type' => 'checkbox',
  )
  ),
  'buttons' => array(
  'login' => array(
  'type' => 'submit',
  'label' => 'Login',
  ),
  ),
  ), $model);
 * 
 */
?>