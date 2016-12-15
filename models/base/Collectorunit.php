<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "collectorunit".
 *
 * @property integer $id
 * @property integer $collector_id
 * @property integer $unit_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \app\models\Emposition $collector
 * @property \app\models\Unit $unit
 */
class Collectorunit extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['collector_id', 'unit_id'], 'required'],
            [['collector_id', 'unit_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collectorunit';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'collector_id' => 'Collector ID',
            'unit_id' => 'Unit ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollector()
    {
        return $this->hasOne(\app\models\Emposition::className(), ['id' => 'collector_id']);
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
     * @return \app\models\CollectorunitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\CollectorunitQuery(get_called_class());
    }
}
