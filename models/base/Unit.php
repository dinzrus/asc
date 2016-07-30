<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "unit".
 *
 * @property integer $unit_id
 * @property string $unit_description
 * @property integer $branch_id
 *
 * @property \app\models\Loan[] $loans
 * @property \app\models\Branch $branch
 */
class Unit extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unit_description', 'branch_id'], 'required'],
            [['branch_id'], 'integer'],
            [['unit_description'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unit';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'unit_id' => 'Unit ID',
            'unit_description' => 'Unit Description',
            'branch_id' => 'Branch ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoans()
    {
        return $this->hasMany(\app\models\Loan::className(), ['unit' => 'unit_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(\app\models\Branch::className(), ['branch_id' => 'branch_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\UnitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\UnitQuery(get_called_class());
    }
}
