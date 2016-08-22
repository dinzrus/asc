<?php

namespace app\models;

use \app\models\base\User as BaseUser;

/**
 * This is the model class for table "user".
 */
class User extends BaseUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'branch_id', 'firstname', 'lastname', 'middlename', 'birthdate', 'age', 'civil_status', 'gender', 'home_address', 'contact_no'], 'required'],
            [['status', 'created_at', 'updated_at', 'branch_id', 'age'], 'integer'],
            [['birthdate'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'firstname', 'lastname', 'middlename', 'civil_status', 'gender', 'home_address', 'sss_no', 'philhealth_no', 'tin_no', 'contact_no', 'picture'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique']
        ]);
    }
    
    public function getBranch() {
        return $this->hasOne(\app\models\Branch::className(), ['branch_id' => 'branch_id']);
    }
	
}
