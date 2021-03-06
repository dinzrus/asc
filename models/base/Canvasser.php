<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the base model class for table "canvasser".
 *
 * @property integer $id
 * @property string $fname
 * @property string $lname
 * @property string $middlename
 * @property integer $age
 * @property string $birthdate
 * @property string $address
 * @property integer $branch_id
 * @property string $updated_at
 * @property string $created_at
 *
 * @property \app\models\Branch $branch
 */
class Canvasser extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fname', 'lname', 'middlename', 'age', 'birthdate', 'address', 'branch_id'], 'required'],
            ['middlename', 'unique', 'targetAttribute' => ['lname', 'fname', 'middlename']],
            [['age', 'branch_id'], 'integer'],
            [['birthdate', 'updated_at', 'created_at'], 'safe'],
            [['fname', 'lname', 'middlename', 'address'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'canvasser';
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
    
    public function getFullname(){
        return $this->lname . ', ' . $this->fname;
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
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\CanvasserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\CanvasserQuery(get_called_class());
    }
}
