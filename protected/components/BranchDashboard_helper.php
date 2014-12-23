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
class BranchDashboard_helper {

    //put your code here



    public static function getTotalFeedBackCountForBranches($from_Date, $to_Date, $Branch_Id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT COUNT(`option_value`) AS Total_Feedback FROM "
                    . "`responce_master` WHERE `question_id` in (SELECT `id` FROM `question_master`"
                    . " WHERE `branch_id`= :branch_id )  AND DATE(`created_at`) BETWEEN DATE(:FROM_DATE)"
                    . " AND DATE(:TO_DATE)";

            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':branch_id', $Branch_Id, PDO::PARAM_INT);
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

    public static function getTotalFeedBackAverageForBranches($from_Date, $to_Date, $Branch_Id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT ROUND(AVG(`option_value`),2) AS Average_Ratting FROM "
                    . "`responce_master` WHERE `question_id` in (SELECT `id` FROM `question_master`"
                    . " WHERE `branch_id` = :branch_id ) AND DATE(`created_at`) BETWEEN DATE(:FROM_DATE)"
                    . " AND DATE(:TO_DATE)";

            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;
            $command->bindParam(':branch_id', $Branch_Id, PDO::PARAM_INT);
            $command->bindParam(':FROM_DATE', $from_Date, PDO::PARAM_INT);
            $command->bindParam(':TO_DATE', $to_Date, PDO::PARAM_INT);

//            $command->bindParam(':from_Date', $from_Date, PDO::PARAM_INT);
//            $command->bindParam(':to_Date', $to_Date, PDO::PARAM_INT);

            $command->execute();

            $reader = $command->query();

            foreach ($reader as $row) {
                if ($row['Average_Ratting'] == null) {
                    return 0;
                }
                return $row['Average_Ratting'];
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

    public static function getPositiveFeedbackForBranches($from_Date, $to_Date, $Branch_Id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT COUNT(`option_value`) AS Total_Positive_Feedback FROM "
                    . "`responce_master` WHERE `question_id` in (SELECT `id` FROM `question_master`"
                    . " WHERE `branch_id` = :branch_id )"
                    . " AND `option_value`>2 AND DATE(`created_at`) BETWEEN DATE(:FROM_DATE)"
                    . " AND DATE(:TO_DATE)";


            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;
            $command->bindParam(':branch_id', $Branch_Id, PDO::PARAM_INT);
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

    public static function getNegativeFeedbackForBranches($from_Date, $to_Date, $Branch_Id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT COUNT(`option_value`) AS Total_Negative_Feedback FROM "
                    . "`responce_master` WHERE `question_id` in (SELECT `id` FROM `question_master`"
                    . " WHERE `branch_id` = :branch_id )"
                    . " AND `option_value`<=2 AND DATE(`created_at`) BETWEEN DATE(:FROM_DATE)"
                    . " AND DATE(:TO_DATE)";


            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':branch_id', $Branch_Id, PDO::PARAM_INT);
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

    public static function getTotalCustomerForAllBranches($from_Date, $to_Date, $Branch_Id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT COUNT(DISTINCT `client_id`) AS Total_Customer FROM "
                    . "`responce_master` WHERE `question_id` in (SELECT `id` FROM `question_master`"
                    . " WHERE `branch_id`=:branch_id) "
                    . "AND DATE(`created_at`) BETWEEN :FROM_DATE AND :TO_DATE";

            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;

            $command->bindParam(':branch_id', $Branch_Id, PDO::PARAM_INT);
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

    public static function getTotalCustomerForBranches($Branch_Id) {
        try {
            $connection = Yii::app()->db;

            $sqlStatement = "SELECT COUNT(DISTINCT `client_id`) AS Total_Customer FROM "
                    . "`responce_master` WHERE `question_id` in (SELECT `id` FROM `question_master`"
                    . " WHERE `branch_id` = :branch_id) ";

            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;

            $command->bindParam(':branch_id', $Branch_Id, PDO::PARAM_INT);

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

    public static function getTotalMALECustomerForBranches($Branch_Id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT COUNT(`gender`) AS Total_Male_Customer FROM `client_master` WHERE "
                    . "`client_id` in (SELECT `client_id` FROM `responce_master` "
                    . "WHERE `question_id` in (SELECT `id` FROM `question_master` "
                    . "WHERE `branch_id` = :branch_id )) AND `gender`=1";

            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':branch_id', $Branch_Id, PDO::PARAM_INT);
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

    public static function getTotalFEMALECustomerForBranches($Branch_Id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT COUNT(`gender`) AS Total_Male_Customer FROM `client_master` WHERE "
                    . "`client_id` in (SELECT `client_id` FROM `responce_master` "
                    . "WHERE `question_id` in (SELECT `id` FROM `question_master` "
                    . "WHERE `branch_id` = :branch_id )) AND `gender`=0";

            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':branch_id', $Branch_Id, PDO::PARAM_INT);
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

    public static function getTotalNewCustomers($Branch_Id) {
        try {

            return BranchDashboard_helper::getTotalCustomerForBranches($Branch_Id) - BranchDashboard_helper::getTotalRepeateCustomers($Branch_Id);
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

    public static function getTotalRepeateCustomers($Branch_Id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "select COUNT(*) AS TotalReapet from (SELECT `client_id` FROM `responce_master`"
                    . " WHERE `question_id` in (SELECT `id` FROM `question_master` WHERE `branch_id` = :branch_id) "
                    . "GROUP BY `client_id` HAVING COUNT(`client_id`)>1) AS Repeate_Customer ";

            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':branch_id', $Branch_Id, PDO::PARAM_INT);
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

    public static function getAgeBoundsForCustomerForBranches($Branch_Id) {
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
                            (SELECT `id` FROM `question_master` WHERE `branch_id`=:branch_id )))
                            AS TBL GROUP BY ageband";

            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':branch_id', $Branch_Id, PDO::PARAM_INT);

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

    public static function getYearlyReportForBranch($Branch_Id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT  YEAR(`created_at`) AS Year,COUNT(`created_at`) As Total_Visits "
                    . "FROM `responce_master` WHERE  `question_id` in (SELECT "
                    . "`id` FROM `question_master` WHERE `branch_id` = :branch_id )"
                    . " GROUP BY YEAR(`created_at`)";

            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':branch_id', $Branch_Id, PDO::PARAM_INT);
            $command->execute();

            $reader = $command->query();


            foreach ($reader as $row) {
                echo '<tr>
                            <td>
                            ' . $row['Year'] . '
                            </td>
                            <td>
                            ' . $row['Total_Visits'] . '
                            </td>
                        </tr>';
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

    public static function getMonthlyReportForBranch($Branch_Id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT  MONTHNAME(`created_at`) AS Month,COUNT(`created_at`)
                Total_Customer_Visit FROM `responce_master` WHERE YEAR(`created_at`)=YEAR(now())
                GROUP BY MONTH(`created_at`)";

            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':branch_id', $Branch_Id, PDO::PARAM_INT);
            $command->execute();

            $reader = $command->query();


            foreach ($reader as $row) {
                echo '<tr>
                            <td>
                            ' . $row['Month'] . '
                            </td>
                            <td>
                            ' . $row['Total_Customer_Visit'] . '
                            </td>
                        </tr>';
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

    public static function getWeeklyReportForBranch($Branch_Id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "SELECT  Week(`created_at`) AS Week,COUNT(`created_at`)
                Total_Customer_Visit FROM `responce_master` WHERE MONTH(`created_at`)=MONTH(now()) 
                GROUP BY Week(`created_at`)";

            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':branch_id', $Branch_Id, PDO::PARAM_INT);
            $command->execute();

            $reader = $command->query();


            foreach ($reader as $row) {
                echo '<tr>
                            <td>
                            ' . $row['Week'] . '
                            </td>
                            <td>
                            ' . $row['Total_Customer_Visit'] . '
                            </td>
                        </tr>';
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

    public static function getCategoryWiseReportForBranch($Branch_Id) {
        try {


            $connection = Yii::app()->db;

            $sqlStatement = "select category_name,Totoal_Visit from (SELECT "
                    . "category_id,COUNT(*) AS Totoal_Visit FROM "
                    . "`responce_master` INNER JOIN (SELECT id, `category_id` "
                    . "FROM `question_master` WHERE  `category_id` IN (SELECT `id` "
                    . "FROM `category_master` WHERE `lob_id` IN (SELECT `lob` FROM `profiles` "
                    . "WHERE `user_id`=:customer_id))) AS Categories on responce_master. `question_id` = Categories.id "
                    . "GROUP BY category_id) AS Category_Data INNER JOIN `category_master` "
                    . "ON Category_Data.category_id=category_master.id";

            $command = $connection->createCommand($sqlStatement);

            $customer_id = Yii::app()->user->id;
            $command->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);

            $reader = $command->query();


            foreach ($reader as $row) {
                echo '<tr>
                            <td>
                            ' . $row['category_name'] . '
                            </td>
                            <td>
                            ' . $row['Totoal_Visit'] . '
                            </td>
                        </tr>';
            }
        } catch (Exception $ex) {
            return "error, " . $ex->getMessage();
        }

        return 0;
    }

}
