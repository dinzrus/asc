<?php

namespace app\models;

use Yii;
use \app\models\base\Branch as BaseBranch;

/**
 * This is the model class for table "branch".
 */
class Branch extends BaseBranch
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['branch_description', 'address', 'telephone_no'], 'required'],
            [['branch_description', 'address', 'telephone_no'], 'string', 'max' => 255]
        ]);
    }
	
}
