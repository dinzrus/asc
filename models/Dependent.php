<?php

namespace app\models;

use Yii;
use \app\models\base\Dependent as BaseDependent;

/**
 * This is the model class for table "dependent".
 */
class Dependent extends BaseDependent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['age', 'borrower_id'], 'integer'],
            [['birthdate'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ]);
    }
    
    /**
     * This will calculate the age 
     * @param type $dob
     * @return int age
     */
    public function calculateAge($dob) {
        $birthdate = new \DateTime($dob);
        $dtoday = new \DateTime('today');
        $age = $birthdate->diff($dtoday)->y;
        return $age;
    }
	
}
