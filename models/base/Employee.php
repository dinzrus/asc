<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "employee".
 *
 * @property integer $employee_id
 * @property string $firstname
 * @property string $lastname
 * @property string $middlename
 * @property string $birth_date
 * @property string $gender
 * @property string $civil_status
 * @property string $home_address
 * @property string $sss_no
 * @property string $philhealth_no
 * @property string $tin_no
 * @property string $contact_no
 *
 * @property \app\models\User[] $users
 */
class Employee extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'birth_date', 'gender', 'civil_status', 'home_address', 'contact_no'], 'required'],
            [['birth_date'], 'safe'],
            [['firstname', 'lastname', 'middlename', 'gender', 'civil_status', 'home_address', 'sss_no', 'profile_pic', 'philhealth_no', 'tin_no', 'contact_no'], 'string', 'max' => 255],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => 'Employee ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'middlename' => 'Middlename',
            'birth_date' => 'Birth Date',
            'gender' => 'Gender',
            'civil_status' => 'Civil Status',
            'home_address' => 'Home Address',
            'sss_no' => 'Sss No',
            'philhealth_no' => 'Philhealth No',
            'tin_no' => 'Tin No',
            'profile_pic' => 'Profile Pic',
            'contact_no' => 'Contact No',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(\app\models\User::className(), ['employee' => 'employee_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\EmployeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\EmployeeQuery(get_called_class());
    }
}
