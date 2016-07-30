<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LoanScheme]].
 *
 * @see LoanScheme
 */
class LoanSchemeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return LoanScheme[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LoanScheme|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}