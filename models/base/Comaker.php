<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "comaker".
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
 * @property string $status
 * @property integer $branch_id
 * @property string $attachment
 * @property string $gender
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 */
class Comaker extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'middle_name', 'birthdate', 'age', 'birthplace', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'address_street_house_no', 'civil_status', 'contact_no', 'gender'], 'required'],
            [['birthdate', 'created_at', 'updated_at'], 'safe'],
            [['age', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'branch_id'], 'integer'],
            [['attachment'], 'string'],
            [['profile_pic', 'first_name', 'last_name', 'middle_name', 'suffix', 'birthplace', 'address_street_house_no', 'civil_status', 'contact_no', 'status', 'gender', 'created_by', 'updated_by'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comaker';
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
            'address_province_id' => 'Address Province',
            'address_city_municipality_id' => 'Address City/Municipality',
            'address_barangay_id' => 'Address Barangay',
            'address_street_house_no' => 'Address Street/House No.',
            'civil_status' => 'Civil Status',
            'contact_no' => 'Contact No',
            'status' => 'Status',
            'branch_id' => 'Branch',
            'attachment' => 'Attachment',
            'gender' => 'Gender',
        ];
    }

/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }
    
    /**
     * @inheritdoc
     * @return \app\models\ComakerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ComakerQuery(get_called_class());
    }
}
