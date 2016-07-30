<?php

namespace app\models;

use Yii;
use \app\models\base\LoanschemeType as BaseLoanschemeType;

/**
 * This is the model class for table "loanscheme_type".
 */
class LoanschemeType extends BaseLoanschemeType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['type_description'], 'required'],
            [['created_date', 'updated_date'], 'safe'],
            [['type_description'], 'string', 'max' => 255]
        ]);
    }
	
}
