<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Ci]].
 *
 * @see Ci
 */
class CiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Ci[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Ci|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}