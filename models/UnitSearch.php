<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class UnitSearch extends Unit
{
    public function rules()
    { 
        // only fields in rules() are searchable
        return [
            [['branch_id', 'unit_id'], 'integer'],
            [['unit_description', 'branch_id'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Unit::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['branch_id' => $this->grid_unitcollection_id]);

        return $dataProvider;
    }
}