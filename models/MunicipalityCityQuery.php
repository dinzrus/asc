<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MunicipalityCity]].
 *
 * @see MunicipalityCity
 */
class MunicipalityCityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return MunicipalityCity[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MunicipalityCity|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}