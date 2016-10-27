<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use app\models\base\Borrower as Base;

/**
 * Description of Comaker
 *
 * @author Russel Dinoy
 */
class Comaker extends Base{
    
    public $comaker_pic;
    
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'middle_name', 'birthdate', 'age', 'birthplace', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'address_street_house_no', 'civil_status', 'contact_no'], 'required'],
            [['birthdate', 'ci_date', 'canvass_date', 'spouse_birthdate', 'created_at', 'updated_at'], 'safe'],
            [['age', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'spouse_age', 'no_dependent', 'branch_id'], 'integer'],
            [['attachment'], 'string'],
            [['profile_pic', 'first_name', 'last_name', 'middle_name', 'suffix', 'birthplace', 'address_street_house_no', 'civil_status', 'contact_no', 'tin_no', 'sss_no', 'ctc_no', 'license_no', 'spouse_name', 'spouse_occupation', 'status'], 'string', 'max' => 255],
            [['comaker_pic'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
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
            'address_province_id' => 'Address Province ID',
            'address_city_municipality_id' => 'Address City Municipality ID',
            'address_barangay_id' => 'Address Barangay ID',
            'address_street_house_no' => 'Address Street House No',
            'civil_status' => 'Civil Status',
            'contact_no' => 'Contact No',
            'spouse_name' => 'Spouse Name',
            'spouse_occupation' => 'Spouse Occupation',
            'spouse_age' => 'Spouse Age',
            'spouse_birthdate' => 'Spouse Birthdate',
            'no_dependent' => 'No Dependent',
            'branch_id' => 'Branch ID',
            'comaker_pic' => '',
        ];
    }
    
    //function to get the url of the file uploaded
     public function setPicUrl() {
        if ($this->validate()) {
            $this->profile_pic = "fileupload/" . $this->first_name . '-' . $this->last_name . '-' . $this->middle_name . '.' . $this->comaker_pic->extension;
            return true;
        } else {
            return false;
        }
    }
    
    //uploading image file
     public function upload()
    {
        if ($this->validate()) {
            $this->comaker_pic->saveAs($this->profile_pic);
            return true;
        } else {
            return false;
        }
    }
}
