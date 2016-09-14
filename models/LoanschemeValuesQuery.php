<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LoanschemeValues]].
 *
 * @see LoanschemeValues
 */
class LoanschemeValuesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return LoanschemeValues[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LoanschemeValues|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}