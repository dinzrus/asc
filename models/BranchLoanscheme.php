<?php

namespace app\models;

use Yii;
use \app\models\base\BranchLoanscheme as BaseBranchLoanscheme;

/**
 * This is the model class for table "branch_loanscheme".
 */
class BranchLoanscheme extends BaseBranchLoanscheme
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['branch_loanscheme_id', 'loanscheme', 'branch', 'date_created', 'date_updated'], 'required'],
            [['branch_loanscheme_id', 'loanscheme', 'branch'], 'integer'],
            [['date_created', 'date_updated'], 'safe']
        ]);
    }
	
}
