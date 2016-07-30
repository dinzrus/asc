<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MarriageStatus]].
 *
 * @see MarriageStatus
 */
class MarriageStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return MarriageStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MarriageStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}