<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Borrower]].
 *
 * @see Borrower
 */
class BorrowerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Borrower[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Borrower|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}