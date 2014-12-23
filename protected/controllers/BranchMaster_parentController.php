<?php

class BranchMaster_parentController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';
    public $menuCaption = 'Sub Menu';

    /**
     * @return array action filters
     */
//    public function filters() {
//        return array(
//            'rights - index, view',
//        );
//    }

    public function actionTest($id) {

        echo json_encode("here");
        Yii::app()->end();
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {

        $this->layout = 'column2';

        if (isset($_GET['asModal'])) {
            $this->renderPartial('view', array(
                'model' => $this->loadModel($id),
            ));
        } else {

            $this->render('view', array(
                'model' => $this->loadModel($id),
            ));
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {

        $model = new BranchMaster;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['BranchMaster'])) {
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $messageType = 'warning';
                $message = "There are some errors ";
                $model->attributes = $_POST['BranchMaster'];

                $count = BranchMaster::model()->countByAttributes(array(
                    'customer_id' => Yii::app()->user->id
                ));



                if ($count >= Profile::getbatch_count()) {
                    Yii::app()->user->setFlash('error', "Please upgrade your package, kindly contact to our support!");
//                echo json_encode("error");
                    $this->render('create', array(
                        'model' => $model,
                    ));
                    Yii::app()->end();
                }


                //$uploadFile=CUploadedFile::getInstance($model,'filename');
                if ($model->save()) {
                    $messageType = 'success';
                    $message = "<strong>Well done!</strong> You successfully create data ";
                    /*
                      $model2 = BranchMaster::model()->findByPk($model->id);
                      if(!empty($uploadFile)) {
                      $extUploadFile = substr($uploadFile, strrpos($uploadFile, '.')+1);
                      if(!empty($uploadFile)) {
                      if($uploadFile->saveAs(Yii::app()->basePath.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'branchmaster'.DIRECTORY_SEPARATOR.$model2->id.DIRECTORY_SEPARATOR.$model2->id.'.'.$extUploadFile)){
                      $model2->filename=$model2->id.'.'.$extUploadFile;
                      $model2->save();
                      $message .= 'and file uploded';
                      }
                      else{
                      $messageType = 'warning';
                      $message .= 'but file not uploded';
                      }
                      }
                      }
                     */
                    $transaction->commit();
                    Yii::app()->user->setFlash($messageType, $message);
                    $this->redirect(array('view', 'id' => $model->id));
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::app()->user->setFlash('error', "{$e->getMessage()}");
                //$this->refresh();
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {

        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['BranchMaster'])) {
            $messageType = 'warning';
            $message = "There are some errors ";
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $model->attributes = $_POST['BranchMaster'];
                $messageType = 'success';
                $message = "<strong>Well done!</strong> You successfully update data ";

                /*
                  $uploadFile=CUploadedFile::getInstance($model,'filename');
                  if(!empty($uploadFile)) {
                  $extUploadFile = substr($uploadFile, strrpos($uploadFile, '.')+1);
                  if(!empty($uploadFile)) {
                  if($uploadFile->saveAs(Yii::app()->basePath.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'branchmaster'.DIRECTORY_SEPARATOR.$model->id.DIRECTORY_SEPARATOR.$model->id.'.'.$extUploadFile)){
                  $model->filename=$model->id.'.'.$extUploadFile;
                  $message .= 'and file uploded';
                  }
                  else{
                  $messageType = 'warning';
                  $message .= 'but file not uploded';
                  }
                  }
                  }
                 */

                if ($model->save()) {
                    $transaction->commit();
                    Yii::app()->user->setFlash($messageType, $message);
                    $this->redirect(array('view', 'id' => $model->id));
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::app()->user->setFlash('error', "{$e->getMessage()}");
                // $this->refresh(); 
            }

            $model->attributes = $_POST['BranchMaster'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
//        if (Yii::app()->request->isPostRequest) {
        // we only allow deletion via POST request
        try {
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        } catch (Exception $exc) {
            Yii::app()->user->setFlash('error', "{$exc->getMessage()}");
        }
        $this->redirect(Yii::app()->request->baseUrl . '/index.php/branchMaster_parent');

//        } else
//            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        /*
          $dataProvider=new CActiveDataProvider('BranchMaster');
          $this->render('index',array(
          'dataProvider'=>$dataProvider,
          ));
         */

        $model = new BranchMaster('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['BranchMaster']))
            $model->attributes = $_GET['BranchMaster'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {

        $model = new BranchMaster('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['BranchMaster']))
            $model->attributes = $_GET['BranchMaster'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return BranchMaster the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = BranchMaster::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param BranchMaster $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'branch-master-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionExport() {
        $model = new BranchMaster;
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['BranchMaster']))
            $model->attributes = $_POST['BranchMaster'];

        $exportType = $_POST['fileType'];
        $this->widget('ext.heart.export.EHeartExport', array(
            'title' => 'List of BranchMaster',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'grid_mode' => 'export',
            'exportType' => $exportType,
            'columns' => array(
                'id',
                'customer_id',
                'branch_name',
                'branch_address',
                'tablet_no',
                'created_at',
                'updated_at',
            ),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionImport() {

        $model = new BranchMaster;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['BranchMaster'])) {
            if (!empty($_FILES)) {
                $tempFile = $_FILES['BranchMaster']['tmp_name']['fileImport'];
                $fileTypes = array('xls', 'xlsx'); // File extensions
                $fileParts = pathinfo($_FILES['BranchMaster']['name']['fileImport']);
                if (in_array(@$fileParts['extension'], $fileTypes)) {

                    Yii::import('ext.heart.excel.EHeartExcel', true);
                    EHeartExcel::init();
                    $inputFileType = PHPExcel_IOFactory::identify($tempFile);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($tempFile);
                    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $baseRow = 2;
                    $inserted = 0;
                    $read_status = false;
                    while (!empty($sheetData[$baseRow]['A'])) {
                        $read_status = true;
                        //$id=  $sheetData[$baseRow]['A'];
                        $customer_id = $sheetData[$baseRow]['B'];
                        $branch_name = $sheetData[$baseRow]['C'];
                        $branch_address = $sheetData[$baseRow]['D'];
                        $tablet_no = $sheetData[$baseRow]['E'];
                        $created_at = $sheetData[$baseRow]['F'];
                        $updated_at = $sheetData[$baseRow]['G'];

                        $model2 = new BranchMaster;
                        //$model2->id=  $id;
                        $model2->customer_id = $customer_id;
                        $model2->branch_name = $branch_name;
                        $model2->branch_address = $branch_address;
                        $model2->tablet_no = $tablet_no;
                        $model2->created_at = $created_at;
                        $model2->updated_at = $updated_at;

                        try {
                            if ($model2->save()) {
                                $inserted++;
                            }
                        } catch (Exception $e) {
                            Yii::app()->user->setFlash('error', "{$e->getMessage()}");
                            //$this->refresh();
                        }
                        $baseRow++;
                    }
                    Yii::app()->user->setFlash('success', ($inserted) . ' row inserted');
                } else {
                    Yii::app()->user->setFlash('warning', 'Wrong file type (xlsx, xls, and ods only)');
                }
            }


            $this->render('admin', array(
                'model' => $model,
            ));
        } else {
            $this->render('admin', array(
                'model' => $model,
            ));
        }
    }

    public function actionEditable() {
        Yii::import('bootstrap.widgets.TbEditableSaver');
        $es = new TbEditableSaver('BranchMaster');
        $es->update();
    }

    public function actions() {
        return array(
            'toggle' => array(
                'class' => 'bootstrap.actions.TbToggleAction',
                'modelName' => 'BranchMaster',
            )
        );
    }

}
