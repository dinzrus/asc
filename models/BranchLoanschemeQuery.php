<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BranchLoanscheme]].
 *
 * @see BranchLoanscheme
 */
class BranchLoanschemeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return BranchLoanscheme[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BranchLoanscheme|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}