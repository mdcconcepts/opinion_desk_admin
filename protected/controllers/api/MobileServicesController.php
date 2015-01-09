<?php

class MobileServicesController extends Controller {

    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers 
     */
    Const APPLICATION_ID = 'OPINION_DESK';

    private $format = 'json';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + Auth', // we only allow deletion via POST request
            'postOnly + LogOut', // we only allow deletion via POST request
            'postOnly + getAllDynamicData', // we only allow deletion via POST request
            'postOnly + postResponceData', // we only allow deletion via POST request
        );
    }

    private function uploadAudio() {
        if (!isset($_FILES['audio_post'])) {
            return false;
        }
        try {
            $target = "upload/testimonials/audio/";

            $target = $target . basename($_FILES['audio_post']['name']);

            if (move_uploaded_file($_FILES['audio_post']['tmp_name'], $target)) {
                return $target;
            } else {
                return false;
            }
        } catch (Exception $e) {

            return false;
        }
    }

    public function actionSyncAudio() {
        $Tablet = $this->_checkAuth();

        if ($this->isLogin($Tablet->id)) {
            $Responce = [
                'Status_code' => '401',
                'Success' => 'False',
                'Message' => 'Authentication Fail!',
                'Error' => 'Already login into another device! Please contact Administrator.',
            ];
            $this->_sendResponse(401, $Responce);
        }
        if (!isset($_FILES['audio_post'])) {
            $Responce = [
                'Status_code' => '403',
                'Success' => 'False',
                'Message' => 'Bad Request Parameters',
                'Error' => 'Audio File not found.'
            ];
            $this->_sendResponse(403, $Responce);
        }
        try {
            $target = "upload/testimonials/audio/";

            $target = $target . basename($_FILES['audio_post']['name']);

            if (move_uploaded_file($_FILES['audio_post']['tmp_name'], $target)) {
                $Responce = [
                    'Status_code' => '200',
                    'Success' => 'True',
                    'Message' => 'Audio Uploaded Successfully',
                    'Responce_Url' => $target,
                    'test_post' => $_SERVER['HTTP_API_' . self:: APPLICATION_ID . '_TEST']
                ];
                $this->_sendResponse(200, $Responce);
            } else {
                $Responce = [
                    'Status_code' => '403',
                    'Success' => 'False',
                    'Message' => 'Error Occure in Audio Upload',
                ];
                $this->_sendResponse(403, $Responce);
            }
        } catch (Exception $e) {

            $Responce = [
                'Status_code' => '403',
                'Success' => 'False',
                'Message' => 'Error Occure while uploading audio !',
                'Error' => $e->getMessage()
            ];
            $this->_sendResponse(403, $Responce);
            //$this->refresh();
        }
        $Responce = [
            'Status_code' => '403',
            'Success' => 'False',
            'Message' => 'Upload Fail !',
            'Error' => 'Unknown Error.',
        ];
        $this->_sendResponse(200, $Responce);
    }

    /**
     * This method is used for authenticating user
     */
    public function actionAuth() {
        $Tablet = $this->_checkAuth();

        if ($this->isLogin($Tablet->id)) {
            $Responce = [
                'Status_code' => '401',
                'Success' => 'False',
                'Message' => 'Authentication Fail!',
                'Error' => 'Already login into another device! Please contact Administrator.',
            ];
            $this->_sendResponse(401, $Responce);
        }

        if ($Tablet->joining_date == null) {
            $Tablet->joining_date = date('Y-m-d H:i:s');
        }
        $transaction = Yii::app()->db->beginTransaction();
        try {
//            $Tablet->is_login = 1;


            $this->begin_session($Tablet->id);
            $transaction->commit();
            $Responce = [
                'Status_code' => '200',
                'Success' => 'True',
                'Message' => 'Authentication is successful !',
                'Tablet' => [
                    'tablet_id' => $Tablet->id,
                    'first_name' => $Tablet->first_name_user,
                    'last_name' => $Tablet->last_name_user,
                    'joining_date' => date(' jS F Y', strtotime($Tablet->joining_date)),
                    'app_theme_color' => $this->getThemeColorForTablet($Tablet->branch_id),
                    'app_logo' => $this->getThemeLogoForTablet($Tablet->branch_id),
                    'terms_and_conditions' => $this->getTerms_ConditionsForTablet($Tablet->branch_id)
                ]
            ];
            $this->_sendResponse(200, $Responce);
        } catch (Exception $e) {
            $transaction->rollBack();

            $Responce = [
                'Status_code' => '401',
                'Success' => 'False',
                'Message' => 'Authentication Fail!',
                'Error' => $e->getMessage()
            ];
            $this->_sendResponse(401, $Responce);
//$this->refresh();
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
     * This method is used for authenticating user
     */
    public function actionCheckClientMobile() {
        $Tablet = $this->_checkAuth();

        if (!$this->isLogin($Tablet->id)) {
            $Responce = [
                'Status_code' => '503',
                'Success' => 'False',
                'Message' => 'Request Fail!',
                'Error' => 'Device is logged out!',
            ];
            $this->_sendResponse(401, $Responce);
        }


        $Post_Mobile = Yii::app()->request->getPost('Mobile_No');

        $Client = ClientMaster::model()->findAll(array(
            'condition' => 'mobile_no = :mobile_no',
            'params' => array(':mobile_no' => $Post_Mobile)
        ));

        if ($Client[0] === null) {
// Error: Unauthorized
            $Responce = [
                'Status_code' => '200',
                'Success' => 'Success',
                'Message' => 'Customer of this number not found !',
            ];
            $this->_sendResponse(200, $Responce);
        }

        $Responce = [
            'Status_code' => '200',
            'Success' => 'False',
            'Message' => 'Customer found !',
            'client_id' => $Client[0]->client_id,
        ];
        $this->_sendResponse(200, $Responce);
    }

    private function getThemeColorForTablet($branch_id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT `theme_color` FROM `profiles` WHERE `user_id`"
                    . " in (SELECT `customer_id` FROM `branch_master` WHERE `id`=:branch_id)";

            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':branch_id', $branch_id, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            foreach ($reader as $row) {
                return $row['theme_color'];
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }
    }

    private function getThemeLogoForTablet($branch_id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT `organisation_logo` FROM `profiles` WHERE `user_id`"
                    . " in (SELECT `customer_id` FROM `branch_master` WHERE `id`=:branch_id)";

            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':branch_id', $branch_id, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            foreach ($reader as $row) {
                return $row['organisation_logo'];
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }
    }

    private function getTerms_ConditionsForTablet($branch_id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT `terms_and_conditions` FROM `profiles` WHERE `user_id`"
                    . " in (SELECT `customer_id` FROM `branch_master` WHERE `id`=:branch_id)";

            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':branch_id', $branch_id, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            foreach ($reader as $row) {
                return $row['terms_and_conditions'];
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }
    }

    /**
     * This method is used for logging out user.
     */
    public function actionLogOut() {
        $Tablet = $this->_checkAuth();

        if (!$this->isLogin($Tablet->id)) {
            $Responce = [
                'Status_code' => '401',
                'Success' => 'False',
                'Message' => 'Logout Request Fail!',
                'Error' => 'Device is already logged out!',
            ];
            $this->_sendResponse(401, $Responce);
        }

        $transaction = Yii::app()->db->beginTransaction();
        try {
//            $Tablet->is_login = 0;
            $this->destroy_session($Tablet->id);
            $transaction->commit();
            $Responce = [
                'Status_code' => '200',
                'Success' => 'True',
                'Message' => 'Logout Request is successful!',
            ];
            $this->_sendResponse(200, $Responce);
        } catch (Exception $e) {
            $transaction->rollBack();

            $Responce = [
                'Status_code' => '401',
                'Success' => 'False',
                'Message' => 'Authentication Fail!',
                'Error' => $e->getMessage()
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
     * This method is used for getting all dynamic data
     */
    public function actiongetAllDynamicData() {
        $Tablet = $this->_checkAuth();

        if (!$this->isLogin($Tablet->id)) {
            $Responce = [
                'Status_code' => '503',
                'Success' => 'False',
                'Message' => 'Request Fail!',
                'Error' => 'Device is logged out!',
            ];
            $this->_sendResponse(401, $Responce);
        }

        $Post_Token = Yii::app()->request->getPost('Token');

        if ($Post_Token == $Tablet->update_token) {
            $Responce = [
                'Status_code' => '200',
                'Success' => 'True',
                'Message' => 'Already up to date, no need to update',
            ];
            $this->_sendResponse(401, $Responce);
        }

//        $Customer_Id = BranchMaster::model()->findAllByPk($Tablet->branch_id)[0]->customer_id;

        $Responce = [
            'Status_code' => '200',
            'Success' => 'True',
            'Message' => 'Requested Data available !',
            'Custom_Fields ' => $this->getCustomFields($Tablet->branch_id),
            'Feedback_Questions ' => $this->getFeedbackQuestions($Tablet->branch_id),
            'update_token' => $Tablet->update_token
        ];
        $this->_sendResponse(200, $Responce);
    }

    /**
     * This function is used to retern feedback questions according to the branch request
     * @param type $branch_id
     * @return array it returns data of feedback questions
     */
    private function getFeedbackQuestions($branch_id) {
        $connection = Yii::app()->db;


        $sqlStatement = "SELECT *,question_master.id AS question_id_i FROM `question_master` INNER JOIN `category_master` ON  "
                . "`question_master`.`category_id`=`category_master`.id "
                . "WHERE `branch_id`=:branch_id";

        $command = $connection->createCommand($sqlStatement);

        $command->bindParam(':branch_id', $branch_id, PDO::PARAM_INT);
        $command->execute();

        $Questions = $command->query();
        $Feedback_Questions = array();
        foreach ($Questions as $question) {
            $Feedback_Question = array();
            $Feedback_Question['question_id'] = $question['question_id_i'];
            $Feedback_Question['option_type_id'] = $question['option_type_id'];
            $Feedback_Question['question'] = $question['question'];


            $Feedback_Question['category_id'] = $question['category_id'];
            $Feedback_Question['category_name'] = $question['category_name'];

            array_push($Feedback_Questions, $Feedback_Question);
        }
        return $Feedback_Questions;
    }

    /**
     * This function is used for getting custom fields for client according to customer_id (User_id)
     * @param type $Branch_Id
     * @return array returns custom fields for clients
     */
    private function getCustomFields($Branch_Id) {
        $connection = Yii::app()->db;

        $sqlStatement = "SELECT `customer_custom_field_assignment_table`.id,"
                . "`field_name`,`field_maxsize`,`is_reference_field`,`field_category` "
                . "FROM `customer_custom_field_assignment_table` "
                . "INNER JOIN `customer_custom_field` ON  "
                . "`customer_custom_field_assignment_table`.`customer_custom_field_id`= "
                . "`customer_custom_field`.`id` INNER JOIN `field_category_table` ON "
                . "`customer_custom_field`.field_category_id=`field_category_table`.id WHERE "
                . "`branch_id`=:branch_id";

        $command = $connection->createCommand($sqlStatement);

        $command->bindParam(':branch_id', $Branch_Id, PDO::PARAM_INT);
        $command->execute();

        $reader = $command->query();
        $Custom_Fields = array();
        foreach ($reader as $row) {
            $Field = array();

            $Field['customer_custom_field_assignment_id'] = $row['id'];
            $Field['field_name'] = $row['field_name'];
            $Field['field_category'] = $row['field_category'];
            $Field['field_maxsize'] = $row['field_maxsize'];
            $Field['is_reference_field'] = $row['is_reference_field'];

            array_push($Custom_Fields, $Field);
        }

        return $Custom_Fields;
    }

    public function actionpostResponseNewClientData() {

        $Tablet = $this->_checkAuth();

        $Post = $_SERVER['HTTP_API_' . self:: APPLICATION_ID . '_RESPONSE'];

        if (!isset($Post))
            $Post = Yii::app()->getRequest()->getRawBody();

        $Post_Feedback_Id = CJSON::decode($Post)['feedbackID'];

        $Post_Client = CJSON::decode($Post)['Client'];

        $Post_Questions = CJSON::decode($Post)['Questions'];

        $Post_Testimonial = CJSON::decode($Post)['Testimonial'];

        $this->validateBasicClientPostResponce($Post_Client);

        $Post_Custom_Fields_Client = $Post_Client['Custom_Fields'];


        $Client = new ClientMaster;


        $transaction = Yii::app()->db->beginTransaction();
        try {
            $Client->name = $Post_Client['name'];
            $Client->mobile_no = $Post_Client['mobile_no'];
            $Client->email = $Post_Client['email'];
            $Client->gender = $Post_Client['gender'];
            $Client->dob = $Post_Client['dob'];
            if ($Client->save()) {

                $this->saveCustomFieldData($Client->getPrimaryKey(), $Post_Custom_Fields_Client);

                $this->saveQuestionResponceData($Client->getPrimaryKey(), $Post_Questions);

                if (isset($Post_Testimonial))
                    $this->saveTestimonialResponceData($Client->getPrimaryKey(), $Post_Testimonial, $Tablet->branch_id);


                $this->generateNotification($Tablet->id, $Tablet->branch_id, 'http://opiniondesk.in/account/index.php');

                $transaction->commit();

                $Responce = [
                    'Status_code' => '200',
                    'Success' => 'True',
                    'Message' => 'Client Response Saved !',
                    'feedbackID' => $Post_Feedback_Id
                ];

                $this->_sendResponse(200, $Responce);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            $Responce = [
                'Status_code' => $e->getCode(),
                'Success' => 'False',
                'Message' => 'Exception On Save',
                'Error' => $e->getMessage()
            ];
            $this->_sendResponse(404, $Responce);
        }
        $Responce = [
            'Status_code' => '400',
            'Success' => 'False',
            'Message' => $Client->getErrors(),
        ];
        $this->_sendResponse(400, $Responce);
    }

    private function generateNotification($tablet_id, $branch_id, $redirect_url) {

        $Notification = new NotificationMaster();


        $customer_id = BranchMaster::model()->findAll(array(
                    'condition' => 'id = :branch_id',
                    'params' => array(':branch_id' => $branch_id)
                ))[0]->customer_id;

        $Notification->notification_type_id = 4;
        $Notification->tablet_id = $tablet_id;
        $Notification->customer_id = $customer_id;
        $Notification->redirect_url = $redirect_url;
        $Notification->read_status = 0;
        $Notification->created_at = date('Y-m-d H:i:s');
        if (!$Notification->save()) {
            throw new Exception(json_encode($Notification->getErrors()));
        }
    }

    public function actionpostResponseExistingClientData() {

        $Tablet = $this->_checkAuth();


        $Post = $_SERVER['HTTP_API_' . self:: APPLICATION_ID . '_RESPONSE'];

        if (!isset($Post))
            $Post = Yii::app()->getRequest()->getRawBody();

        $Post_Feedback_Id = CJSON::decode($Post)['feedbackID'];

        $Post_Client_Id = CJSON::decode($Post)['Client_Id'];

        $Post_Questions = CJSON::decode($Post)['Questions'];

        $Post_Testimonial = CJSON::decode($Post)['Testimonial'];

        $Post_Custom_Fields_Client = $Post_Client['Custom_Fields'];


        $transaction = Yii::app()->db->beginTransaction();
        try {

            $this->saveCustomFieldData($Post_Client_Id, $Post_Custom_Fields_Client);

            $this->saveQuestionResponceData($Post_Client_Id, $Post_Questions);

            if (isset($Post_Testimonial))
                $this->saveTestimonialResponceData($Post_Client_Id, $Post_Testimonial, $Tablet->branch_id);

            $transaction->commit();

            $Responce = [
                'Status_code' => '200',
                'Success' => 'True',
                'Message' => 'Client Response Saved !',
                'feedbackID' => $Post_Feedback_Id
            ];

            $this->_sendResponse(200, $Responce);
        } catch (Exception $e) {
            $transaction->rollBack();
            $Responce = [
                'Status_code' => $e->getCode(),
                'Success' => 'Fail',
                'Message' => 'Exception On Save',
                'Error' => $e->getMessage()
            ];
            $this->_sendResponse(404, $Responce);
        }
        $Responce = [
            'Status_code' => '400',
            'Success' => 'Fail',
            'Message' => 'Unknown Responce',
        ];
        $this->_sendResponse(400, $Responce);
    }

    /**
     * This method is used for saving question responce in database.
     * @param type $client_id Client id of user just enter into the system.
     * @param type $Post_Questions This is Post Question Responce Array
     */
    private function saveQuestionResponceData($client_id, $Post_Questions) {
        if (count($Post_Questions) >= 1) {

            $isFirst = true;
            $query = "";
            for ($index = 0; $index < count($Post_Questions); $index++) {
                $this->validateBasicQuestionsPostResponce($Post_Questions[$index]);

                if ($isFirst) {
                    $query = "INSERT INTO `opinion_desk_db`.`responce_master` "
                            . "(`id`, `option_value`, `question_id`, `client_id`,`created_at`) "
                            . "VALUES (NULL, " . $Post_Questions[$index]['option_value'] . ", "
                            . "'" . $Post_Questions[$index]['question_id'] . "',"
                            . " '" . $client_id . "','" . date('Y-m-d H:i:s') . "')";
                    $isFirst = false;
                } else {
                    $query.=" , (NULL, " . $Post_Questions[$index]['option_value'] . ", "
                            . "'" . $Post_Questions[$index]['question_id'] . "',"
                            . " '" . $client_id . "','" . date('Y-m-d H:i:s') . "')";
                }
            }

            $connection = Yii::app()->db;

            $command = $connection->createCommand($query);

            $command->execute();
        }
    }

    /**
     * This method is used for saving question responce in database.
     * @param type $client_id Client id of user just enter into the system.
     * @param type $Post_Questions This is Post Question Responce Array
     */
    private function saveTestimonialResponceData($client_id, $Post_Testimonial, $branch_id) {

        if ($this->validateBasicTestimonialPostResponce($Post_Testimonial)) {

            $Audio_URL = "";
            if (isset($_FILES['audio_post'])) {
                $Audio_URL = $this->uploadAudio();
            }

            $query = "INSERT INTO `testimonial_response_table`(`id`, `responce_text`, "
                    . "`responce_audio_url`, `responce_vedio_url`,`branch_id`, `client_id`, `created_at`) VALUES "
                    . "(NULL, '" . $Post_Testimonial['responce_text'] . "', "
                    . "'" . $Audio_URL . "', "
                    . "'" . $Post_Testimonial['responce_vedio_url'] . "'," . $branch_id . ","
                    . " '" . $client_id . "','" . date('Y-m-d H:i:s') . "')";

            $connection = Yii::app()->db;

            $command = $connection->createCommand($query);

            $command->execute();
        }
    }

    /**
     * This mothod is used for saving custom fields
     * @param type $client_id client id using which we save data
     * @param type $Post_Custom_Fields_Client
     */
    private function saveCustomFieldData($client_id, $Post_Custom_Fields_Client) {
        if (count($Post_Custom_Fields_Client) >= 1) {

            $isFirst = true;
            $query = "";
            for ($index = 0; $index < count($Post_Custom_Fields_Client); $index++) {
                $this->validatePostCustomClientField($Post_Custom_Fields_Client[$index]);

                if ($isFirst) {
                    $query = "INSERT INTO `opinion_desk_db`.`customer_custom_field_data` "
                            . "(`id`, `customer_custom_field_assignment_id`, `client_id`, `value`) "
                            . "VALUES (NULL, " . $Post_Custom_Fields_Client[$index]['customer_custom_field_assignment_id'] . ","
                            . "" . $client_id . ", ' " . $Post_Custom_Fields_Client[$index]['value'] . "')";
                    $isFirst = false;
                } else {
                    $query.=" ,(NULL, " . $Post_Custom_Fields_Client[$index]['customer_custom_field_assignment_id'] . ","
                            . "" . $client_id . ", ' " . $Post_Custom_Fields_Client[$index]['value'] . "')";
                }
//            $Custom_Field_Data = new CustomerCustomFieldData;
//            echo $Post_Custom_Fields_Client[$index]['customer_custom_field_assignment_id'];
            }

            $connection = Yii::app()->db;

            $command = $connection->createCommand($query);

            $command->execute();
        }
    }

    /**
     * This funciton is used for validating request
     * @param type $Post_Client This is Client Post Parameter
     */
    private function validateBasicClientPostResponce($Post_Client) {

        if (!isset($Post_Client['name'])) {
            $Responce = [
                'Status_code' => '404',
                'Success' => 'Fail',
                'Message' => 'Bad Request Parameters',
                'Error' => 'Client Name not found.'
            ];
            $this->_sendResponse(404, $Responce);
        } elseif (!isset($Post_Client['mobile_no'])) {
            $Responce = [
                'Status_code' => '404',
                'Success' => 'Fail',
                'Message' => 'Bad Request Parameters',
                'Error' => 'Client Mobile Number not found.'
            ];
            $this->_sendResponse(404, $Responce);
        } elseif (!isset($Post_Client['email'])) {
            $Responce = [
                'Status_code' => '404',
                'Success' => 'Fail',
                'Message' => 'Bad Request Parameters',
                'Error' => 'Client Email not found.'
            ];
            $this->_sendResponse(404, $Responce);
        } elseif (!isset($Post_Client['gender'])) {
            $Responce = [
                'Status_code' => '404',
                'Success' => 'Fail',
                'Message' => 'Bad Request Parameters',
                'Error' => 'Client Gender not found.'
            ];
            $this->_sendResponse(404, $Responce);
        } elseif (!isset($Post_Client['dob'])) {
            $Responce = [
                'Status_code' => '404',
                'Success' => 'Fail',
                'Message' => 'Bad Request Parameters',
                'Error' => 'Client Date Of Birth not found.'
            ];
            $this->_sendResponse(404, $Responce);
        }
    }

    /**
     * This method is used for validating single question
     * @param type $Post_Question this is question parameter singlton object
     */
    private function validateBasicQuestionsPostResponce($Post_Question) {

        if (!isset($Post_Question['question_id'])) {
            $Responce = [
                'Status_code' => '404',
                'Success' => 'Fail',
                'Message' => 'Bad Request Parameters',
                'Error' => 'question_id not found.'
            ];
            $this->_sendResponse(404, $Responce);
        } elseif (!isset($Post_Question['option_value'])) {
            $Responce = [
                'Status_code' => '404',
                'Success' => 'Fail',
                'Message' => 'Bad Request Parameters',
                'Error' => 'option_value not found.'
            ];
            $this->_sendResponse(404, $Responce);
        }
    }

    /**
     * This method is used for validating single question
     * @param type $Post_Question this is question parameter singlton object
     */
    private function validateBasicTestimonialPostResponce($Post_Testimonial) {

        if (!isset($Post_Testimonial['responce_text']) && !isset($Post_Testimonial['responce_audio_url']) && !isset($Post_Testimonial['responce_vedio_url'])) {
            return false;
        }
        return true;
    }

    /**
     * This function is used for validating custom fields
     * @param type $Post_Custom_Field_Client This is custom Client Field Post
     */
    private function validatePostCustomClientField($Post_Custom_Field_Client) {
        if (!isset($Post_Custom_Field_Client['customer_custom_field_assignment_id'])) {
            $Responce = [
                'Status_code' => '404',
                'Success' => 'Fail',
                'Message' => 'Bad Request Parameters',
                'Error' => 'Client customer_custom_field_assignment_id not found.'
            ];
            $this->_sendResponse(404, $Responce);
        } elseif (!isset($Post_Custom_Field_Client['value'])) {
            $Responce = [
                'Status_code' => '404',
                'Success' => 'Fail',
                'Message' => 'Bad Request Parameters',
                'Error' => 'Client custom field value not found.'
            ];
            $this->_sendResponse(404, $Responce);
        }
    }

    function begin_session($tablet_id) {
        session_regenerate_id();
        $username = $_SERVER['HTTP_API_' . self:: APPLICATION_ID . '_USERNAME'];

        $password = $_SERVER['HTTP_API_' . self::APPLICATION_ID . '_PASSWORD'];
        $_SESSION['session_token'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'] . $username . $password);

        $Tablet_Session = new TabletSessionMaster();
        $Tablet_Session->tablet_id = $tablet_id;
        $Tablet_Session->session_token = $_SESSION['session_token'];
        $Tablet_Session->timeout = date('Y-m-d H:i:s');
        $Tablet_Session->save();

        return $_SESSION['session_token'];
    }

    function destroy_session($tablet_id) {
        $Session = TabletSessionMaster::model()->findAll(array(
                    'condition' => 'tablet_id = :tablet_id',
                    'params' => array(':tablet_id' => $tablet_id)
                ))[0];

        $Session->delete();
        $_SESSION['session_token'] = "Deleted";
        return $_SESSION['session_token'];
    }

    function isLogin($tablet_id) {
        session_start();
        $username = $_SERVER['HTTP_API_' . self:: APPLICATION_ID . '_USERNAME'];

        $password = $_SERVER['HTTP_API_' . self::APPLICATION_ID . '_PASSWORD'];
        $SESSION_TOKEN = TabletSessionMaster::model()->findAll(array(
                    'condition' => 'tablet_id = :tablet_id',
                    'params' => array(':tablet_id' => $tablet_id)
                ))[0]->session_token;
        if ($SESSION_TOKEN != md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'] . $username . $password)) {
            session_destroy();
            return false;
        }

        return true;
    }

    /**
     * Checks if a request is authorized
     * 
     * @access private
     * @return void
     */
    private function _checkAuth() {
        date_default_timezone_set("Asia/Kolkata");
        /**
         * This Header is used for getting data for authentication
         */
//        $headers = $_SERVER;
//
//        foreach ($headers as $header => $value) {
//            echo "$header: $value <br />\n";
//        }
//        echo json_encode($_SERVER);
//        Yii::app()->end();
// Check if we have the USERNAME and PASSWORD HTTP headers set?
        if (!(isset($_SERVER['HTTP_API_' . self::APPLICATION_ID . '_USERNAME']) and isset($_SERVER['HTTP_API_' . self::APPLICATION_ID . '_PASSWORD']))) {
// Error: Unauthorized
            $this->_sendResponse(403);
        }

        $username = $_SERVER['HTTP_API_' . self:: APPLICATION_ID . '_USERNAME'];

        $password = $_SERVER['HTTP_API_' . self::APPLICATION_ID . '_PASSWORD'];

// Find the user
        $Tablet_User = TabletMaster::model()->findAll(array(
            'condition' => 'username = :username',
            'params' => array(':username' => $username)
        ));

        if ($Tablet_User[0] === null) {
// Error: Unauthorized
            $Responce = [
                'Status_code' => '401',
                'Success' => 'False',
                'Message' => 'Authentication Fail !',
                'Error' => 'Username is invalid.'
            ];
            $this
                    ->_sendResponse(401, $Responce);
        } else if ($Tablet_User[0]->password != $password) {
// Error: Unauthorized

            $Responce = [
                'Status_code' => '401',
                'Success' => 'Fail',
                'Message' => 'Authentication Fail !',
                'Error' => 'Password is invalid.'
            ];
            $this->_sendResponse(401, $Responce);
        }

        return $Tablet_User[0];
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
