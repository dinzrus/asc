<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "marriage_status".
 *
 * @property integer $id
 * @property string $status
 *
 * @property \app\models\Borrower[] $borrowers
 */
class MarriageStatus extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marriage_status';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBorrowers()
    {
        return $this->hasMany(\app\models\Borrower::className(), ['marriage_status' => 'id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\MarriageStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\MarriageStatusQuery(get_called_class());
    }
}
