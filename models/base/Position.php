<?php

namespace app\models\base;

use Yii;


/**
 * This is the base model class for table "position".
 *
 * @property integer $id
 * @property string $position
 *
 * @property \app\models\Emposition[] $empositions
 */
class Position extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position'], 'required'],
            [['position'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'position';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'position' => 'Position',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpositions()
    {
        return $this->hasMany(\app\models\Emposition::className(), ['position_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\PositionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\PositionQuery(get_called_class());
    }
}
