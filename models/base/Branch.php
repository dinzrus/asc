<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "branch".
 *
 * @property integer $branch_id
 * @property string $branch_description
 * @property string $address
 * @property string $telephone_no
 *
 * @property \app\models\BranchLoanscheme[] $branchLoanschemes
 * @property \app\models\Unit[] $units
 */
class Branch extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_description', 'address', 'telephone_no'], 'required'],
            [['branch_description', 'address', 'telephone_no'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'branch_id' => 'Branch ID',
            'branch_description' => 'Branch Description',
            'address' => 'Address',
            'telephone_no' => 'Telephone No',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranchLoanschemes()
    {
        return $this->hasMany(\app\models\BranchLoanscheme::className(), ['branch' => 'branch_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(\app\models\Unit::className(), ['branch_id' => 'branch_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
   
    
    /**
     * @inheritdoc
     * @return \app\models\BranchQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\BranchQuery(get_called_class());
    }
}
