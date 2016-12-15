<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "collector".
 *
 * @property integer $id
 * @property string $fname
 * @property string $lname
 * @property string $middlename
 * @property string $birthdate
 * @property integer $age
 * @property string $gender
 * @property integer $branch_id
 * @property integer $unit_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \app\models\Branch $branch
 * @property \app\models\Unit $unit
 */
class Collector extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fname', 'lname', 'gender', 'branch_id', 'unit_id'], 'required'],
            [['birthdate', 'created_at', 'updated_at'], 'safe'],
            [['age', 'branch_id', 'unit_id', 'created_by', 'updated_by'], 'integer'],
            [['fname', 'lname', 'middlename', 'gender'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collector';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fname' => 'First name',
            'lname' => 'Last name',
            'middlename' => 'Middle name',
            'birthdate' => 'Date of Birth',
            'age' => 'Age',
            'gender' => 'Gender',
            'branch_id' => 'Branch',
            'unit_id' => 'Unit',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(\app\models\Branch::className(), ['branch_id' => 'branch_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(\app\models\Unit::className(), ['unit_id' => 'unit_id']);
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
                'value' => new \yii\db\Expression('Now()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
                'value' => new \yii\db\Expression('Now()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\CollectorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\CollectorQuery(get_called_class());
    }
}
