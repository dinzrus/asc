<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Comaker]].
 *
 * @see Comaker
 */
class ComakerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Comaker[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Comaker|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}