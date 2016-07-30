<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "status".
 *
 * @property integer $status_id
 * @property string $status
 *
 * @property \app\models\Borrower[] $borrowers
 */
class Status extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_id' => 'Status ID',
            'status' => 'Status',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBorrowers()
    {
        return $this->hasMany(\app\models\Borrower::className(), ['status' => 'status_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\StatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\StatusQuery(get_called_class());
    }
}
