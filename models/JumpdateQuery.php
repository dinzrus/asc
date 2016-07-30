<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Jumpdate]].
 *
 * @see Jumpdate
 */
class JumpdateQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Jumpdate[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Jumpdate|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}