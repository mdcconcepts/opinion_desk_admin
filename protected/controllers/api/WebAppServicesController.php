<?php

class WebAppServicesController extends Controller {

    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers 
     */
    Const APPLICATION_ID = 'OPINION_DESK';

    private $format = 'json';

    /**
     * @return array action filters
     */
//    public function filters() {
//        return array(
//            'accessControl', // perform access control for CRUD operations
//            'postOnly + Auth', // we only allow deletion via POST request
//        );
//    }

    public function actiongetAllNotificationForUser() {
        if (!isset($_POST['customer_id'])) {
            $Responce = [
                'Status_code' => '200',
                'Success' => 'False',
                'Message' => 'Bad Request Parameters',
                'Error' => 'Customer Id not found.'
            ];
            $this->_sendResponse(200, $Responce);
        }

        $Notifications = NotificationMaster::model()->findAll(array(
            'condition' => 'customer_id = :customer_id AND read_status = :read_status',
            'params' => array(':customer_id' => $_POST['customer_id'], ':read_status' => 0)
        ));
        if (count($Notifications) != 0) {

            $Responce_Notification = array();
            foreach ($Notifications as $notification) {
                $notification->created_at = $this->Time_Elapsed(strtotime($notification->created_at));
                array_push($Responce_Notification, $notification);
            }
            $Responce = [
                'Status_code' => '200',
                'Success' => 'True',
                'Notification_Count' => count($Notifications),
                'Notification' => $Responce_Notification,
            ];
            $this->_sendResponse(200, $Responce);
        } else {
            $Responce = [
                'Status_code' => '200',
                'Success' => 'False',
                'Message' => 'Notification Not Found',
            ];
            $this->_sendResponse(200, $Responce);
        }
    }

