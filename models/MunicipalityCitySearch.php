<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MunicipalityCity;

/**
 * app\models\MunicipalityCitySearch represents the model behind the search form about `app\models\MunicipalityCity`.
 */
 class MunicipalityCitySearch extends MunicipalityCity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'province_id'], 'integer'],
            [['municipality_city'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MunicipalityCity::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'province_id' => $this->province_id,
        ]);

        $query->andFilterWhere(['like', 'municipality_city', $this->municipality_city]);

        return $dataProvider;
    }
}
