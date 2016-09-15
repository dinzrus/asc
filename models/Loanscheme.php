<?php

namespace app\models;

use \app\models\base\Loanscheme as BaseLoanscheme;

/**
 * This is the model class for table "loanscheme".
 */
class Loanscheme extends BaseLoanscheme
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['loanscheme_name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['loanscheme_name'], 'string', 'max' => 100],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
        ]);
    }
	
}
