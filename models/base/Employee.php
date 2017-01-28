<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "employee".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $date_birth
 * @property integer $age
 * @property string $gender
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \app\models\Emposition[] $empositions
 */
class Employee extends \yii\db\ActiveRecord {

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['first_name', 'last_name', 'gender'], 'required'],
                [['date_birth', 'created_at', 'updated_at'], 'safe'],
                [['age', 'created_by', 'updated_by'], 'integer'],
                [['first_name', 'last_name', 'middle_name', 'gender'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
            'date_birth' => 'Date Birth',
            'age' => 'Age',
            'gender' => 'Gender',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpositions() {
        return $this->hasMany(\app\models\Emposition::className(), ['employee_id' => 'id']);
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
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\EmployeeQuery the active query used by this AR class.
     */
    public static function find() {
        return new \app\models\EmployeeQuery(get_called_class());
    }

}
