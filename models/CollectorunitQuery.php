<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Collectorunit]].
 *
 * @see Collectorunit
 */
class CollectorunitQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Collectorunit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Collectorunit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}