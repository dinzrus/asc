<?php

namespace app\models;

use \app\models\base\User as BaseUser;

/**
 * This is the model class for table "user".
 */
class User extends BaseUser {

    public $photo;

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_replace_recursive(parent::rules(), [
            [['pass', 'username', 'email', 'branch_id', 'firstname', 'lastname', 'middlename', 'birthdate', 'age', 'civil_status', 'gender', 'home_address', 'contact_no'], 'required'],
            [['status', 'branch_id', 'age'], 'integer'],
            [['birthdate'], 'safe'],
            [['temp_pass', 'username', 'email', 'firstname', 'lastname', 'middlename', 'civil_status', 'gender', 'home_address', 'sss_no', 'philhealth_no', 'tin_no', 'contact_no', 'picture'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['photo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ]);
    }

    /**
     * 
     * @return type
     */
    public function getBranch() {
        return $this->hasOne(\app\models\Branch::className(), ['branch_id' => 'branch_id']);
    }

    /**
     * Save photo url to database
     * @return boolean
     */
    public function setUrl() {
        if ($this->validate()) {
            $this->picture = 'fileupload/' . $this->lastname . '-' . $this->firstname . '-' . $this->middlename . '-' . $this->birthdate . '-photo.' . $this->photo->extension;
            return true;
        } else {
            return false;
        }
    }

    /**
     * upload phot to fileupload/ directory
     * @return boolean
     */
    public function uploadPhoto() {
        if ($this->validate() && isset($this->photo)) {
            $this->photo->saveAs($this->picture);
            return true;
        } else {
            return false;
        }
    }

}
