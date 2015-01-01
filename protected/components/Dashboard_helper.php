<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Dashboard_helper is used for providing support for Dashboard report functionality
 *
 * @author mdcconcepts
 */
class Dashboard_helper {

    //put your code here



    public static function getTotalFeedBackCountForAllBranches($from_Date, $to_Date) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT COUNT(*) AS Total_Feedback FROM `responce_master` WHERE "
                    . "`question_id` in (SELECT `id` FROM `question_master` "
                    . "WHERE `branch_id` in (SELECT `id` FROM `branch_master` WHERE"
                    . " `customer_id`=:customer_id)) AND DATE(`created_at`) BETWEEN DATE(:FROM_DATE)"
                    . " AND DATE(:TO_DATE)";

            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;
            /**
             * Parameter For Query
             */
            $command->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
            $command->bindParam(':FROM_DATE', $from_Date, PDO::PARAM_INT);
            $command->bindParam(':TO_DATE', $to_Date, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            foreach ($reader as $row) {
                return $row['Total_Feedback'];
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

    public static function getTotalFeedBackAverageForAllBranches($from_Date, $to_Date) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT ROUND(AVG(`option_value`),2) AS Average_Ratting FROM "
                    . "`responce_master` WHERE `question_id` in (SELECT `id` FROM `question_master`"
                    . " WHERE `branch_id` in (SELECT `id` FROM `branch_master` WHERE `customer_id`=:customer_id))"
                    . " AND DATE(`created_at`) BETWEEN :from_Date AND :to_Date ";

            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;
            $command->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
            $command->bindParam(':from_Date', $from_Date, PDO::PARAM_INT);
            $command->bindParam(':to_Date', $to_Date, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            foreach ($reader as $row) {
                if ($row['Average_Ratting'] == null)
                    return 0;
                return $row['Average_Ratting'];
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

    public static function getPositiveFeedbackForAllBranches($from_Date, $to_Date) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT COUNT(`option_value`) AS Total_Positive_Feedback FROM "
                    . "`responce_master` WHERE `question_id` in (SELECT `id` FROM `question_master`"
                    . " WHERE `branch_id` in (SELECT `id` FROM `branch_master` WHERE `customer_id`=:customer_id))"
                    . " AND `option_value`>2 AND DATE(`created_at`) BETWEEN :FROM_DATE AND :TO_DATE";


            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;
            $command->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
            $command->bindParam(':FROM_DATE', $from_Date, PDO::PARAM_INT);
            $command->bindParam(':TO_DATE', $to_Date, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            foreach ($reader as $row) {
                return $row['Total_Positive_Feedback'];
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

    public static function getNegativeFeedbackForAllBranches($from_Date, $to_Date) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT COUNT(`option_value`) AS Total_Negative_Feedback FROM "
                    . "`responce_master` WHERE `question_id` in (SELECT `id` FROM `question_master`"
                    . " WHERE `branch_id` in (SELECT `id` FROM `branch_master` WHERE `customer_id`=:customer_id))"
                    . " AND `option_value`<=2 AND DATE(`created_at`) BETWEEN :FROM_DATE AND :TO_DATE";


            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;
            $command->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
            $command->bindParam(':FROM_DATE', $from_Date, PDO::PARAM_INT);
            $command->bindParam(':TO_DATE', $to_Date, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            foreach ($reader as $row) {
                return $row['Total_Negative_Feedback'];
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

    public static function getTotalCustomerForAllBranches() {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT COUNT(DISTINCT `client_id`) AS Total_Customer FROM "
                    . "`responce_master` WHERE `question_id` in (SELECT `id` FROM `question_master`"
                    . " WHERE `branch_id` in (SELECT `id` FROM `branch_master` WHERE `customer_id`=:customer_id))";

            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;

            $command->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            foreach ($reader as $row) {
                return $row['Total_Customer'];
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

    public static function getTodaysTotalCustomerForAllBranches($from_Date, $to_Date) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT COUNT(DISTINCT `client_id`) AS Total_Customer FROM "
                    . "`responce_master` WHERE `question_id` in (SELECT `id` FROM `question_master`"
                    . " WHERE `branch_id` in (SELECT `id` FROM `branch_master` WHERE `customer_id`=:customer_id)) "
                    . " AND DATE(`created_at`) BETWEEN :FROM_DATE AND :TO_DATE";

            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;

            $command->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);

            $command->bindParam(':FROM_DATE', $from_Date, PDO::PARAM_INT);

            $command->bindParam(':TO_DATE', $to_Date, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            foreach ($reader as $row) {
                return $row['Total_Customer'];
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

    public static function getTotalMALECustomerForAllBranches() {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT COUNT(`gender`) AS Total_Male_Customer FROM `client_master` WHERE "
                    . "`client_id` in (SELECT `client_id` FROM `responce_master` "
                    . "WHERE `question_id` in (SELECT `id` FROM `question_master` "
                    . "WHERE `branch_id` in (SELECT `id` FROM `branch_master` WHERE "
                    . "`customer_id`=:customer_id))) AND `gender`=1";

            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;
            $command->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            foreach ($reader as $row) {
                return $row['Total_Male_Customer'];
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

    public static function getTotalFEMALECustomerForAllBranches() {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT COUNT(`gender`) AS Total_Male_Customer FROM `client_master` WHERE "
                    . "`client_id` in (SELECT `client_id` FROM `responce_master` "
                    . "WHERE `question_id` in (SELECT `id` FROM `question_master` "
                    . "WHERE `branch_id` in (SELECT `id` FROM `branch_master` WHERE "
                    . "`customer_id`=:customer_id))) AND `gender`=0";

            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;
            $command->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            foreach ($reader as $row) {
                return $row['Total_Male_Customer'];
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

    public static function getTotalNewCustomersForALLBranches() {
        try {

            return Dashboard_helper::getTotalCustomerForAllBranches() - Dashboard_helper::getTotalRepeateCustomersForALLBranches();
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

    public static function getTotalRepeateCustomersForALLBranches() {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "select COUNT(*) AS TotalReapet from (SELECT `client_id` FROM `responce_master`"
                    . " WHERE `question_id` in (SELECT `id` FROM `question_master` WHERE `branch_id`  in (SELECT `id` FROM `branch_master` WHERE "
                    . "`customer_id`=:customer_id)) "
                    . "GROUP BY `client_id` HAVING COUNT(`client_id`)>1) AS Repeate_Customer ";

            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;
            $command->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
            $command->execute();

            $reader = $command->query();

            foreach ($reader as $row) {
                return $row['TotalReapet'];
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

    public static function getAgeBoundsForCustomerForAllBranches($from_Date, $to_Date) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT
                              CASE
                             WHEN age >= 0 AND age <= 18 THEN '0-18'
                              WHEN age >= 18 AND age <= 24 THEN '18-24'
                              WHEN age >=24 THEN '24+'
                            END AS ageband,
                            COUNT(*) As Total_customers
                            FROM (
                            SELECT DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(`dob`, '%Y') - 
                            (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(`dob`, '00-%m-%d')) 
                            AS age FROM `client_master` WHERE `client_id` IN 
                            (SELECT `client_id` FROM `responce_master` WHERE `question_id` in 
                            (SELECT `id` FROM `question_master` WHERE `branch_id` in 
                            (SELECT `id` FROM `branch_master` WHERE `customer_id`=:customer_id))))
                            AS TBL GROUP BY ageband";

            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;
            $command->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            foreach ($reader as $row) {
                ?>

                <td class="fa-border"><button class="btn btn-danger padd-adj" type="button"><?php echo $row['Total_customers']; ?></button>
                    <?php echo $row['ageband'] ?></td>
                <?php
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

    public static function getWeeklyReportForBranch() {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT Week(`created_at`) AS Week,COUNT(`created_at`)
                Total_Customer_Visit FROM `responce_master` WHERE MONTH(`created_at`)=MONTH(now()) 
                AND `question_id` in (SELECT `id` FROM `question_master` WHERE `branch_id` in
                (SELECT `id` FROM `branch_master` WHERE `customer_id`=:customer_id))
                GROUP BY Week(`created_at`)";

            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;
            $command->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
            $command->execute();

            $reader = $command->query();


            foreach ($reader as $row) {
                ?>
                <div class="bar">
                    <div class="value tooltips" data-original-title="30%" data-toggle="tooltip" data-placement="top"><?php echo $row['Total_Customer_Visit'] * 50; ?></div>
                    <div class="title"><?php echo $row['Week']; ?></div>
                </div><!--/bar-->
                <?php
//                echo '<tr>
//                            <td>
//                            ' . $row['Week'] . '
//                            </td>
//                            <td>
//                            ' . $row['Total_Customer_Visit'] . '
//                            </td>
//                        </tr>';
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

}
