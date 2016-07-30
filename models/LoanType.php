<?php

namespace app\models;

use Yii;
use \app\models\base\LoanType as BaseLoanType;

/**
 * This is the model class for table "loan_type".
 */
class LoanType extends BaseLoanType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['loan_description'], 'required'],
            [['loan_description'], 'string', 'max' => 255]
        ]);
    }
	
}
