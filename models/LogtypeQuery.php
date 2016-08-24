<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Logtype]].
 *
 * @see Logtype
 */
class LogtypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Logtype[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Logtype|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}