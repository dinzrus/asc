<?php

namespace app\models;

use Yii;
use \app\models\base\Employee as BaseEmployee;

/**
 * This is the model class for table "employee".
 */
class Employee extends BaseEmployee {
    
    public $file;

    /**
     * @inheritdoc
     */
    
    public function attributeLabels(){
        return [
            'file' => 'Profile Photo',
        ];
    }
    
    public function rules() {
        return array_replace_recursive(parent::rules(), [
            [['firstname', 'lastname', 'birth_date', 'gender', 'civil_status', 'home_address', 'contact_no'], 'required'],
            [['birth_date'], 'safe'],
            [['firstname', 'lastname', 'middlename', 'gender', 'civil_status', 'home_address', 'profile_pic', 'sss_no', 'philhealth_no', 'tin_no', 'contact_no'], 'string', 'max' => 255],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ]);
    }
    
}
