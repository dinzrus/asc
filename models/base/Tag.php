<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "tag".
 *
 * @property integer $tag_id
 * @property integer $borrower
 * @property string $tag_description
 */
class Tag extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['borrower'], 'integer'],
            [['tag_description'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => 'Tag ID',
            'borrower' => 'Borrower',
            'tag_description' => 'Tag Description',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\TagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\TagQuery(get_called_class());
    }
}
