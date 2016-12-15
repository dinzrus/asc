<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "borrower".
 *
 * @property integer $id
 * @property string $profile_pic
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $suffix
 * @property string $birthdate
 * @property integer $age
 * @property string $birthplace
 * @property integer $address_province_id
 * @property integer $address_city_municipality_id
 * @property integer $address_barangay_id
 * @property string $address_street_house_no
 * @property string $civil_status
 * @property string $contact_no
 * @property string $canvass_date
 * @property string $tin_no
 * @property string $sss_no
 * @property string $ctc_no
 * @property string $license_no
 * @property string $spouse_name
 * @property string $spouse_occupation
 * @property integer $spouse_age
 * @property string $spouse_birthdate
 * @property integer $no_dependent
 * @property integer $branch_id
 * @property string $attachment
 * @property string $acount_type
 *
 * @property \app\models\Province $addressProvince
 * @property \app\models\Barangay $addressBarangay
 * @property \app\models\MunicipalityCity $addressCityMunicipality
 */
class Borrower extends \yii\db\ActiveRecord {

    use \mootensai\relation\RelationTrait;

    const ACCOUNT_TYPE1 = 'B';
    const ACCOUNT_TYPE2 = 'C';

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['branch_id','canvass_by', 'gender', 'first_name', 'last_name', 'middle_name', 'birthdate', 'age', 'birthplace', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'address_street_house_no', 'civil_status', 'contact_no'], 'required'],
            [['father_birthdate', 'mother_birthdate', 'birthdate', 'canvass_date', 'spouse_birthdate', 'created_at', 'updated_at'], 'safe'],
            [['canvass_by', 'age', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'spouse_age', 'no_dependent', 'branch_id', 'mother_age', 'father_age'], 'integer'],
            [['attachment'], 'string'],
            [['profile_pic', 'first_name', 'last_name', 'middle_name', 'suffix', 'birthplace', 'address_street_house_no', 'civil_status', 'contact_no', 'tin_no', 'sss_no', 'ctc_no', 'license_no', 'spouse_name', 'spouse_occupation', 'status', 'acount_type', 'mother_name', 'father_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'borrower';
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
            'address_province_id' => 'Address Province ID',
            'address_city_municipality_id' => 'Address City Municipality ID',
            'address_barangay_id' => 'Address Barangay ID',
            'address_street_house_no' => 'Address Street House No',
            'civil_status' => 'Civil Status',
            'contact_no' => 'Contact No',
            'canvass_date' => 'Canvass Date',
            'tin_no' => 'Tin No',
            'sss_no' => 'Sss No',
            'ctc_no' => 'Ctc No',
            'license_no' => 'License No',
            'spouse_name' => 'Spouse Name',
            'spouse_occupation' => 'Spouse Occupation',
            'spouse_age' => 'Spouse Age',
            'spouse_birthdate' => 'Spouse Birthdate',
            'no_dependent' => 'No Dependent',
            'status' => 'Status',
            'branch_id' => 'Branch ID',
            'attachment' => 'Attachment',
            'acount_type' => 'Acount Type',
        ];
    }

    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('Now()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_at',
                'updatedByAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('Now()'),
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddressProvince() {
        return $this->hasOne(\app\models\Province::className(), ['id' => 'address_province_id']);
    }
    
    public function getFullname(){
        return $this->last_name. ', ' . $this->first_name . ' ' . $this->middle_name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddressBarangay() {
        return $this->hasOne(\app\models\Barangay::className(), ['id' => 'address_barangay_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddressCityMunicipality() {
        return $this->hasOne(\app\models\MunicipalityCity::className(), ['id' => 'address_city_municipality_id']);
    }
    
    public function getEmployee() {
        return $this->hasOne(\app\models\Employee::className(), ['id' => 'canvass_by']);
    }

    /**
     * @inheritdoc
     * @return \app\models\BorrowerQuery the active query used by this AR class.
     */
    public static function find() {
        return new \app\models\BorrowerQuery(get_called_class());
    }

}
