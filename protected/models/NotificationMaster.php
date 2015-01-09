<?php

/**
 * This is the model class for table "question_master".
 *
 * The followings are the available columns in table 'question_master':
 * @property integer $id
 * @property string $question
 * @property string $created_at
 * @property string $update_at
 * @property integer $branch_id
 */
class NotificationMaster extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'notification_master';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('notification_type_id,tablet_id, customer_id,redirect_url,read_status,created_at', 'required'),
            array('notification_type_id,tablet_id,customer_id', 'numerical', 'integerOnly' => true),
            array('redirect_url', 'length', 'max' => 500),
            /*
              //Example username
              array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
              'message'=>'Username can contain only alphanumeric
              characters and hyphens(-).'),
              array('username','unique'),
             */
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, redirect_url,notification_type_id, created_at, update_at, tablet_id, customer_id', 'safe', 'on' => 'search'),
            array('created_at', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'update')
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'NotificationType' => array(self::HAS_ONE, 'NotificationType', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'id',
            'notification_type_id' => 'Notification Type',
            'tablet_id' => 'Tablet',
            'customer_id' => 'Customer',
            'redirect_url' => 'Redirect Url',
            'read_status' => 'Read Status',
            'read_timestamp' => 'Read Timestamp',
            'created_at' => 'Create At',
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
        $criteria->compare('notification_type_id', $this->notification_type_id, true);
        $criteria->compare('tablet_id', $this->tablet_id, true);
        $criteria->compare('customer_id', $this->customer_id, true);
        $criteria->compare('redirect_url', $this->redirect_url);
        $criteria->compare('read_status', $this->read_status);
        $criteria->compare('read_timestamp', $this->read_timestamp);
        $criteria->compare('created_at', $this->created_at);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return QuestionMaster the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        $userId = 0;
        if ($this->isNewRecord)
            $this->created_at = new CDbExpression('NOW()');


        if (null != Yii::app()->user->id)
            $userId = (int) Yii::app()->user->id;

        if ($this->isNewRecord) {
            
        } else {
            
        }
        return parent::beforeSave();
    }

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

//    public function getDataFromPK($pId) {
//        $criteria = new CDbCriteria;
//        $criteria->condition = "branch_id=" . $pId;
//        return new CActiveDataProvider($this, array(
//            'criteria' => $criteria,
//        ));
//    }
//
//    public static function getAllQuestion_Count_User() {
//        $list = Yii::app()->db->createCommand('SELECT COUNT(*) AS Total_Question_Count FROM `question_master` WHERE `branch_id` in (SELECT `id` FROM `branch_master` WHERE `customer_id`=' . Yii::app()->user->id . ')')->queryAll();
//        $Tablet_count = "";
//        foreach ($list as $item) {
//            $Tablet_count = $item['Total_Question_Count'];
//        }
//        return $Tablet_count;
//    }
}
