<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "emposition".
 *
 * @property integer $id
 * @property integer $employee_id
 * @property integer $branch_id
 * @property integer $position_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \app\models\Collectorunit[] $collectorunits
 * @property \app\models\Employee $employee
 * @property \app\models\Position $position
 * @property \app\models\Branch $branch
 */
class Emposition extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id', 'branch_id'], 'required'],
            [['employee_id', 'branch_id', 'position_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emposition';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'branch_id' => 'Branch ID',
            'position_id' => 'Position ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollectorunits()
    {
        return $this->hasMany(\app\models\Collectorunit::className(), ['collector_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(\app\models\Employee::className(), ['id' => 'employee_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(\app\models\Position::className(), ['id' => 'position_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(\app\models\Branch::className(), ['branch_id' => 'branch_id']);
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
                'value' => Yii::$app->user->id,
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\EmpositionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\EmpositionQuery(get_called_class());
    }
}
