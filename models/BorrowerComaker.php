<?php

namespace app\models;

use Yii;
use \app\models\base\BorrowerComaker as BaseBorrowerComaker;

/**
 * This is the model class for table "borrower_comaker".
 */
class BorrowerComaker extends BaseBorrowerComaker
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['borrower_id', 'comaker_id', 'relationship'], 'required'],
            [['borrower_id', 'comaker_id'], 'integer'],
            [['relationship'], 'string', 'max' => 255]
        ]);
    }
	
}
