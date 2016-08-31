<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the base model class for table "ci".
 *
 * @property integer $id
 * @property string $fname
 * @property string $lname
 * @property string $middlename
 * @property integer $age
 * @property string $birthdate
 * @property string $address
 * @property integer $branch_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \app\models\Branch $branch
 */
class Ci extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fname', 'lname', 'middlename', 'age', 'birthdate', 'address', 'branch_id'], 'required'],
            [['age', 'branch_id'], 'integer'],
            [['birthdate', 'created_at', 'updated_at'], 'safe'],
            [['fname', 'lname', 'middlename', 'address'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ci';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fname' => 'Fname',
            'lname' => 'Lname',
            'middlename' => 'Middlename',
            'age' => 'Age',
            'birthdate' => 'Birthdate',
            'address' => 'Address',
            'branch_id' => 'Branch ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(\app\models\Branch::className(), ['branch_id' => 'branch_id']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_at',
                'updatedByAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\CiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\CiQuery(get_called_class());
    }
}
