<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "log".
 *
 * @property integer $log_id
 * @property string $log_description
 * @property integer $user
 * @property string $log_date
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
            [['user'], 'integer'],
            [['log_date'], 'safe'],
            [['log_description'], 'string', 'max' => 255]
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
            'log_id' => 'Log ID',
            'log_description' => 'Log Description',
            'user' => 'User',
            'log_date' => 'Log Date',
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
