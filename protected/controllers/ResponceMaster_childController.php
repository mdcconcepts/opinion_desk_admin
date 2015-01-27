<?php

class ResponceMaster_childController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $menuCaption = "Sub Menu";
    public $layout = '//layouts/column2';
    public $pName = 'QuestionMaster'; //parent Model Class Name => Program
    public $pUrl = 'questionMaster_Child'; //parent URL => pusdiklat/planning/program
    public $pId = 'question_master_id'; //parent field ID => programId

    /**
     * @return array action filters
     */
//    public function filters() {
//        return array(
//            'rights - index, view',
//        );
//    }

    public function actionViewBranchReport($branch_id) {


        if (Yii::app()->request->isPostRequest) {


            try {
                Yii::import('ext.codelord-phpexcel.CPHPExcel');

                $objPHPExcel = CPHPExcel::createPHPExcel();

                $objPHPExcel->getProperties()->setCreator(Yii::app()->user->id)
                        ->setLastModifiedBy(Yii::app()->user->id)
                        ->setTitle("Report")
                        ->setSubject("Office 2007 XLSX Test Document")
                        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                        ->setKeywords("office 2007 openxml php")
                        ->setCategory("Test result file");

                $looper = 1;
                if ($_POST['feedback'] == 'all') {
                    $looper = 6;
                }
                $branch_id = $_POST['branch_id'];
                for ($index1 = 0; $index1 < $looper; $index1++) {

                    $Feddback_Val = $_POST['feedback'];
                    if ($_POST['feedback'] == 'all') {
                        $Feddback_Val = $index1;
                    }
                    $objWorksheet = new PHPExcel_Worksheet($objPHPExcel);
                    $objPHPExcel->addSheet($objWorksheet);
                    $objWorksheet->setTitle('' . $tn);

                    $connection = Yii::app()->db;
                    $customer_id = Yii::app()->user->id;
                    $sqlStatement = "SELECT DISTINCT FeedbackMaster.`client_id`,Total_AVG,`feedback_id` ";
                    $objWorksheet->setCellValue('A1', 'Id');
                    $Cell = ['B1', 'C1', 'D1', 'E1', 'F1', 'G1', 'H1', 'I1', 'J1', 'K1', 'L1', 'M1', 'N1', 'O1', 'P1'];
                    $index = 0;

                    foreach ($_POST['data_export'] as $selectedOption) {
                        switch ($selectedOption) {
                            case -1:
                                $objWorksheet->setCellValue($Cell[$index++], 'Name');
                                $sqlStatement .= ",`name`";
                                break;
                            case -2:
                                $objWorksheet->setCellValue($Cell[$index++], 'Mobile No');
                                $sqlStatement .= ",`mobile_no`";
                                break;
                            case -3:
                                $objWorksheet->setCellValue($Cell[$index++], 'Email');
                                $sqlStatement .= ",`email`";

                                break;
                            case -4:
                                $objWorksheet
                                        ->setCellValue($Cell[$index++], 'Age');
                                $sqlStatement .= ",YEAR(CURDATE())-YEAR(`dob`) AS age ";
                                break;

                            default:
                                $objWorksheet
                                        ->setCellValue($Cell[$index++], CustomerCustomField::model()->findByPk(CustomerCustomFieldAssignmentTable::model()->findByPk($selectedOption)->customer_custom_field_id)->field_name);
                                break;
                        }
                    }
                    if (isset($_POST['testimonies'])) {
                        $objWorksheet
                                ->setCellValue($Cell[$index++], 'Testimonials');
                    }

                    $Gender_Query = "";
                    switch ($_POST['gender']) {
                        case 'both':

                            break;
                        default :
                            $Gender_Query = ' AND `gender`=' . $_POST['gender'] . ' ';
                            break;
                    }

                    $sqlStatement.=" FROM (SELECT `feedback_id`,
                                    `option_value`,
                                    `question_id`,
                                    ROUND(AVG(`option_value`), 0) AS Total_AVG
                             FROM `responce_master`
                             WHERE `question_id` IN
                                 (SELECT `id`
                                  FROM `question_master`
                                  WHERE `branch_id` = $branch_id)
                             GROUP BY `feedback_id`) AS AVERAGE
                             INNER JOIN
                               (SELECT `id`,
                                       `client_id`,
                                       `created_at`
                                FROM `feedback_master`) AS FeedbackMaster ON AVERAGE.`feedback_id`=FeedbackMaster.`id` $Reapet_Query
                                  INNER JOIN `client_master` ON `client_master`.`client_id`=FeedbackMaster.`client_id`
                                  AND DATE(FeedbackMaster.`created_at`) BETWEEN DATE('" . $_POST['date_range_from'] . "') AND DATE('" . $_POST['date_range_to'] . "')
                                  AND YEAR(CURDATE()) - YEAR(`dob`) BETWEEN  " . $_POST['age_range_from'] . "  AND  " . $_POST['age_range_to'] . ""
                            . "   $Gender_Query ";
//                    $sqlStatement .= "FROM
//                                        ( SELECT *
//                                         FROM `feedback_master`
//                                         WHERE `id` IN
//                                             ( SELECT `feedback_id`
//                                              FROM `responce_master`
//                                              WHERE `question_id` IN
//                                                  ( SELECT `id`
//                                                   FROM `question_master`
//                                                   WHERE `branch_id` =" . $branch_id . "))) AS responce_master1
//                                      INNER JOIN `client_master` ON `client_master`.client_id = `responce_master1`.`client_id`
//                                      AND DATE(`responce_master1`.`created_at`) BETWEEN DATE('" . $_POST['date_range_from'] . "') AND DATE('" . $_POST['date_range_to'] . "') 
//                                      AND YEAR(CURDATE()) - YEAR(`dob`) BETWEEN  " . $_POST['age_range_from'] . "  AND  " . $_POST['age_range_to'] . " ";



                    switch ($Feddback_Val) {
                        case '0':
                            $sqlStatement.= ' AND `Total_AVG`=' . 0 . ' ';
                            break;
                        case '1':
                            $sqlStatement.= ' AND `Total_AVG`=' . 1 . ' ';
                            break;
                        case '2':
                            $sqlStatement.= ' AND `Total_AVG`=' . 2 . ' ';
                            break;
                        case '3':
                            $sqlStatement.= ' AND `Total_AVG`=' . 3 . ' ';
                            break;
                        case '4':
                            $sqlStatement.= ' AND `Total_AVG`=' . 4 . ' ';
                            break;
                        case '5':
                            $sqlStatement.= ' AND `Total_AVG`=' . 5 . ' ';
                            break;
                        case '6':
                            $sqlStatement.= ' AND `Total_AVG`=' . 6 . ' ';
                            break;
                    }

                    switch ($_POST['repeat_new']) {
                        case 'both':

                            break;
                        case 'new' :
                            $sqlStatement.= ' GROUP BY FeedbackMaster.`client_id` HAVING COUNT(FeedbackMaster.`client_id`)<=1 ';
                            break;
                        case 'repeat' :
                            $sqlStatement.= ' GROUP BY FeedbackMaster.`client_id` HAVING COUNT(FeedbackMaster.`client_id`)>1';
                            break;
                    }

                    $command = $connection->createCommand($sqlStatement);


//                switch ($_POST['feedback']) {
//                    case 'all':
//
//                        break;
//                    default :
//                        $sqlStatement.=' AND `option_value` = :feedback ';
//                        $command->bindParam(':feedback', $_POST['feedback'], PDO::PARAM_INT);
//                        break;
//                }
//                //                $command->bindParam(':from_date', '2013-12-08');
//                    echo $sqlStatement . "<br/>";
//                    Yii::app()->end();
                    $command->execute();

                    $reader = $command->query();
                    $Row_Index = 2;
                    foreach ($reader as $row) {
                        $objWorksheet
                                ->setCellValue('A' . ++$Row_Index, $row['client_id']);
                        $Cell = ['B' . $Row_Index, 'C' . $Row_Index, 'D' . $Row_Index, 'E' . $Row_Index, 'F' . $Row_Index, 'G' . $Row_Index, 'H' . $Row_Index, 'I' . $Row_Index, 'J' . $Row_Index, 'K' . $Row_Index, 'L' . $Row_Index, 'M' . $Row_Index, 'N' . $Row_Index, 'O' . $Row_Index, 'P' . $Row_Index];
                        $index = 0;
                        foreach ($_POST['data_export'] as $selectedOption) {
                            switch ($selectedOption) {
                                case -1:
                                    $objWorksheet
                                            ->setCellValue($Cell[$index++], $row['name']);
                                    break;
                                case -2:
                                    $objWorksheet
                                            ->setCellValue($Cell[$index++], $row['mobile_no']);
                                    break;
                                case -3:
                                    $objWorksheet
                                            ->setCellValue($Cell[$index++], $row['email']);

                                    break;
                                case -4:
                                    $objWorksheet
                                            ->setCellValue($Cell[$index++], $row['age']);
                                    break;

                                default:
//                                    echo $this->getCustomFieldsDataForCustomers($selectedOption, $row['client_id']);
                                    $objWorksheet
                                            ->setCellValue($Cell[$index++], $this->getCustomFieldsDataForCustomers($selectedOption, $row['client_id']));

                                    break;
                            }
                        }

//                        if (isset($_POST['testimonies'])) {
//
//                            $objWorksheet
//                                    ->setCellValue($Cell[$index], $this->getCustomFieldsDataForCustomers($row['client_id']));
//                            $objWorksheet->getStyle($Cell[$index++])->getAlignment()->setWrapText(true);
//                        }
                        if (isset($_POST['testimonies'])) {
                            $objWorksheet
                                    ->setCellValue($Cell[$index], $this->getTestimonialsForClient($row['feedback_id']));
                            $objWorksheet->getStyle($Cell[$index++])->getAlignment()->setWrapText(true);
                        }
//                    echo json_encode($row);
                    }

                    $objWorksheet->setTitle('Report ' . $Feddback_Val . ' Star' . date('Ymd'));


//                    $objPHPExcel->setActiveSheetIndex($index1);
                }

                $objPHPExcel->removeSheetByIndex(0);

                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;
filename = "OpinionDeskReport' . date('Ymd') . '.xls"');
                header('Cache-Control: max-age = 0');
                header('Cache-Control: max-age = 1');

                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header('Pragma: public'); // HTTP/1.0

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');

                Yii::app()->end();
            } catch (Exception $ex) {
                echo "error, " . $ex->getMessage();
                Yii::app()->end();
            }
        }


        $model = new ResponceMaster('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ResponceMaster']))
            $model->attributes = $_GET['ResponceMaster'];

        $this->render('viewbranchreport', array(
            'model' => $model,
            'pName' => $this->pName,
            'pUrl' => $this->pUrl,
            'branch_id' => $branch_id,
        ));
    }

    public function getCustomFieldsDataForCustomers($customer_custom_field_assignment_id, $client_id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT `value` FROM `customer_custom_field_data` "
                    . "WHERE `customer_custom_field_assignment_id`=:customer_custom_field_assignment_id"
                    . " AND `client_id`=:client_id";

            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':client_id', $client_id, PDO::PARAM_INT);
            $command->bindParam(':customer_custom_field_assignment_id', $customer_custom_field_assignment_id, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            foreach ($reader as $row) {
                return $row['value'];
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }
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

            if (isset($_GET['pId']) and $_GET['pId'] > 0) {
                $pId = (int) $_GET['pId'];
                $this->render('view', array(
                    'model' => $this->loadModel($id),
                    'pName' => $this->pName,
                    'pUrl' => $this->pUrl,
                    'pId' => $pId,
                ));
            } else {
                $this->redirect(Yii::app()->createUrl($this->pUrl));
            }
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {

//        if (isset($_GET['pId']) and $_GET['pId'] > 0) {
//            $pId = (int) $_GET['pId'];


        $model = new ResponceMaster;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['ResponceMaster'])) {
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $messageType = 'warning';
                $message = "There are some errors ";
                $model->attributes = $_POST['ResponceMaster'];
//$uploadFile=CUploadedFile::getInstance($model,'filename');
                if ($model->save()) {
                    $messageType = 'success';
                    $message = "<strong>Well done!</strong> You successfully create data ";
                    /*
                      $model2 = ResponceMaster::model()->findByPk($model->id);
                      if(!empty($uploadFile)) {
                      $extUploadFile = substr($uploadFile, strrpos($uploadFile, '.')+1);
                      if(!empty($uploadFile)) {
                      if($uploadFile->saveAs(Yii::app()->basePath.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'responcemaster'.DIRECTORY_SEPARATOR.$model2->id.DIRECTORY_SEPARATOR.$model2->id.'.'.$extUploadFile)){
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
            'pName' => $this->pName,
            'pUrl' => $this->pUrl,
            'pId' => $pId,
        ));
//        } else {
//            $this->redirect(Yii::app()->createUrl($this->pUrl));
//        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {

//        if (isset($_GET['pId']) and $_GET['pId'] > 0) {
//            $pId = (int) $_GET['pId'];


        $model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['ResponceMaster'])) {
            $messageType = 'warning';
            $message = "There are some errors ";
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $model->attributes = $_POST['ResponceMaster'];
                $messageType = 'success';
                $message = "<strong>Well done!</strong> You successfully update data ";

                /*
                  $uploadFile=CUploadedFile::getInstance($model,'filename');
                  if(!empty($uploadFile)) {
                  $extUploadFile = substr($uploadFile, strrpos($uploadFile, '.')+1);
                  if(!empty($uploadFile)) {
                  if($uploadFile->saveAs(Yii::app()->basePath.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'responcemaster'.DIRECTORY_SEPARATOR.$model->id.DIRECTORY_SEPARATOR.$model->id.'.'.$extUploadFile)){
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

            $model->attributes = $_POST['ResponceMaster'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
            'pName' => $this->pName,
            'pUrl' => $this->pUrl,
            'pId' => $pId,
        ));
//        }
//        else {
//            $this->redirect(Yii::app()->createUrl($this->pUrl));
//        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
//    public function actionDelete($id) {
//        if (Yii::app()->request->isPostRequest) {
//// we only allow deletion via POST request
//            $this->loadModel($id)->delete();
//
//// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//            if (!isset($_GET['ajax']))
//                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//        } else
//            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
//    }
//
//    public function actionDownload() {
//        Yii::import('ext.codelord-phpexcel.CPHPExcel');
//
//// Create new PHPExcel object
//        $objPHPExcel = CPHPExcel::createPHPExcel();
//
//// Set document properties
//        $objPHPExcel->getProperties()->setCreator(Yii::app()->user->username)
//                ->setLastModifiedBy(Yii::app()->user->username)
//                ->setTitle("Report")
//                ->setSubject("Office 2007 XLSX Test Document")
//                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
//                ->setKeywords("office 2007 openxml php")
//                ->setCategory("Test result file");
//
//
//// Add some data
//        $objPHPExcel->setActiveSheetIndex(0)
//                ->setCellValue('A1', 'Hello')
//                ->setCellValue('B2', 'world!')
//                ->setCellValue('C1', 'Hello')
//                ->setCellValue('D2', 'world!');
//
//// Miscellaneous glyphs, UTF-8
//        $objPHPExcel->setActiveSheetIndex(0)
//                ->setCellValue('A4', 'Miscellaneous glyphs')
//                ->setCellValue('A5', 'sadfasdf');
//
//// Rename worksheet
//        $objPHPExcel->getActiveSheet()->setTitle('Simple');
//
//
//// Set active sheet index to the first sheet, so Excel opens this as the first sheet
//        $objPHPExcel->setActiveSheetIndex(0);
//
//
//// Redirect output to a clientâ€™s web browser (Excel5)
//        header('Content-Type: application/vnd.ms-excel');
//        header('Content-Disposition: attachment;filename="01simple.xls"');
//        header('Cache-Control: max-age=0');
//// If you're serving to IE 9, then the following may be needed
//        header('Cache-Control: max-age=1');
//
//// If you're serving to IE over SSL, then the following may be needed
//        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
//        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
//        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
//        header('Pragma: public'); // HTTP/1.0
//
//        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//        $objWriter->save('php://output');
//        Yii::app()->end();
//    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

//        if (Yii::app()->request->isPostRequest) {
//
//
//            try {
//                Yii::import('ext.codelord-phpexcel.CPHPExcel');
//
//                $objPHPExcel = CPHPExcel::createPHPExcel();
//
//                $objPHPExcel->getProperties()->setCreator(Yii::app()->user->id)
//                        ->setLastModifiedBy(Yii::app()->user->id)
//                        ->setTitle("Report")
//                        ->setSubject("Office 2007 XLSX Test Document")
//                        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
//                        ->setKeywords("office 2007 openxml php")
//                        ->setCategory("Test result file");
//
//                $looper = 1;
//                if ($_POST['feedback'] == 'all') {
//                    $looper = 6;
//                }
//
//                for ($index1 = 0; $index1 < $looper; $index1++) {
//
//                    $Feddback_Val = $_POST['feedback'];
//                    if ($_POST['feedback'] == 'all') {
//                        $Feddback_Val = $index1;
//                    }
//                    $objWorksheet = new PHPExcel_Worksheet($objPHPExcel);
//                    $objPHPExcel->addSheet($objWorksheet);
//                    $objWorksheet->setTitle('' . $tn);
//
//                    $connection = Yii::app()->db;
//                    $customer_id = Yii::app()->user->id;
//                    $sqlStatement = "SELECT DISTINCT `client_master`.`client_id` ";
//                    $objWorksheet->setCellValue('A1', 'Id');
//                    $Cell = ['B1', 'C1', 'D1', 'E1', 'F1'];
//                    $index = 0;
//                    foreach ($_POST['data_export'] as $selectedOption) {
//                        switch ($selectedOption) {
//                            case 1:
//                                $objWorksheet->setCellValue($Cell[$index++], 'Name');
//                                $sqlStatement .= ",`name`";
//                                break;
//                            case 2:
//                                $objWorksheet->setCellValue($Cell[$index++], 'Mobile No');
//                                $sqlStatement .= ",`mobile_no`";
//                                break;
//                            case 3:
//                                $objWorksheet->setCellValue($Cell[$index++], 'Email');
//                                $sqlStatement .= ",`email`";
//
//                                break;
//                            case 4:
//                                $objWorksheet
//                                        ->setCellValue($Cell[$index++], 'Age');
//                                $sqlStatement .= ",YEAR(CURDATE())-YEAR(`dob`) AS age ";
//                                break;
//
//                            default:
//                                break;
//                        }
//                    }
//                    if (isset($_POST['testimonies'])) {
//                        $objWorksheet
//                                ->setCellValue($Cell[$index++], 'Testimonials');
//                    }
//                    $sqlStatement .= " FROM `responce_master`
//                                INNER JOIN `client_master` ON `client_master`.client_id=`responce_master`.`client_id`
//                                WHERE `question_id` IN
//                                    (SELECT `id`
//                                     FROM `question_master`
//                                     WHERE `branch_id` IN
//                                         (SELECT `id`
//                                          FROM `branch_master`
//                                          WHERE `customer_id`=$customer_id))
//                                  AND DATE(`responce_master`.`created_at`) BETWEEN  DATE('" . $_POST['date_range_from'] . "') AND DATE('" . $_POST['date_range_to'] . "') 
//                                  AND YEAR(CURDATE())-YEAR(`dob`) BETWEEN " . $_POST['age_range_from'] . " AND " . $_POST['age_range_to'] . ' ';
//
//                    switch ($_POST['gender']) {
//                        case 'both':
//
//                            break;
//                        default :
//                            $sqlStatement.='  AND `gender`=' . $_POST['gender'];
//                            break;
//                    }
//                    switch ($_POST['repeat_new']) {
//                        case 'both':
//
//                            break;
//                        case 'repeat' :
//                            $sqlStatement.=' AND `client_master`.`client_id` in '
//                                    . '((SELECT `client_id` FROM `responce_master` '
//                                    . 'WHERE `question_id` in (SELECT `id` FROM '
//                                    . '`question_master` WHERE `branch_id`  in '
//                                    . '(SELECT `id` FROM `branch_master` WHERE '
//                                    . '`customer_id`=' . $customer_id . ')) GROUP BY `client_id` '
//                                    . 'HAVING COUNT(`client_id`)>1))';
//                            break;
//                        case 'new' :
//                            $sqlStatement.=' AND `client_master`.`client_id` in '
//                                    . '((SELECT `client_id` FROM `responce_master` '
//                                    . 'WHERE `question_id` in (SELECT `id` FROM '
//                                    . '`question_master` WHERE `branch_id`  in '
//                                    . '(SELECT `id` FROM `branch_master` WHERE '
//                                    . '`customer_id`=' . $customer_id . ')) GROUP BY `client_id` '
//                                    . 'HAVING COUNT(`client_id`)<=1))';
//                            break;
//                    }
//
//                    switch ($Feddback_Val) {
//                        case 'all':
//
//                            break;
//                        case '0' :
//                            $sqlStatement.=" AND `client_master`.`client_id` in (Select `client_id` from  (SELECT `client_id`,
//                                            `option_value`,
//                                            `question_id`,
//                                            ROUND(AVG(`option_value`), 0) AS Total_AVG
//                                     FROM `responce_master`
//                                     WHERE `question_id` IN
//                                         ( SELECT `id`
//                                          FROM `question_master`
//                                          WHERE `branch_id` IN
//                                              ( SELECT `id`
//                                               FROM `branch_master`
//                                               WHERE `customer_id` =50)) AND DATE(`responce_master`.`created_at`) BETWEEN DATE('" . $_POST['date_range_from'] . "') AND DATE('" . $_POST['date_range_to'] . "')
//                                     GROUP BY `client_id`) AS DATA WHERE Total_AVG=0)";
//                            break;
//                        case '1' :
//                            $sqlStatement.=" AND `client_master`.`client_id` in (Select `client_id` from  (SELECT `client_id`,
//                                            `option_value`,
//                                            `question_id`,
//                                            ROUND(AVG(`option_value`), 0) AS Total_AVG
//                                     FROM `responce_master`
//                                     WHERE `question_id` IN
//                                         ( SELECT `id`
//                                          FROM `question_master`
//                                          WHERE `branch_id` IN
//                                              ( SELECT `id`
//                                               FROM `branch_master`
//                                               WHERE `customer_id` =50)) AND DATE(`responce_master`.`created_at`) BETWEEN DATE('" . $_POST['date_range_from'] . "') AND DATE('" . $_POST['date_range_to'] . "')
//                                     GROUP BY `client_id`) AS DATA WHERE Total_AVG=1)";
//                            break;
//                        case '2' :
//                            $sqlStatement.=" AND `client_master`.`client_id` in (Select `client_id` from  (SELECT `client_id`,
//                                            `option_value`,
//                                            `question_id`,
//                                            ROUND(AVG(`option_value`), 0) AS Total_AVG
//                                     FROM `responce_master`
//                                     WHERE `question_id` IN
//                                         ( SELECT `id`
//                                          FROM `question_master`
//                                          WHERE `branch_id` IN
//                                              ( SELECT `id`
//                                               FROM `branch_master`
//                                               WHERE `customer_id` =50)) AND DATE(`responce_master`.`created_at`) BETWEEN DATE('" . $_POST['date_range_from'] . "') AND DATE('" . $_POST['date_range_to'] . "')
//                                     GROUP BY `client_id`) AS DATA WHERE Total_AVG=2)";
//                            break;
//                        case '3' :
//                            $sqlStatement.=" AND `client_master`.`client_id` in (Select `client_id` from  (SELECT `client_id`,
//                                            `option_value`,
//                                            `question_id`,
//                                            ROUND(AVG(`option_value`), 0) AS Total_AVG
//                                     FROM `responce_master`
//                                     WHERE `question_id` IN
//                                         ( SELECT `id`
//                                          FROM `question_master`
//                                          WHERE `branch_id` IN
//                                              ( SELECT `id`
//                                               FROM `branch_master`
//                                               WHERE `customer_id` =50)) AND DATE(`responce_master`.`created_at`) BETWEEN DATE('" . $_POST['date_range_from'] . "') AND DATE('" . $_POST['date_range_to'] . "')
//                                     GROUP BY `client_id`) AS DATA WHERE Total_AVG=3)";
//                            break;
//                        case '4' :
//                            $sqlStatement.=" AND `client_master`.`client_id` in (Select `client_id` from  (SELECT `client_id`,
//                                            `option_value`,
//                                            `question_id`,
//                                            ROUND(AVG(`option_value`), 0) AS Total_AVG
//                                     FROM `responce_master`
//                                     WHERE `question_id` IN
//                                         ( SELECT `id`
//                                          FROM `question_master`
//                                          WHERE `branch_id` IN
//                                              ( SELECT `id`
//                                               FROM `branch_master`
//                                               WHERE `customer_id` =50)) AND DATE(`responce_master`.`created_at`) BETWEEN DATE('" . $_POST['date_range_from'] . "') AND DATE('" . $_POST['date_range_to'] . "')
//                                     GROUP BY `client_id`) AS DATA WHERE Total_AVG=4)";
//                            break;
//                        case '5' :
//                            $sqlStatement.=" AND `client_master`.`client_id` in (Select `client_id` from  (SELECT `client_id`,
//                                            `option_value`,
//                                            `question_id`,
//                                            ROUND(AVG(`option_value`), 0) AS Total_AVG
//                                     FROM `responce_master`
//                                     WHERE `question_id` IN
//                                         ( SELECT `id`
//                                          FROM `question_master`
//                                          WHERE `branch_id` IN
//                                              ( SELECT `id`
//                                               FROM `branch_master`
//                                               WHERE `customer_id` =50)) AND DATE(`responce_master`.`created_at`) BETWEEN DATE('" . $_POST['date_range_from'] . "') AND DATE('" . $_POST['date_range_to'] . "')
//                                     GROUP BY `client_id`) AS DATA WHERE Total_AVG=5)";
//                            break;
//                    }
//
//                    $command = $connection->createCommand($sqlStatement);
//
//
////                switch ($_POST['feedback']) {
////                    case 'all':
////
////                        break;
////                    default :
////                        $sqlStatement.=' AND `option_value` = :feedback ';
////                        $command->bindParam(':feedback', $_POST['feedback'], PDO::PARAM_INT);
////                        break;
////                }
////                //                $command->bindParam(':from_date', '2013-12-08');
////                echo $sqlStatement . "<br/>";
//                    $command->execute();
//
//                    $reader = $command->query();
//                    $Row_Index = 2;
//                    foreach ($reader as $row) {
//                        $objWorksheet
//                                ->setCellValue('A' . ++$Row_Index, $row['client_id']);
//                        $Cell = ['B' . $Row_Index, 'C' . $Row_Index, 'D' . $Row_Index, 'E' . $Row_Index, 'F' . $Row_Index];
//                        $index = 0;
//                        foreach ($_POST['data_export'] as $selectedOption) {
//                            switch ($selectedOption) {
//                                case 1:
//                                    $objWorksheet
//                                            ->setCellValue($Cell[$index++], $row['name']);
//                                    break;
//                                case 2:
//                                    $objWorksheet
//                                            ->setCellValue($Cell[$index++], $row['mobile_no']);
//                                    break;
//                                case 3:
//                                    $objWorksheet
//                                            ->setCellValue($Cell[$index++], $row['email']);
//
//                                    break;
//                                case 4:
//                                    $objWorksheet
//                                            ->setCellValue($Cell[$index++], $row['age']);
//                                    break;
//
//                                default:
//                                    break;
//                            }
//                        }
//
//                        if (isset($_POST['testimonies'])) {
//                            $objWorksheet
//                                    ->setCellValue($Cell[$index], $this->getTestimonialsForClient($row['client_id']));
//                            $objWorksheet->getStyle($Cell[$index++])->getAlignment()->setWrapText(true);
//                        }
////                    echo json_encode($row);
//                    }
//
//                    $objWorksheet->setTitle('Report ' . $Feddback_Val . ' Star' . date('Ymd'));
//
//
////                    $objPHPExcel->setActiveSheetIndex($index1);
//                }
//
//                header('Content-Type: application/vnd.ms-excel');
//                header('Content-Disposition: attachment;filename="OpinionDeskReport' . date('Ymd') . '.xls"');
//                header('Cache-Control: max-age=0');
//                header('Cache-Control: max-age=1');
//
//                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
//                header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
//                header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
//                header('Pragma: public'); // HTTP/1.0
//
//                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//                $objWriter->save('php://output');
//
//                Yii::app()->end();
//            } catch (Exception $ex) {
//                echo "error, " . $ex->getMessage();
//                Yii::app()->end();
//            }
//        }

        /*
          $dataProvider=new CActiveDataProvider('ResponceMaster');
          $this->render('index',array(
          'dataProvider'=>$dataProvider,
          ));
         */

//        if (isset($_GET['pId']) and $_GET['pId'] > 0) {
//            $pId = (int) $_GET['pId'];


        $model = new ResponceMaster('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ResponceMaster']))
            $model->attributes = $_GET['ResponceMaster'];

        $this->render('index', array(
            'model' => $model,
            'pName' => $this->pName,
            'pUrl' => $this->pUrl,
            'pId' => $pId,
        ));
