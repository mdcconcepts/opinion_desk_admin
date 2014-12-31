<?php

/**
 * This is the model class for table "option_type".
 *
 * The followings are the available columns in table 'option_type':
 * @property integer $id
 * @property string $option_type
 */
class TabletSessionMaster extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tablet_session_master';
    }

    /**
     * @return array validation rules for model attributes.
     */
//    public function rules() {
//        // NOTE: you should only define rules for those attributes that
//        // will receive user inputs.
//        return array(
//            array('`session_token`,`timeout`', 'required'),
//            array('session_token', 'length', 'max' => 300),
//                // The following rule is used by search().
//                // @todo Please remove those attributes that should not be searched.
//        );
//    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'TabletSessionMaster' => array(self::HAS_ONE, 'TabletMaster', 'tablet_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'id',
            'tablet_id' => 'Tablet',
            'session_token' => 'Session Token',
            'timeout' => 'Time Out',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OptionType the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        $userId = 0;
        if (null != Yii::app()->user->id)
            $userId = (int) Yii::app()->user->id;
        return parent::beforeSave();
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

}
