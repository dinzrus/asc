<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Emposition]].
 *
 * @see Emposition
 */
class EmpositionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Emposition[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Emposition|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}