<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LoanschemeType]].
 *
 * @see LoanschemeType
 */
class LoanschemeTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return LoanschemeType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LoanschemeType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}