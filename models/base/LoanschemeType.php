<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "loanscheme_type".
 *
 * @property integer $loanscheme_type_id
 * @property string $type_description
 * @property string $created_date
 * @property string $updated_date
 *
 * @property \app\models\LoanScheme[] $loanSchemes
 */
class LoanschemeType extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_description'], 'required'],
            [['created_date', 'updated_date'], 'safe'],
            [['type_description'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loanscheme_type';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'loanscheme_type_id' => 'Loanscheme Type ID',
            'type_description' => 'Type Description',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoanSchemes()
    {
        return $this->hasMany(\app\models\LoanScheme::className(), ['loanscheme_type' => 'loanscheme_type_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\LoanschemeTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\LoanschemeTypeQuery(get_called_class());
    }
}
