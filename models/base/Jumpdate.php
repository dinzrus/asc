<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "jumpdate".
 *
 * @property integer $jump_id
 * @property string $jump_date
 * @property string $jump_description
 */
class Jumpdate extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jump_date', 'jump_description'], 'required'],
            [['jump_date'], 'safe'],
            [['jump_description'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jumpdate';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jump_id' => 'Jump ID',
            'jump_date' => 'Jump Date',
            'jump_description' => 'Jump Description',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\JumpdateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\JumpdateQuery(get_called_class());
    }
}
