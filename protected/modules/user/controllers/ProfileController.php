<?php

class ProfileController extends Controller {

    public $defaultAction = 'profile';
    public $layout = '//layouts/column2';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * Shows a particular model.
     */
    public function actionProfile() {
        $model = $this->loadUser();
        $this->render('profile', array(
            'model' => $model,
            'profile' => $model->profile,
        ));
    }

    public function actionupload() {

        if (Yii::app()->request->isPostRequest) { //change it
            $model = User::model()->findByPK($_POST['user_id'])->profile;
//                    Profile::model()->findAll(array(
//                'condition' => 'user_id = :user_id',
//                'params' => array(':user_id' => $_POST['user_id'])
//            ));
            $model = $model->profile;
            $files = $_FILES['organisation_logo']['tmp_name'];
            $fileName = $_FILES['organisation_logo']['name'];
            $target = "upload/user_profile_images/";
            $target = $target . basename($_FILES['organisation_logo']['name']);
            if (move_uploaded_file($_FILES['organisation_logo']['tmp_name'], $target)) {
                echo "successuu";
            } else {
                echo "error";
            }
//            if (move_uploaded_file($_FILES['organisation_logo']['tmp_name'], 'upload/user_profile_images/' . $fileName)) {
//                echo "successuu";
//            } else {
//                echo "error";
//            }

            Yii::app()->end();
            //$rnd = rand(0,9999);
//                $model->attributes = $_POST['ProductImages'];
//                $fileName = $file->getName();
//                $model->image = $fileName;
//                $model->product_id = $id;
//                $model->sortorder = $_POST['ProductImages']['sortorder'];
//                if ($model->save()) {
//                    $files->saveAs(Yii::getPathOfAlias('webroot') . '/upload/productImage/' . $fileName); // image will uplode to rootDirectory/banner/                                                 
//                    //thumbmail---------------start---
//                    Yii::app()->thumb->setThumbsDirectory('/upload/productImage/original/');
//                    Yii::app()->thumb->load(Yii::getPathOfAlias('webroot') . '/upload/productImage/' . $fileName)->resize(538, 359)->save($fileName);
//
//                    Yii::app()->thumb->setThumbsDirectory('/upload/productImage/thumb/');
//                    Yii::app()->thumb->load(Yii::getPathOfAlias('webroot') . '/upload/productImage/' . $fileName)->resize('0', '110')->save($fileName);
//
//                    Yii::app()->thumb->setThumbsDirectory('/upload/productImage/thumb_70/');
//                    Yii::app()->thumb->load(Yii::getPathOfAlias('webroot') . '/upload/productImage/' . $fileName)->resize('0', 70)->save($fileName);
//
//                    Yii::app()->user->setFlash('productImage', 'productImage has been added successfully');
//                    $this->redirect(array('view', 'id' => $model->image_id));
//                }
//            }
//            $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
//            $model->organisation_logo = $fileName;
//            $model->organisation_logo = CUploadedFile::getInstanceByName('organisation_logo');
////            $fileName = "{$uploadedFile}"; //this is not required  
////            $model->profilepic = '/images/' . $fileName; //this is also not required
//            $model->organisation_logo = $_POST['organisation_logo'];
//
//            if ($model->save()) {
//
//                $uploadedFile->saveAs(Yii::app()->basePath . '/../images/' . $fileName);  // 
////                $model->organisation_logo->saveAs(Yii::app()->basePath . '/../images/' . $model->profilepic);
////                echo json_encode($model);
////                Yii::app()->end();
//            }
        }


        $this->render('upload', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionEdit() {


        $model = $this->loadUser();
        $profile = $model->profile;

        // ajax validator
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'profile-form') {
            echo UActiveForm::validate(array($model, $profile));
            Yii::app()->end();
        }

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $profile->attributes = $_POST['Profile'];

            $target = "upload/user_profile_images/";
            $target = $target . basename($_FILES['organisation_logo']['name']);
            if (move_uploaded_file($_FILES['organisation_logo']['tmp_name'], $target)) {
                $profile->organisation_logo = $target;
            }
//            echo $_FILES['Profile[organisation_logo]']['name'];
//            Yii::app()->end();

            if ($model->validate() && $profile->validate()) {
                $model->save();
                $profile->save();
//                Yii::app()->user->updateSession();
                Yii::app()->user->setFlash('profileMessage', UserModule::t("Changes is saved."));
                $this->redirect(array('/user/profile'));
            } else
                $profile->validate();
        }

        $this->render('edit', array(
            'model' => $model,
            'profile' => $profile,
//            'Uploadmodel' => $Uploadmodel
        ));
    }

    /**
     * Change password
     */
    public function actionChangepassword() {
        $model = new UserChangePassword;
        if (Yii::app()->user->id) {

            // ajax validator
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'changepassword-form') {
                echo UActiveForm::validate($model);
                Yii::app()->end();
            }

            if (isset($_POST['UserChangePassword'])) {
                $model->attributes = $_POST['UserChangePassword'];
                if ($model->validate()) {
                    $new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
                    $new_password->password = UserModule::encrypting($model->password);
                    $new_password->activkey = UserModule::encrypting(microtime() . $model->password);
                    $new_password->save();
                    Yii::app()->user->setFlash('profileMessage', UserModule::t("New password is saved."));
                    $this->redirect(array("profile"));
                }
            }
            $this->render('changepassword', array('model' => $model));
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
     */
    public function loadUser() {
        if ($this->_model === null) {
            if (Yii::app()->user->id)
                $this->_model = Yii::app()->controller->module->user();
            if ($this->_model === null)
                $this->redirect(Yii::app()->controller->module->loginUrl);
        }
        return $this->_model;
    }

}
