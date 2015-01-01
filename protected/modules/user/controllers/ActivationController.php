<?php

class ActivationController extends Controller {

    public $defaultAction = 'activation';

    /**
     * Activation user account
     */
    public function actionActivation() {
        $email = $_GET['email'];
        $activkey = $_GET['activkey'];
        if ($email && $activkey) {
            $find = User::model()->notsafe()->findByAttributes(array('email' => $email));
            if (isset($find) && $find->status) {
                $this->render('/user/message', array('title' => UserModule::t("User Activation"), 'content' => UserModule::t('Your account is actived.<strong> Please <a href="' . Yii::app()->request->baseUrl . '/index.php/user/login" >Login</a> !</strong>')));
            } elseif (isset($find->activkey) && ($find->activkey == $activkey)) {
                $find->activkey = UserModule::encrypting(microtime());
                $find->status = 1;
                $find->save();
                $this->render('/user/message', array('title' => UserModule::t("User Activation"), 'content' => UserModule::t("Your account is activated. Please Login !")));
            } else {
                $this->render('/user/message', array('title' => UserModule::t("User Activation"), 'content' => UserModule::t("Incorrect activation URL.")));
            }
        } else {
            $this->render('/user/message', array('title' => UserModule::t("User Activation"), 'content' => UserModule::t("Incorrect activation URL.")));
        }
    }

}
