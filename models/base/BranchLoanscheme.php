<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "branch_loanscheme".
 *
 * @property integer $branch_loanscheme_id
 * @property integer $loanscheme
 * @property integer $branch
 * @property string $date_created
 * @property string $date_updated
 *
 * @property \app\models\LoanScheme $loanscheme0
 * @property \app\models\Branch $branch0
 */
class BranchLoanscheme extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_loanscheme_id', 'loanscheme', 'branch', 'date_created', 'date_updated'], 'required'],
            [['branch_loanscheme_id', 'loanscheme', 'branch'], 'integer'],
            [['date_created', 'date_updated'], 'safe']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branch_loanscheme';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'branch_loanscheme_id' => 'Branch Loanscheme ID',
            'loanscheme' => 'Loanscheme',
            'branch' => 'Branch',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoanscheme0()
    {
        return $this->hasOne(\app\models\LoanScheme::className(), ['loan_scheme_id' => 'loanscheme']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch0()
    {
        return $this->hasOne(\app\models\Branch::className(), ['branch_id' => 'branch']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\BranchLoanschemeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\BranchLoanschemeQuery(get_called_class());
    }
}
