<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotificationHelper
 *
 * @author mdcconcepts
 */
class NotificationHelper {

    //put your code here

    public static function changeReadStatusOfNotification($branch_id) {
        try {

            $query = "UPDATE `notification_master` SET `read_status`=1"
                    . " WHERE `tablet_id` in (SELECT `id` FROM `tablet_master` WHERE `branch_id`=:branch_id)";

            $connection = Yii::app()->db;

            $command = $connection->createCommand($query);

            $command->bindParam(':branch_id', $branch_id, PDO::PARAM_INT);

            $command->execute();
        } catch (Exception $ex) {
            echo "error, " . $ex->getMessage();
        }
    }

}
