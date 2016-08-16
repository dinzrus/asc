<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BorrowerComaker]].
 *
 * @see BorrowerComaker
 */
class BorrowerComakerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return BorrowerComaker[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BorrowerComaker|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}