//        }
//        else {
//            $this->redirect(Yii::app()->createUrl($this->pUrl));
//        }
    }

    public function getTestimonialsForClient($feedback_id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT `responce_text` FROM "
                    . "`testimonial_response_table` WHERE "
                    . "`branch_id`=" . $_POST['branch_id'] . "  AND `feedback_id` = $feedback_id";


            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':customer_id', Yii::app()->user->id, PDO::PARAM_INT);
            $command->bindParam(':client_id', $client_id, PDO::PARAM_INT);
//            $command->bindParam(':TO_DATE', $to_Date, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            $Responce_Text = "Testimonials : \n ";
            foreach ($reader as $row) {
                $Responce_Text.= " \n " . $row['responce_text'];
            }
        } catch (Exception $ex) {
            echo "error, " . $ex->getMessage();
        }
        return $Responce_Text;
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {

//        if (isset($_GET['pId']) and $_GET['pId'] > 0) {
//            $pId = (int) $_GET['pId'];


        $model = new ResponceMaster('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ResponceMaster']))
            $model->attributes = $_GET['ResponceMaster'];

        $this->render('admin', array(
            'model' => $model,
            'pName' => $this->pName,
            'pUrl' => $this->pUrl,
            'pId' => $pId,
        ));
//        }
//        else {
//            $this->redirect(Yii::app()->createUrl($this->pUrl));
//        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return ResponceMaster the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = ResponceMaster::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param ResponceMaster $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'responce-master-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionExport() {
        $model = new ResponceMaster;
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['ResponceMaster']))
            $model->attributes = $_POST['ResponceMaster'];

        $exportType = $_POST['fileType'];
        $this->widget('ext.heart.export.EHeartExport', array(
            'title' => 'List of ResponceMaster',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'grid_mode' => 'export',
            'exportType' => $exportType,
            'columns' => array(
                'id',
                'option_value',
                'responce_text',
                'responce_audio_url',
                'responce_vedio_url',
                'created_at',
                'question_id',
                'client_id',
            ),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionImport() {

        $model = new ResponceMaster;
// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['ResponceMaster'])) {
            if (!empty($_FILES)) {
                $tempFile = $_FILES['ResponceMaster']['tmp_name']['fileImport'];
                $fileTypes = array('xls', 'xlsx'); // File extensions
                $fileParts = pathinfo($_FILES['ResponceMaster']['name']['fileImport']);
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
                        $option_value = $sheetData[$baseRow]['B'];
                        $responce_text = $sheetData[$baseRow]['C'];
                        $responce_audio_url = $sheetData[$baseRow]['D'];
                        $responce_vedio_url = $sheetData[$baseRow]['E'];
                        $created_at = $sheetData[$baseRow]['F'];
                        $question_id = $sheetData[$baseRow]['G'];
                        $client_id = $sheetData[$baseRow]['H'];

                        $model2 = new ResponceMaster;
//$model2->id=  $id;
                        $model2->option_value = $option_value;
                        $model2->responce_text = $responce_text;
                        $model2->responce_audio_url = $responce_audio_url;
                        $model2->responce_vedio_url = $responce_vedio_url;
                        $model2->created_at = $created_at;
                        $model2->question_id = $question_id;
                        $model2->client_id = $client_id;

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
        $es = new TbEditableSaver('ResponceMaster');
        $es->update();
    }

    public function actions() {
        return array(
            'toggle' => array(
                'class' => 'bootstrap.actions.TbToggleAction',
                'modelName' => 'ResponceMaster',
            )
        );
    }

}
