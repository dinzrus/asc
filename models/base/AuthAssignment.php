<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "auth_assignment".
 *
 * @property string $item_name
 * @property int $user_id
 * @property integer $created_at
 *
 * @property \app\models\AuthItem $itemName
 */
class AuthAssignment extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at', 'user_id'], 'integer'],
            [['item_name'], 'string', 'max' => 64]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_name' => 'Item Name',
            'user_id' => 'User',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(\app\models\AuthItem::className(), ['name' => 'item_name']);
    }
    
    /**
     * 
     * @return type
     */
    
    public function getUser(){
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }
    
    
    /**
     * @inheritdoc
     * @return \app\models\AuthAssignmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\AuthAssignmentQuery(get_called_class());
    }
}
