<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Barangay]].
 *
 * @see Barangay
 */
class BarangayQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Barangay[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Barangay|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}