    private function Time_Elapsed($time) {
        date_default_timezone_set("Asia/Kolkata");
        $time = time() - $time; // to get the time since that moment

        $tokens = array(
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit)
                continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's ago' : ' ago');
        }
    }

    public function actionpostTableNumberForBranch() {
//        $customer_id = Yii::app()->request->getPost('username');

        if (!isset($_POST['pk'])) {
            $Responce = [
                'Status_code' => '200',
                'Success' => 'False',
                'Message' => 'Bad Request Parameters',
                'Error' => 'pk not found.'
            ];
            $this->_sendResponse(200, $Responce);
        } elseif (!isset($_POST['value'])) {
            $Responce = [
                'Status_code' => '200',
                'Success' => 'False',
                'Message' => 'Bad Request Parameters',
                'Error' => 'value not found.'
            ];
            $this->_sendResponse(200, $Responce);
        } elseif ($_POST['value'] <= 0) {
            $Responce = [
                'Status_code' => '200',
                'Success' => 'False',
                'Message' => 'Tablet number must be greater than 0!',
                'Error' => 'value not found.'
            ];
            $this->_sendResponse(200, $Responce);
        }

        $Branch = BranchMaster::model()->findByPK($_POST['pk']);
        $Branch->tablet_no = $_POST['value'];
        if ($Branch->save()) {
            $Responce = [
                'Status_code' => '200',
                'Success' => 'True',
                'Message' => 'Tablet Number Save'
            ];
            $this->_sendResponse(200, $Responce);
        } else {
            $Responce = [
                'Status_code' => '200',
                'Success' => 'False',
                'Message' => $Branch->getErrors()['tablet_no'][0],
            ];
            $this->_sendResponse(200, $Responce);
        }
        $Responce = [
            'Status_code' => '200',
            'Success' => 'False',
            'Message' => 'Unknown Responce',
        ];
        $this->_sendResponse(200, $Responce);
    }

    public function actionpostStatusForUser() {
//        $customer_id = Yii::app()->request->getPost('username');

        if (!isset($_POST['pk'])) {
            $Responce = [
                'Status_code' => '200',
                'Success' => 'False',
                'Message' => 'Bad Request Parameters',
                'Error' => 'pk not found.'
            ];
            $this->_sendResponse(200, $Responce);
        } elseif (!isset($_POST['value'])) {
            $Responce = [
                'Status_code' => '200',
                'Success' => 'False',
                'Message' => 'Bad Request Parameters',
                'Error' => 'value not found.'
            ];
            $this->_sendResponse(200, $Responce);
        }

        $Branch = User::model()->findByPK($_POST['pk']);
        $Branch->status = $_POST['value'];
        if ($Branch->save()) {
            $Responce = [
                'Status_code' => '200',
                'Success' => 'True',
                'Message' => 'Status saved'
            ];
            $this->_sendResponse(200, $Responce);
        } else {
            $Responce = [
                'Status_code' => '200',
                'Success' => 'False',
                'Message' => $Branch->getErrors()['tablet_no'][0],
            ];
            $this->_sendResponse(200, $Responce);
        }
        $Responce = [
            'Status_code' => '200',
            'Success' => 'False',
            'Message' => 'Unknown Responce',
        ];
        $this->_sendResponse(200, $Responce);
    }

    /**
     * This method is used for getting totoal feedback for graph
     * In this 1 represent weekly , 2 Montly and 3 Yearly
     */
    public function actiongetFeedbackDataForDashboardForGraph() {
        $customer_id = Yii::app()->request->getPost('customer_id');
        $period = Yii::app()->request->getPost('period');
        switch ($period) {
            case 1:

                try {

                    $connection = Yii::app()->db;

                    $sqlStatement = "SELECT Week(`created_at`) AS Week,COUNT(`created_at`)
                Total_Customer_Visit,AVG(`option_value`)
                Average_Feedback_Value FROM `responce_master` WHERE MONTH(`created_at`)=MONTH(now()) 
                AND `question_id` in (SELECT `id` FROM `question_master` WHERE `branch_id` in
                (SELECT `id` FROM `branch_master` WHERE `customer_id`=:customer_id))
                GROUP BY Week(`created_at`)";

                    $command = $connection->createCommand($sqlStatement);

                    $command->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);

                    $command->execute();

                    $reader = $command->query();

                    $dataProvider = array();

                    $i = 1;

                    foreach ($reader as $row) {
                        $data = array();
                        $data['date'] = date("Y-m-d", strtotime(date("Y") . "W" . ($row['Week'] + 1)));
                        $data['value'] = $row['Total_Customer_Visit'];
                        $data['volume'] = round($row['Average_Feedback_Value'], 2);
                        array_push($dataProvider, $data);
                    }

                    $Responce = [
                        'Status_code' => '200',
                        'Success' => 'True',
                        'Message' => 'Data found',
                        'dataProvider' => $dataProvider
                    ];
                    $this->_sendResponse(200, $Responce);
                } catch (Exception $ex) {
                    $Responce = [
                        'Status_code' => '403',
                        'Success' => 'False',
                        'Message' => 'Exceoption Occure',
                        'Error' => $ex->getMessage(),
                    ];
                    $this->_sendResponse(401, $Responce);
                }
                break;
            case 2:
                try {

                    $connection = Yii::app()->db;

                    echo $sqlStatement = "SELECT Month(`created_at`) AS Month,COUNT(`created_at`)
                Total_Customer_Visit,AVG(`option_value`)
                Average_Feedback_Value FROM `responce_master` WHERE YEAR(`created_at`)=YEAR(now()) 
                AND `question_id` in (SELECT `id` FROM `question_master` WHERE `branch_id` in
                (SELECT `id` FROM `branch_master` WHERE `customer_id`=:customer_id))
                GROUP BY MONTH(`created_at`)";

                    $command = $connection->createCommand($sqlStatement);

                    $command->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);

                    $command->execute();

                    $reader = $command->query();

                    $dataProvider = array();

                    $i = 1;

                    foreach ($reader as $row) {
                        $data = array();
                        $data['date'] = date("Y") . '-' . $row['Month'] . '-' . '1';
                        $data['value'] = $row['Total_Customer_Visit'];
                        $data['volume'] = round($row['Average_Feedback_Value'], 2);
                        array_push($dataProvider, $data);
                    }

                    $Responce = [
                        'Status_code' => '200',
                        'Success' => 'True',
                        'Message' => 'Data found',
                        'dataProvider' => $dataProvider
                    ];
                    $this->_sendResponse(200, $Responce);
                } catch (Exception $ex) {
                    $Responce = [
                        'Status_code' => '403',
                        'Success' => 'False',
                        'Message' => 'Exceoption Occure',
                        'Error' => $ex->getMessage(),
                    ];
                    $this->_sendResponse(401, $Responce);
                }

                break;
            case 3:
                try {

                    $connection = Yii::app()->db;

                    $sqlStatement = "SELECT YEAR(`created_at`) AS YEAR,COUNT(`created_at`)
                Total_Customer_Visit,AVG(`option_value`)
                Average_Feedback_Value FROM `responce_master` WHERE 
                `question_id` in (SELECT `id` FROM `question_master` WHERE `branch_id` in
                (SELECT `id` FROM `branch_master` WHERE `customer_id`=:customer_id))
                GROUP BY YEAR(`created_at`)";

                    $command = $connection->createCommand($sqlStatement);

                    $command->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);

                    $command->execute();

                    $reader = $command->query();

                    $dataProvider = array();

                    $i = 1;

                    foreach ($reader as $row) {
                        $data = array();
                        $data['date'] = $row['YEAR'];
                        $data['value'] = $row['Total_Customer_Visit'];
                        $data['volume'] = round($row['Average_Feedback_Value'], 2);
                        array_push($dataProvider, $data);
                    }

                    $Responce = [
                        'Status_code' => '200',
                        'Success' => 'True',
                        'Message' => 'Data found',
                        'dataProvider' => $dataProvider
                    ];
                    $this->_sendResponse(200, $Responce);
                } catch (Exception $ex) {
                    $Responce = [
                        'Status_code' => '403',
                        'Success' => 'False',
                        'Message' => 'Exceoption Occure',
                        'Error' => $ex->getMessage(),
                    ];
                    $this->_sendResponse(401, $Responce);
                }

                break;
            default:
                break;
        }

        $Responce = [
            'Status_code' => '401',
            'Success' => 'False',
            'Message' => 'Authentication Fail!',
            'Error' => 'Unknown Error.',
        ];
        $this->_sendResponse(401, $Responce);
    }

    public function actiongetFeedbackDataForDashboardForGraphBranch() {
        $branch_id = Yii::app()->request->getPost('branch_id');
        $period = Yii::app()->request->getPost('period');
        switch ($period) {
            case 1:

                try {

                    $connection = Yii::app()->db;

                    $sqlStatement = "SELECT Week(`created_at`) AS Week,COUNT(`created_at`)
                Total_Customer_Visit,AVG(`option_value`)
                Average_Feedback_Value FROM `responce_master` WHERE MONTH(`created_at`)=MONTH(now()) 
                AND `question_id` in (SELECT `id` FROM `question_master` WHERE `branch_id`=:branch_id )
                GROUP BY Week(`created_at`)";

                    $command = $connection->createCommand($sqlStatement);

                    $command->bindParam(':branch_id', $branch_id, PDO::PARAM_INT);

                    $command->execute();

                    $reader = $command->query();

                    $dataProvider = array();

                    $i = 1;

                    foreach ($reader as $row) {
                        $data = array();
                        $data['date'] = date("Y-m-d", strtotime(date("Y") . "W" . ($row['Week'] + 1)));
                        $data['value'] = $row['Total_Customer_Visit'];
                        $data['volume'] = round($row['Average_Feedback_Value'], 2);
                        array_push($dataProvider, $data);
                    }

                    $Responce = [
                        'Status_code' => '200',
                        'Success' => 'True',
                        'Message' => 'Data found',
                        'dataProvider' => $dataProvider
                    ];
                    $this->_sendResponse(200, $Responce);
                } catch (Exception $ex) {
                    $Responce = [
                        'Status_code' => '403',
                        'Success' => 'False',
                        'Message' => 'Exceoption Occure',
                        'Error' => $ex->getMessage(),
                    ];
                    $this->_sendResponse(401, $Responce);
                }
                break;
            case 2:
                try {

                    $connection = Yii::app()->db;

                    $sqlStatement = "SELECT Month(`created_at`) AS Month,COUNT(`created_at`)
                Total_Customer_Visit,AVG(`option_value`)
                Average_Feedback_Value FROM `responce_master` WHERE YEAR(`created_at`)=YEAR(now()) 
                AND `question_id` in (SELECT `id` FROM `question_master` WHERE `branch_id`=:branch_id
                )
                GROUP BY MONTH(`created_at`)";

                    $command = $connection->createCommand($sqlStatement);

                    $command->bindParam(':branch_id', $branch_id, PDO::PARAM_INT);

                    $command->execute();

                    $reader = $command->query();

                    $dataProvider = array();

                    $i = 1;

                    foreach ($reader as $row) {
                        $data = array();
                        $data['date'] = date("Y") . '-' . $row['Month'] . '-' . '1';
                        $data['value'] = $row['Total_Customer_Visit'];
                        $data['volume'] = round($row['Average_Feedback_Value'], 2);
                        array_push($dataProvider, $data);
                    }

                    $Responce = [
                        'Status_code' => '200',
                        'Success' => 'True',
                        'Message' => 'Data found',
                        'dataProvider' => $dataProvider
                    ];
                    $this->_sendResponse(200, $Responce);
                } catch (Exception $ex) {
                    $Responce = [
                        'Status_code' => '403',
                        'Success' => 'False',
                        'Message' => 'Exceoption Occure',
                        'Error' => $ex->getMessage(),
                    ];
                    $this->_sendResponse(401, $Responce);
                }

                break;
            case 3:
                try {

                    $connection = Yii::app()->db;

                    $sqlStatement = "SELECT YEAR(`created_at`) AS YEAR,COUNT(`created_at`)
                Total_Customer_Visit,AVG(`option_value`)
                Average_Feedback_Value FROM `responce_master` WHERE 
                `question_id` in (SELECT `id` FROM `question_master` WHERE `branch_id`=:branch_id )
                GROUP BY YEAR(`created_at`)";

                    $command = $connection->createCommand($sqlStatement);

                    $command->bindParam(':branch_id', $branch_id, PDO::PARAM_INT);

                    $command->execute();

                    $reader = $command->query();

                    $dataProvider = array();

                    $i = 1;

                    foreach ($reader as $row) {
                        if ($row['YEAR'] != 0) {
                            $data = array();
                            $data['date'] = $row['YEAR'] . '-1-1';
                            $data['value'] = $row['Total_Customer_Visit'];
                            $data['volume'] = round($row['Average_Feedback_Value'], 2);
                            array_push($dataProvider, $data);
                        }
                    }

                    $Responce = [
                        'Status_code' => '200',
                        'Success' => 'True',
                        'Message' => 'Data found',
                        'dataProvider' => $dataProvider
                    ];
                    $this->_sendResponse(200, $Responce);
                } catch (Exception $ex) {
                    $Responce = [
                        'Status_code' => '403',
                        'Success' => 'False',
                        'Message' => 'Exceoption Occure',
                        'Error' => $ex->getMessage(),
                    ];
                    $this->_sendResponse(401, $Responce);
                }

                break;
            default:
                break;
        }

        $Responce = [
            'Status_code' => '401',
            'Success' => 'False',
            'Message' => 'Authentication Fail!',
            'Error' => 'Unknown Error.',
        ];
        $this->_sendResponse(401, $Responce);
    }

    public function actiongetCategoryDataForDashboardForGraphBranch() {
        $branch_id = Yii::app()->request->getPost('branch_id');
        $period = Yii::app()->request->getPost('period');
        try {

            $connection = Yii::app()->db;

            $sqlStatement = "select category_name,Average_Feedback_Value from "
                    . "(SELECT created_at,category_id,AVG(`option_value`) AS
                         Average_Feedback_Value "
                    . "FROM `responce_master` INNER JOIN (SELECT branch_id,id, "
                    . "`category_id` FROM `question_master` WHERE  `category_id` "
                    . "IN (SELECT `id` FROM `category_master` WHERE `lob_id` IN "
                    . "(SELECT `lob` FROM `profiles` WHERE `user_id`=50))) AS"
                    . " Categories on responce_master. `question_id` = Categories.id"
                    . " where `branch_id` = :branch_id AND DATE(`created_at`) BETWEEN "
                    . "DATE(:FROM_DATE) AND DATE(:TO_DATE) GROUP BY category_id) "
                    . "AS Category_Data INNER JOIN `category_master` ON "
                    . "Category_Data.category_id=category_master.id";

            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':branch_id', $branch_id, PDO::PARAM_INT);
            switch ($period) {
                case 1:

                    $command->bindParam(':FROM_DATE', date('Y-m-d'), PDO::PARAM_INT);
                    $command->bindParam(':TO_DATE', date('Y-m-d'), PDO::PARAM_INT);
                    break;
                case 2:

                    $command->bindParam(':FROM_DATE', date('Y-m-d', strtotime('monday this week')), PDO::PARAM_INT);
                    $command->bindParam(':TO_DATE', date('Y-m-d'), PDO::PARAM_INT);
                    break;
                case 3:

                    $command->bindParam(':FROM_DATE', date('Y-m-d', strtotime('first day of this month')), PDO::PARAM_INT);
                    $command->bindParam(':TO_DATE', date('Y-m-d'), PDO::PARAM_INT);
                    break;
                case 4:

                    $command->bindParam(':FROM_DATE', date('Y-m-d', strtotime('first day of January this year')), PDO::PARAM_INT);
                    $command->bindParam(':TO_DATE', date('Y-m-d'), PDO::PARAM_INT);
                    break;
                default:
                    break;
            }

            $command->execute();

            $reader = $command->query();

            $dataProvider = array();

            $i = 1;

            foreach ($reader as $row) {
                $data = array();
                $data['country'] = $row['category_name'];
                $data['visits'] = round($row['Average_Feedback_Value'], 2);
                array_push($dataProvider, $data);
            }

            $Responce = [
                'Status_code' => '200',
                'Success' => 'True',
                'Message' => 'Data found',
                'dataProvider' => $dataProvider
            ];
            $this->_sendResponse(200, $Responce);
        } catch (Exception $ex) {
            $Responce = [
                'Status_code' => '403',
                'Success' => 'False',
                'Message' => 'Exceoption Occure',
                'Error' => $ex->getMessage(),
            ];
            $this->_sendResponse(401, $Responce);
        }
        $Responce = [
            'Status_code' => '401',
            'Success' => 'False',
            'Message' => 'Authentication Fail!',
            'Error' => 'Unknown Error.',
        ];
        $this->_sendResponse(401, $Responce);
    }

    /**
     * Sends the API response 
     * 
     * @param int $status 
     * @param string $body 
     * @param string $content_type 
     * @access private
     * @return void
     */
    private function _sendResponse($status = 200, $body = '', $content_type = 'application/json') {
// set the status
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        header($status_header);
// and the content type
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Authorization");
        header('Content-type: ' . $content_type);

// pages with body are easy
        if ($body != '') {
// send the body
            echo CJSON::encode($body);
        } else {
// create some body messages
            $message = '';


// this is purely optional, but makes the pages a little nicer to read
// for your users.  Since you won't likely send a lot of different status codes,
// this also shouldn't be too ponderous to maintain
            switch ($status) {
                case 401:
                    $message = 'You must be authorized to use this service.';
                    break;
                case 403:
                    $message = 'Forbidden to use this service.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:

                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }

            $body = [
                'Status_code' => $status,
                'Success' => 'False',
                'Message' => $message,
            ];

            echo CJSON::encode($body);
        }
        Yii::app()->end();
    }

    public function actiongetFeedbackDataForDashboardForGraphBranch_For_MALE_AND_FEMALE() {
        $branch_id = Yii::app()->request->getPost('branch_id');
        $period = Yii::app()->request->getPost('period');
        switch ($period) {
            case 1:

                try {

                    $connection = Yii::app()->db;

                    $sqlStatement = "select MALE_DATA.Week,Total_Male_Visit,Total_Female_Visit from "
                            . "(SELECT Week(`created_at`) AS Week,COUNT(`created_at`) Total_Male_Visit FROM "
                            . "`responce_master` WHERE Month(`created_at`)=Month(now()) AND `question_id` in (SELECT `id` "
                            . "FROM `question_master` WHERE `branch_id`=:branch_id) AND `client_id` in (SELECT `client_id` FROM "
                            . "`client_master` WHERE `gender`=1) GROUP BY Week(`created_at`)) AS MALE_DATA INNER JOIN "
                            . "(SELECT Week(`created_at`) AS Week,COUNT(`created_at`) Total_Female_Visit FROM "
                            . "`responce_master` WHERE Month(`created_at`)=Month(now()) AND `question_id` in (SELECT `id`"
                            . " FROM `question_master` WHERE `branch_id`=:branch_id) AND `client_id` in (SELECT `client_id` FROM "
                            . "`client_master` WHERE `gender`=0) GROUP BY Week(`created_at`)) AS FEMALE_DATA ON "
                            . "MALE_DATA.Week =FEMALE_DATA.Week";

                    $command = $connection->createCommand($sqlStatement);

                    $command->bindParam(':branch_id', $branch_id, PDO::PARAM_INT);

                    $command->execute();

                    $reader = $command->query();

                    $dataProvider = array();

                    $i = 1;

                    foreach ($reader as $row) {
                        $data = array();
                        $data['date'] = date("Y-m-d", strtotime(date("Y") . "W" . ($row['Week'] + 1)));
                        $data['visits'] = $row['Total_Male_Visit'];
                        $data['hits'] = $row['Total_Female_Visit'];
                        array_push($dataProvider, $data);
                    }

                    $Responce = [
                        'Status_code' => '200',
                        'Success' => 'True',
                        'Message' => 'Data found',
                        'dataProvider' => $dataProvider
                    ];
                    $this->_sendResponse(200, $Responce);
                } catch (Exception $ex) {
                    $Responce = [
                        'Status_code' => '403',
                        'Success' => 'False',
                        'Message' => 'Exceoption Occure',
                        'Error' => $ex->getMessage(),
                    ];
                    $this->_sendResponse(401, $Responce);
                }
                break;
            case 2:
                try {

                    $connection = Yii::app()->db;

                    $sqlStatement = "select MALE_DATA.MONTH,Total_Male_Visit,Total_Female_Visit from "
                            . "(SELECT MONTH(`created_at`) AS MONTH,COUNT(`created_at`) Total_Male_Visit FROM "
                            . "`responce_master` WHERE YEAR(`created_at`)=YEAR(now()) AND `question_id` in (SELECT `id` "
                            . "FROM `question_master` WHERE `branch_id`=:branch_id) AND `client_id` in (SELECT `client_id` FROM "
                            . "`client_master` WHERE `gender`=1) GROUP BY MONTH(`created_at`)) AS MALE_DATA INNER JOIN "
                            . "(SELECT MONTH(`created_at`) AS MONTH,COUNT(`created_at`) Total_Female_Visit FROM "
                            . "`responce_master` WHERE YEAR(`created_at`)=YEAR(now()) AND `question_id` in (SELECT `id`"
                            . " FROM `question_master` WHERE `branch_id`=:branch_id) AND `client_id` in (SELECT `client_id` FROM "
                            . "`client_master` WHERE `gender`=0) GROUP BY MONTH(`created_at`)) AS FEMALE_DATA ON "
                            . "MALE_DATA.MONTH =FEMALE_DATA.MONTH";

                    $command = $connection->createCommand($sqlStatement);

                    $command->bindParam(':branch_id', $branch_id, PDO::PARAM_INT);

                    $command->execute();

                    $reader = $command->query();

                    $dataProvider = array();

                    $i = 1;

                    foreach ($reader as $row) {
                        $data = array();
                        $data['date'] = date("Y") . '-' . $row['MONTH'] . '-' . '1';
                        $data['visits'] = $row['Total_Male_Visit'];
                        $data['hits'] = $row['Total_Female_Visit'];
                        array_push($dataProvider, $data);
                    }

                    $Responce = [
                        'Status_code' => '200',
                        'Success' => 'True',
                        'Message' => 'Data found',
                        'dataProvider' => $dataProvider
                    ];
                    $this->_sendResponse(200, $Responce);
                } catch (Exception $ex) {
                    $Responce = [
                        'Status_code' => '403',
                        'Success' => 'False',
                        'Message' => 'Exceoption Occure',
                        'Error' => $ex->getMessage(),
                    ];
                    $this->_sendResponse(401, $Responce);
                }

                break;
            case 3:
                try {

                    $connection = Yii::app()->db;

                    $sqlStatement = "select MALE_DATA.Year,Total_Male_Visit,Total_Female_Visit from "
                            . "(SELECT Year(`created_at`) AS Year,COUNT(`created_at`) Total_Male_Visit FROM "
                            . "`responce_master` WHERE  `question_id` in (SELECT `id` "
                            . "FROM `question_master` WHERE `branch_id`=:branch_id) AND `client_id` in (SELECT `client_id` FROM "
                            . "`client_master` WHERE `gender`=1) GROUP BY Year(`created_at`)) AS MALE_DATA INNER JOIN "
                            . "(SELECT Year(`created_at`) AS Year,COUNT(`created_at`) Total_Female_Visit FROM "
                            . "`responce_master` WHERE  `question_id` in (SELECT `id`"
                            . " FROM `question_master` WHERE `branch_id`=:branch_id) AND `client_id` in (SELECT `client_id` FROM "
                            . "`client_master` WHERE `gender`=0) GROUP BY Year(`created_at`)) AS FEMALE_DATA ON "
                            . "MALE_DATA.Year =FEMALE_DATA.Year";


                    $command = $connection->createCommand($sqlStatement);

                    $command->bindParam(':branch_id', $branch_id, PDO::PARAM_INT);

                    $command->execute();

                    $reader = $command->query();

                    $dataProvider = array();

                    $i = 1;

                    foreach ($reader as $row) {
                        $data = array();
                        $data['date'] = $row['Year'];
                        $data['visits'] = $row['Total_Male_Visit'];
                        $data['hits'] = $row['Total_Female_Visit'];
                        array_push($dataProvider, $data);
                    }

                    $Responce = [
                        'Status_code' => '200',
                        'Success' => 'True',
                        'Message' => 'Data found',
                        'dataProvider' => $dataProvider
                    ];
                    $this->_sendResponse(200, $Responce);
                } catch (Exception $ex) {
                    $Responce = [
                        'Status_code' => '403',
                        'Success' => 'False',
                        'Message' => 'Exceoption Occure',
                        'Error' => $ex->getMessage(),
                    ];
                    $this->_sendResponse(401, $Responce);
                }

                break;
            default:
                break;
        }

        $Responce = [
            'Status_code' => '401',
            'Success' => 'False',
            'Message' => 'Authentication Fail!',
            'Error' => 'Unknown Error.',
        ];
        $this->_sendResponse(401, $Responce);
    }

    /**
     * Gets the message for a status code
     * 
     * @param mixed $status 
     * @access private
     * @return string
     */
    private function _getStatusCodeMessage($status) {
// these could be stored in a .ini file and loaded
// via parse_ini_file()... however, this will suffice
// for an example
        $codes = Array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported'
        );

        return (isset($codes[$status])) ? $codes[$status] : '';
    }

}
