<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TabletUpdateTokenHelper
 *
 * @author mdcconcepts
 */
class TabletUpdateTokenHelper {

    //put your code here


    public static function updateTableToken($tablet_id) {
        try {


            $token = TabletUpdateTokenHelper::generate_random_password();

            echo $query = "UPDATE `tablet_master` SET `update_token`='$token',`update_at`='" . date('Y-m-d H:i:s') . "' WHERE `id`=$tablet_id";

            $connection = Yii::app()->db;

            $command = $connection->createCommand($query);

            $command->execute();

            /**
             * Parameter For Query
             */
//            $command->bindParam(':tablet_id', $tablet_id, PDO::PARAM_INT);
//            $command->bindParam(':Token', $token, PDO::PARAM_INT);
//            $command->bindParam(':update_at', date('Y-m-d H:i:s'), PDO::PARAM_INT);
        } catch (Exception $ex) {
            echo "error, " . $ex->getMessage();
        }
    }

    public static function updateForQuestions($branch_id) {
        try {


            $token = TabletUpdateTokenHelper::generate_random_password();

            $query = "UPDATE `tablet_master` SET `update_token`='$token',"
                    . "`update_at`='" . date('Y-m-d H:i:s') . "' WHERE `branch_id`= $branch_id";

            $connection = Yii::app()->db;

            $command = $connection->createCommand($query);

            $command->execute();

            /**
             * Parameter For Query
             */
//            $command->bindParam(':tablet_id', $tablet_id, PDO::PARAM_INT);
//            $command->bindParam(':Token', $token, PDO::PARAM_INT);
//            $command->bindParam(':update_at', date('Y-m-d H:i:s'), PDO::PARAM_INT);
        } catch (Exception $ex) {
            echo "error, " . $ex->getMessage();
        }
    }

//    public static function updateForQuestions($branch_id) {
//        try {
//
//
//            $token = TabletUpdateTokenHelper::generate_random_password();
//
//            $query = "UPDATE `tablet_master` SET `update_token`='$token',"
//                    . "`update_at`='" . date('Y-m-d H:i:s') . "' WHERE `branch_id`= $branch_id";
//
//            $connection = Yii::app()->db;
//
//            $command = $connection->createCommand($query);
//
//            $command->execute();
//
//            /**
//             * Parameter For Query
//             */
////            $command->bindParam(':tablet_id', $tablet_id, PDO::PARAM_INT);
////            $command->bindParam(':Token', $token, PDO::PARAM_INT);
////            $command->bindParam(':update_at', date('Y-m-d H:i:s'), PDO::PARAM_INT);
//        } catch (Exception $ex) {
//            echo "error, " . $ex->getMessage();
//        }
//    }

    public static function updateForCustomFields() {
        try {


            $token = TabletUpdateTokenHelper::generate_random_password();

            $customer_id = Yii::app()->user->id;

            echo $query = "UPDATE `tablet_master` SET `update_token`='$token',"
            . "`update_at`='" . date('Y-m-d H:i:s') . "' WHERE `branch_id`"
            . " in (SELECT `id` FROM `branch_master` WHERE `customer_id`=$customer_id)";

            $connection = Yii::app()->db;

            $command = $connection->createCommand($query);

            $command->execute();
            Yii::app()->end();
            /**
             * Parameter For Query
             */
//            $command->bindParam(':tablet_id', $tablet_id, PDO::PARAM_INT);
//            $command->bindParam(':Token', $token, PDO::PARAM_INT);
//            $command->bindParam(':update_at', date('Y-m-d H:i:s'), PDO::PARAM_INT);
        } catch (Exception $ex) {
            echo "error, " . $ex->getMessage();
        }
    }

    public static function generate_random_password($length = 10) {
        $alphabets = range('A', 'Z');
        $numbers = range('0', '9');
        $final_array = array_merge($alphabets, $numbers);

        $password = '';

        while ($length--) {
            $key = array_rand($final_array);
            $password .= $final_array[$key];
        }

        return $password;
    }

}
