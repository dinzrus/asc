<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "loanscheme_assignment".
 *
 * @property integer $id
 * @property integer $loanscheme_id
 * @property integer $branch_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property \app\models\Branch $branch
 * @property \app\models\Loanscheme $loanscheme
 */
class LoanschemeAssignment extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loanscheme_id', 'branch_id'], 'required'],
            [['loanscheme_id', 'branch_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'string', 'max' => 255],

        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loanscheme_assignment';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loanscheme_id' => 'Loanscheme ID',
            'branch_id' => 'Branch ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(\app\models\Branch::className(), ['branch_id' => 'branch_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoanscheme()
    {
        return $this->hasOne(\app\models\Loanscheme::className(), ['id' => 'loanscheme_id']);
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
     * @return \app\models\LoanschemeAssignmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\LoanschemeAssignmentQuery(get_called_class());
    }
}
