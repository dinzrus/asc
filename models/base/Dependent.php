<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "dependent".
 *
 * @property integer $id
 * @property string $name
 * @property integer $age
 * @property string $birthdate
 * @property integer $borrower_id
 */
class Dependent extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['age', 'borrower_id'], 'integer'],
            [['birthdate'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dependent';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'age' => 'Age',
            'birthdate' => 'Birthdate',
            'borrower_id' => 'Borrower ID',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\DependentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\DependentQuery(get_called_class());
    }
}
