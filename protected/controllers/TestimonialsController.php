<?php

class TestimonialsController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $menuCaption = "Sub Menu";
    public $layout = '//layouts/column2';

    /**
     * Lists all models.
     */
    public function actionIndex() {

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

                $objWorksheet = new PHPExcel_Worksheet($objPHPExcel);
                $objPHPExcel->addSheet($objWorksheet);
                $objWorksheet->setTitle('' . $tn);

                $connection = Yii::app()->db;
                $customer_id = Yii::app()->user->id;
                $sqlStatement = "SELECT DISTINCT `client_master`.`client_id` ";
                $objWorksheet->setCellValue('A1', 'Customer Name');
                $objWorksheet->setCellValue('B1', 'Customer Phone');
                $objWorksheet->setCellValue('C1', 'Text Testimonials');
                $objWorksheet->setCellValue('D1', 'Audio Testimonials');
                $objWorksheet->setCellValue('E1', 'Video Testimonials');
//                $Cell = ['B1', 'C1', 'D1', 'E1', 'F1', 'G1', 'H1', 'I1', 'J1', 'K1', 'L1', 'M1', 'N1', 'O1', 'P1'];



                $connection = Yii::app()->db;
                if (isset($_GET['branch_id'])) {
                    $branch_id = $_GET['branch_id'];
                } else {
                    $Branches = BranchMaster::model()->findAll(array(
                        'condition' => 'customer_id = :customer_id',
                        'params' => array(':customer_id' => Yii::app()->user->id)
                    ));
                    $branch_id = $Branches[0]->id;
                }
                $sqlStatement = "Select * from  (SELECT `client_id`,
                                            `option_value`,
                                            `question_id`,
                                            ROUND(AVG(`option_value`), 0) AS Total_AVG
                                     FROM `responce_master`
                                     WHERE `question_id` IN
                                         ( SELECT `id`
                                          FROM `question_master`
                                          WHERE `branch_id` = $branch_id) 
                                     GROUP BY `client_id`)AS DATA INNER JOIN `testimonial_response_table`
                                     ON DATA.`client_id`=`testimonial_response_table`.`client_id` 
                                     INNER JOIN `client_master` ON `client_master`.`client_id`=DATA.`client_id`
                                      ";
                $Feddback_Val = $_GET['feedback'];
                switch (true) {
                    case ($Feddback_Val == '0' || $Feddback_Val == null ) :
                        $sqlStatement .= "WHERE Total_AVG=0";
                        break;
                    case ($Feddback_Val == '1') :
                        $sqlStatement .= "WHERE Total_AVG=1";
                        break;
                    case ($Feddback_Val == '2') :
                        $sqlStatement .= "WHERE Total_AVG=2";
                        break;
                    case ($Feddback_Val == '3') :
                        $sqlStatement .= "WHERE Total_AVG=3";
                        break;
                    case ($Feddback_Val == '4'):
                        $sqlStatement .= "WHERE Total_AVG=4";
                        break;
                    case ($Feddback_Val == '5'):
                        $sqlStatement .= "WHERE Total_AVG=5";
                        break;
                    case ($Feddback_Val == 'all'):
                        break;
                }

//            echo $sqlStatement;
//            Yii::app()->end();
                $command = $connection->createCommand($sqlStatement);

                $command->bindParam(':client_id', $client_id, PDO::PARAM_INT);
                $command->bindParam(':customer_custom_field_assignment_id', $customer_custom_field_assignment_id, PDO::PARAM_INT);

                $command->execute();

                $testimonials = $command->query();
                $Row_Index = 2;
                foreach ($testimonials as $testimonial) {
                    $objWorksheet
                            ->setCellValue('A' . ++$Row_Index, $testimonial['name']);
                    $objWorksheet
                            ->setCellValue('B' . $Row_Index, $testimonial['mobile_no']);
                    $objWorksheet
                            ->setCellValue('C' . $Row_Index, $testimonial['responce_text']);
                    $objWorksheet
                            ->setCellValue('D' . $Row_Index, $testimonial['responce_audio_url']);
                    $objWorksheet
                            ->setCellValue('E' . $Row_Index, 'https://www.youtube.com/watch?v=' . $testimonial['responce_vedio_url']);
                }
            } catch (Exception $ex) {
                echo "error, " . $ex->getMessage();
            }
            $objWorksheet->setTitle('testimonials' . $Feddback_Val . ' Star ' . date('Ymd'));
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename = "OpinionDesktestimonials' . date('Ymd') . '.xls"');
            header('Cache-Control: max-age = 0');
            header('Cache-Control: max-age = 1');

            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');

            Yii::app()->end();
            Yii::app()->end();
        }

        try {


            $connection = Yii::app()->db;
            if (isset($_GET['branch_id'])) {
                $branch_id = $_GET['branch_id'];
            } else {
                $Branches = BranchMaster::model()->findAll(array(
                    'condition' => 'customer_id = :customer_id',
                    'params' => array(':customer_id' => Yii::app()->user->id)
                ));
                $branch_id = $Branches[0]->id;
            }
            $sqlStatement = "Select * from  (SELECT `client_id`,
                        `option_value`,
                        `question_id`,
                        ROUND(AVG(`option_value`), 0) AS Total_AVG
                        FROM `responce_master`
                        WHERE `question_id` IN
                        ( SELECT `id`
                        FROM `question_master`
                        WHERE `branch_id` = $branch_id) 
                        GROUP BY `client_id`)AS DATA INNER JOIN `testimonial_response_table`
                        ON DATA.`client_id`=`testimonial_response_table`.`client_id` 
                        INNER JOIN `client_master` ON `client_master`.`client_id`=DATA.`client_id`
                        ";
            $Feddback_Val = $_GET['feedback'];
            switch (true) {
                case ($Feddback_Val == '0' || $Feddback_Val == null ) :
                    $sqlStatement .= "WHERE Total_AVG=0";
                    break;
                case ($Feddback_Val == '1') :
                    $sqlStatement .= "WHERE Total_AVG=1";
                    break;
                case ($Feddback_Val == '2') :
                    $sqlStatement .= "WHERE Total_AVG=2";
                    break;
                case ($Feddback_Val == '3') :
                    $sqlStatement .= "WHERE Total_AVG=3";
                    break;
                case ($Feddback_Val == '4'):
                    $sqlStatement .= "WHERE Total_AVG=4";
                    break;
                case ($Feddback_Val == '5'):
                    $sqlStatement .= "WHERE Total_AVG=5";
                    break;
                case ($Feddback_Val == 'all'):
                    $sqlStatement .= "ORDER BY Total_AVG ";
                    break;
            }

//            echo $sqlStatement;
//            Yii::app()->end();
            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':client_id', $client_id, PDO::PARAM_INT);
            $command->bindParam(':customer_custom_field_assignment_id', $customer_custom_field_assignment_id, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            $this->render('index', array('testimonials' => $reader));
            Yii::app()->end();
        } catch (Exception $ex) {
            echo "error, " . $ex->getMessage();
        }

        $this->render('index');
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
