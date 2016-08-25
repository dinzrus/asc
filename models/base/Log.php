<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the base model class for table "log".
 *
 * @property integer $id
 * @property integer $log_type
 * @property string $log_description
 * @property string $log_date
 * @property integer $user_id
 * @property integer $branch_id
 *
 * @property \app\models\Logtype $logType
 */
class Log extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'user_id', 'branch_id'], 'integer'],
            [['log_type', 'log_date'], 'safe'],
            [['log_type','log_description'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'log_type' => 'Log Type',
            'log_description' => 'Log Description',
            'log_date' => 'Log Date',
            'user_id' => 'User ID',
            'branch_id' => 'Branch ID',
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
                'createdAtAttribute' => 'log_date',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'log_date',
                'updatedByAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\LogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\LogQuery(get_called_class());
    }
}
