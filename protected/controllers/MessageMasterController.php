<?php

class MessageMasterController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'archive'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'export', 'import', 'editable', 'toggle',),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {

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

        $model = new MessageMaster;
        $model['subject'] = $_POST['message_subject'];
        $model['message'] = $_POST['editor1'];

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (Yii::app()->request->isPostRequest) {
            try {
                if (!$this->validate($_POST)) {
                    $transaction = Yii::app()->db->beginTransaction();

                    for ($index = 0; $index < count($_POST['message_to']); $index++) {
                        $model = new MessageMaster;
                        $messageType = 'warning';
                        $message = "There are some errors ";
                        $this->setAttributes($model, $_POST, $_POST['message_to'][$index]);
                        if (!$model->save()) {
                            $transaction->rollBack();
                            Yii::app()->user->setFlash('danger', json_encode($model->getErrors()));
                            $this->redirect(array('create', array(
                                    'model' => $model,
                            )));
                        }
                    }
                    $transaction->commit();
                    $messageType = 'success';
                    $message = "Your message has been sent successfully.";
                    Yii::app()->user->setFlash($messageType, $message);
                    $this->redirect(array('create'));
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::app()->user->setFlash('danger', "{$e->getMessage()}");
                //$this->refresh();
            }
        }


        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function setAttributes($model, $post, $message_to) {
        $model->message = $post['editor1'];
        $model->subject = $post['message_subject'];
        $model->message_to = $message_to;
        $model->message_from = Yii::app()->user->id;
        $model->is_broadcast = 0;
        if ($message_to == -1)
            $model->is_broadcast = 1;

        $model->read_status = 0;
        $model->is_archive = 0;
        $model->priority = 1;
        $model->schedule_timestamp = date('Y-m-d H:i:s');
        $model->created_at = date('Y-m-d H:i:s');
        ;

//          'message' => 'Message',
//            'subject' => 'subject',
//            'message_to' => 'Message To',
//            'message_from' => 'Message From',
//            'is_broadcast' => 'Is Broadcast',
//            'read_status' => 'Read Status',
//            'priority' => 'Priority',
//            'schedule_timestamp' => 'Schedule Timestamp',
//            'created_at' => 'Created At',
    }

    public function validate($post) {

        $isError = false;
        $Message = "<strong>Please Fill details</strong><br/> <ul>";
        if ($post['message_subject'] == "") {
            $Message.= "<li>Subject is empty, please fill subject !</li>";
            $isError = true;
        }
        if ($post['editor1'] == "") {
            $Message.= "<li>Message is empty, please enter some message !</li>";
            $isError = true;
        }
        if (count($post['message_to']) == 0) {
            $Message.= "<li>Please enter Username for message reciver !</li>";
            $isError = true;
        }
        if (count($post['message_to']) > 1) {
            if (in_array(-1, $post['message_to'])) {
                $Message.= "<li>You already select All contact option, please check your To fields !</li>";
                $isError = true;
            }
        }
        $Message .= "</ul>";
        if ($isError) {
            Yii::app()->user->setFlash('danger', $Message);
        }
//        if (in_array(-1, $post['message_to'])) {
//            echo $Message.= "<li>You already select All contact option, please check your To fields !</li>";
//        }
        return $isError;
//        echo json_encode($post);
//        Yii::app()->end();
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

        if (isset($_POST['MessageMaster'])) {
            $messageType = 'warning';
            $message = "There are some errors ";
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $model->attributes = $_POST['MessageMaster'];
                $messageType = 'success';
                $message = "<strong>Well done!</strong> You successfully update data ";

                /*
                  $uploadFile=CUploadedFile::getInstance($model,'filename');
                  if(!empty($uploadFile)) {
                  $extUploadFile = substr($uploadFile, strrpos($uploadFile, '.')+1);
                  if(!empty($uploadFile)) {
                  if($uploadFile->saveAs(Yii::app()->basePath.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'messagemaster'.DIRECTORY_SEPARATOR.$model->id.DIRECTORY_SEPARATOR.$model->id.'.'.$extUploadFile)){
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

            $model->attributes = $_POST['MessageMaster'];
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
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        /*
          $dataProvider=new CActiveDataProvider('MessageMaster');
          $this->render('index',array(
          'dataProvider'=>$dataProvider,
          ));
         */

        $model = MessageMaster::model()->findAll(array(
            'condition' => 'message_to = :message_to OR is_broadcast = :is_broadcast',
            'params' => array(':message_to' => Yii::app()->user->id, ':is_broadcast' => 1)
        ));
        $this->render('index', array(
            'messages' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionarchive() {
        /*
          $dataProvider=new CActiveDataProvider('MessageMaster');
          $this->render('index',array(
          'dataProvider'=>$dataProvider,
          ));
         */

        $model = MessageMaster::model()->findAll(array(
            'condition' => '(message_to = :message_to OR is_broadcast = :is_broadcast) AND is_archive=1',
            'params' => array(':message_to' => Yii::app()->user->id, ':is_broadcast' => 1)
        ));
        $this->render('archive', array(
            'messages' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {

        $model = new MessageMaster('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['MessageMaster']))
            $model->attributes = $_GET['MessageMaster'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return MessageMaster the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = MessageMaster::model()->findByPk($id);
        $model->read_status = 1;
        $model->save();
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param MessageMaster $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'message-master-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionExport() {
        $model = new MessageMaster;
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['MessageMaster']))
            $model->attributes = $_POST['MessageMaster'];

        $exportType = $_POST['fileType'];
        $this->widget('ext.heart.export.EHeartExport', array(
            'title' => 'List of MessageMaster',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'grid_mode' => 'export',
            'exportType' => $exportType,
            'columns' => array(
                'id',
                'message',
                'message_to',
                'message_from',
                'is_broadcast',
                'read_status',
                'priority',
                'schedule_timestamp',
                'created_at',
            ),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionImport() {

        $model = new MessageMaster;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['MessageMaster'])) {
            if (!empty($_FILES)) {
                $tempFile = $_FILES['MessageMaster']['tmp_name']['fileImport'];
                $fileTypes = array('xls', 'xlsx'); // File extensions
                $fileParts = pathinfo($_FILES['MessageMaster']['name']['fileImport']);
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
                        $message = $sheetData[$baseRow]['B'];
                        $message_to = $sheetData[$baseRow]['C'];
                        $message_from = $sheetData[$baseRow]['D'];
                        $is_broadcast = $sheetData[$baseRow]['E'];
                        $read_status = $sheetData[$baseRow]['F'];
                        $priority = $sheetData[$baseRow]['G'];
                        $schedule_timestamp = $sheetData[$baseRow]['H'];
                        $created_at = $sheetData[$baseRow]['I'];

                        $model2 = new MessageMaster;
                        //$model2->id=  $id;
                        $model2->message = $message;
                        $model2->message_to = $message_to;
                        $model2->message_from = $message_from;
                        $model2->is_broadcast = $is_broadcast;
                        $model2->read_status = $read_status;
                        $model2->priority = $priority;
                        $model2->schedule_timestamp = $schedule_timestamp;
                        $model2->created_at = $created_at;

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
        $es = new TbEditableSaver('MessageMaster');
        $es->update();
    }

    public function actions() {
        return array(
            'toggle' => array(
                'class' => 'bootstrap.actions.TbToggleAction',
                'modelName' => 'MessageMaster',
            )
        );
    }

}
