<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "loanscheme".
 *
 * @property integer $id
 * @property string $loanscheme_name
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property \app\models\LoanschemeAssignment[] $loanschemeAssignments
 * @property \app\models\LoanschemeValues[] $loanschemeValues
 */
class Loanscheme extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loanscheme_name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['loanscheme_name'], 'string', 'max' => 100],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loanscheme';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loanscheme_name' => 'Loanscheme Name',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoanschemeAssignments()
    {
        return $this->hasMany(\app\models\LoanschemeAssignment::className(), ['loanscheme_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoanschemeValues()
    {
        return $this->hasMany(\app\models\LoanschemeValues::className(), ['loanscheme_id' => 'id']);
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
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\LoanschemeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\LoanschemeQuery(get_called_class());
    }
}
