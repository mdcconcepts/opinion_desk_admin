<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MessageHelper
 *
 * @author mdcconcepts
 */
class MessageHelper {

    //put your code here

    public static function getUnreadMessageCount() {
        $model = MessageMaster::model()->findAll(array(
            'condition' => '(message_to = :message_to OR is_broadcast = :is_broadcast) AND read_status= :read_status',
            'params' => array(':message_to' => Yii::app()->user->id, ':is_broadcast' => 1, ':read_status' => 0)
        ));
        return $count = count($model);
    }

    public static function getLatestMessage() {
        try {
            $connection = Yii::app()->db;

            $sqlStatement = "SELECT * FROM `message_master` WHERE `message_to`=:customer_id "
                    . "OR `is_broadcast`=1 ORDER BY `schedule_timestamp` DESC LIMIT 0 , 1";

            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;
            /**
             * Parameter For Query
             */
            $command->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            foreach ($reader as $row) {
                return $row;
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

}
