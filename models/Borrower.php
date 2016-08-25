<?php

namespace app\models;

use Yii;
use \app\models\base\Borrower as BaseBorrower;
use yii\base\Exception;

/**
 * This is the model class for table "borrower".
 */
class Borrower extends BaseBorrower {

    public $borrower_pic;
    public $attachfiles;
    
    const CANVASSED = 'C';
    const APPROVED = 'A';

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_replace_recursive(parent::rules(), [
            [['no_dependent', 'collaterals', 'first_name', 'last_name', 'middle_name', 'birthdate', 'age', 'birthplace', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'address_street_house_no', 'civil_status', 'contact_no', 'ci_date', 'canvass_date', 'spouse_name', 'spouse_occupation', 'spouse_age', 'spouse_birthdate'], 'required'],
            ['middle_name', 'unique', 'targetAttribute' => ['last_name', 'first_name', 'middle_name']],
            [['birthdate', 'ci_date', 'canvass_date', 'spouse_birthdate', 'created_at', 'updated_at'], 'safe'],
            [['age', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'spouse_age', 'no_dependent', 'branch_id'], 'integer'],
            [['collaterals', 'attachment'], 'string'],
            [['profile_pic', 'first_name', 'last_name', 'middle_name', 'suffix', 'birthplace', 'address_street_house_no', 'civil_status', 'contact_no', 'tin_no', 'sss_no', 'ctc_no', 'license_no', 'spouse_name', 'spouse_occupation', 'status', 'acount_type'], 'string', 'max' => 255],
            [['borrower_pic'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['attachfiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 7]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'profile_pic' => 'Profile Pic',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
            'suffix' => 'Suffix',
            'birthdate' => 'Birthdate',
            'age' => 'Age',
            'birthplace' => 'Birthplace',
            'address_province_id' => 'Province',
            'address_city_municipality_id' => 'City/Municipality',
            'address_barangay_id' => 'Barangay',
            'address_street_house_no' => 'Street/House No.',
            'civil_status' => 'Civil Status',
            'contact_no' => 'Contact No',
            'ci_date' => 'C.I. Date',
            'canvass_date' => 'Canvass Date',
            'tin_no' => 'TIN No',
            'sss_no' => 'SSS No',
            'ctc_no' => 'CTC No',
            'license_no' => 'License No',
            'spouse_name' => 'Spouse Name',
            'spouse_occupation' => 'Spouse Occupation',
            'spouse_age' => 'Spouse Age',
            'spouse_birthdate' => 'Spouse Date of Birth',
            'no_dependent' => 'No Dependent',
            'collaterals' => 'Collaterals',
            'status' => 'Status',
            'branch_id' => 'Branch',
            'attachment' => 'Attachment',
            'acount_type' => 'Acount Type',
            'borrower_pic' => ''
        ];
    }
    
    public function getBranch() {
        return $this->hasOne(\app\models\Branch::className(), ['branch_id' => 'branch_id']);
    }

    /**
     * This will set the url of the borrower image for saving into the database, if success this 
     * will return true else it will return false
     * @return boolean
     */
    public function setPicUrl() {
        if ($this->validate()) {
            $this->profile_pic = "fileupload/" . $this->first_name . '-' . $this->last_name . '-' . $this->middle_name . '.' . $this->borrower_pic->extension;
            return true;
        } else {
            return false;
        }
    }

    /**
     * This will upload the profile image, if success this 
     * will return true else it will return false
     * @return boolean
     */
    public function upload() {
        if ($this->validate()) {
            $this->borrower_pic->saveAs($this->profile_pic);
            return true;
        } else {
            return false;
        }
    }

    /**
     * This will set the url of the profile image,if success this 
     * will return true else it will return false
     * @return boolean
     */
    public function setAttachUrls() {
        $attachcount = count($this->attachfiles);
        $attachnames = "";
        if ($this->validate() && ($attachcount > 0)) {
            for ($i = 0; $i < $attachcount; $i++) {
                $attachmentobject = $this->attachfiles[$i];
                $tpname = $this->birthdate . '-' . $this->last_name . '-' . $this->first_name . '-' . $this->middle_name . '-attachment' . $i . '.' . $attachmentobject->extension;
                $attachnames = ($i == 0)? $attachnames . 'fileupload/' . $tpname : $attachnames . ';' . 'fileupload/' . $tpname;
            }
            $this->attachment = trim($attachnames);
            return true;
        } else {
            return false;
        }
    }

    /**
     * This will upload all the attachfiles, if success this 
     * will return true else it will return false 
     * @return boolean
     */
    public function uploadAttachFiles() {
        $attachcount = count($this->attachfiles);
        if ($attachcount > 0) {
            for ($i = 0; $i < $attachcount; $i++) {
                $attachmentobject = $this->attachfiles[$i];
                $tpname = 'fileupload/' . $this->birthdate . '-' . $this->last_name . '-' . $this->first_name . '-' . $this->middle_name . '-attachment' . $i . '.' . $attachmentobject->extension;
                $attachmentobject->saveAs($tpname);
            }
            return true;
        } else {
            return false;
        }
    }

}
