<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Loanscheme]].
 *
 * @see Loanscheme
 */
class LoanschemeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Loanscheme[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Loanscheme|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}