<?php

/**
 * This is the model class for table "message_master". 
 * 
 * The followings are the available columns in table 'message_master': 
 * @property integer $id
 * @property string $message
 * @property integer $message_to
 * @property integer $message_from
 * @property integer $is_broadcast
 * @property integer $read_status
 * @property integer $priority
 * @property string $schedule_timestamp
 * @property string $created_at
 */
class MessageMaster extends CActiveRecord {

    /**
     * @return string the associated database table name 
     */
    public function tableName() {
        return 'message_master';
    }

    /**
     * @return array validation rules for model attributes. 
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that 
        // will receive user inputs. 
        return array(
            array('message,subject, message_to, message_from, is_broadcast, read_status, priority, schedule_timestamp, created_at', 'required'),
            array('message_to, message_from, is_broadcast, read_status, priority', 'numerical', 'integerOnly' => true),
            /*
              //Example username
              array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
              'message'=>'Username can contain only alphanumeric
              characters and hyphens(-).'),
              array('username','unique'),
             */
            // The following rule is used by search(). 
            // @todo Please remove those attributes that should not be searched. 
            array('id, message, message_to, message_from, is_broadcast, read_status, priority, schedule_timestamp, created_at', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules. 
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related 
        // class name for the relations automatically generated below. 
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label) 
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'message' => 'Message',
            'subject' => 'subject',
            'message_to' => 'Message To',
            'is_archive' => 'Archive',
            'message_from' => 'Message From',
            'is_broadcast' => 'Is Broadcast',
            'read_status' => 'Read Status',
            'priority' => 'Priority',
            'schedule_timestamp' => 'Schedule Timestamp',
            'created_at' => 'Created At',
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
        $criteria->compare('message', $this->message, true);
        $criteria->compare('subject', $this->subject, true);
        $criteria->compare('message_to', $this->message_to);
        $criteria->compare('message_from', $this->message_from);
        $criteria->compare('is_broadcast', $this->is_broadcast);
        $criteria->compare('read_status', $this->read_status);
        $criteria->compare('priority', $this->priority);
        $criteria->compare('priority', $this->priority);
        $criteria->compare('schedule_timestamp', $this->schedule_timestamp, true);
        $criteria->compare('created_at', $this->created_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class. 
     * Please note that you should have this exact method in all your CActiveRecord descendants! 
     * @param string $className active record class name. 
     * @return MessageMaster the static model class 
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


        return parent::beforeSave();
    }

    public function beforeDelete() {
        $userId = 0;
        if (null != Yii::app()->user->id)
            $userId = (int) Yii::app()->user->id;

        return false;
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

}

?>