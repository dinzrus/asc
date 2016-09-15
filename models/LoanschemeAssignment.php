<?php

namespace app\models;

use \app\models\base\LoanschemeAssignment as BaseLoanschemeAssignment;

/**
 * This is the model class for table "loanscheme_assignment".
 */
class LoanschemeAssignment extends BaseLoanschemeAssignment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['loanscheme_id', 'branch_id'], 'required'],
            [['loanscheme_id', 'branch_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
        ]);
    }
	
}
