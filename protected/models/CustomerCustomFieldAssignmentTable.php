<?php

/**
 * This is the model class for table "customer_custom_field_assignment_table".
 *
 * The followings are the available columns in table 'customer_custom_field_assignment_table':
 * @property integer $id
 * @property integer $customer_custom_field_id
 * @property integer $branch_id
 */
class CustomerCustomFieldAssignmentTable extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'customer_custom_field_assignment_table';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('customer_custom_field_id, branch_id', 'required'),
            array('customer_custom_field_id, branch_id', 'numerical', 'integerOnly' => true),
            /*
              //Example username
              array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
              'message'=>'Username can contain only alphanumeric
              characters and hyphens(-).'),
              array('username','unique'),
             */
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, customer_custom_field_id, branch_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Customer_Custom_Fields_Val' => array(self::BELONGS_TO, 'CustomerCustomField', 'customer_custom_field_id'),
            'sub_data_field' => array(self::HAS_MANY, 'SubCustomerCustomFieldAssignment', 'customer_custom_field_assignment_id'),
            'Customer_Custom_Fields' => array(self::HAS_MANY, 'CustomerCustomFieldData', 'customer_custom_field_assignment_id'),
            'CustomerCustomFieldAssignmentTable' => array(self::HAS_ONE, 'BranchMaster', 'branch_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'customer_custom_field_id' => 'Customer Custom Field',
            'branch_id' => 'branch',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('customer_custom_field_id', $this->customer_custom_field_id);
        $criteria->compare('user_id', $this->branch_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CustomerCustomFieldAssignmentTable the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        $userId = 0;
        if (null != Yii::app()->user->id)
            $userId = (int) Yii::app()->user->id;

        if ($this->isNewRecord) {
            
        } else {
            
        }

        try {

            $token = $this->generate_random_password();

            $customer_id = Yii::app()->user->id;

            $query = "UPDATE `tablet_master` SET `update_token`='$token',"
                    . "`update_at`='" . date('Y-m-d H:i:s') . "' WHERE `branch_id`"
                    . " in (SELECT `id` FROM `branch_master` WHERE `customer_id`=$customer_id)";

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

        return parent::beforeSave();
    }

    public function generate_random_password($length = 10) {
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

//    public function beforeDelete() {
//        $userId = 0;
//        if (null != Yii::app()->user->id)
//            $userId = (int) Yii::app()->user->id;
//
//        return false;
//    }

    public function afterFind() {

        parent::afterFind();
    }

    public function defaultScope() {
        /*
          //Example Scope
          return array(
          'condition'=>"deleted IS NULL ",
          'order'=>'create_time DESC',
          'limit'=>5,
          );
         */
        $scope = array();


        return $scope;
    }

    public function getDataFromPK($pId) {
        $criteria = new CDbCriteria;
        $criteria->condition = "branch_id=" . $pId;
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
