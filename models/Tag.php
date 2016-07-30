<?php

namespace app\models;

use Yii;
use \app\models\base\Tag as BaseTag;

/**
 * This is the model class for table "tag".
 */
class Tag extends BaseTag
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['borrower'], 'integer'],
            [['tag_description'], 'string', 'max' => 255]
        ]);
    }
	
}
