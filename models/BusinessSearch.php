<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Business;

/**
 * app\models\BusinessSearch represents the model behind the search form about `app\models\Business`.
 */
 class BusinessSearch extends Business
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'business_type_id', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'business_years', 'borrower_id'], 'integer'],
            [['business_name', 'address_st_bldng_no', 'permit_no', 'ownership'], 'safe'],
            [['average_weekly_income', 'average_gross_daily_income'], 'number'],
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
        $query = Business::find();

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
            'business_type_id' => $this->business_type_id,
            'address_province_id' => $this->address_province_id,
            'address_city_municipality_id' => $this->address_city_municipality_id,
            'address_barangay_id' => $this->address_barangay_id,
            'business_years' => $this->business_years,
            'average_weekly_income' => $this->average_weekly_income,
            'average_gross_daily_income' => $this->average_gross_daily_income,
            'borrower_id' => $this->borrower_id,
        ]);

        $query->andFilterWhere(['like', 'business_name', $this->business_name])
            ->andFilterWhere(['like', 'address_st_bldng_no', $this->address_st_bldng_no])
            ->andFilterWhere(['like', 'permit_no', $this->permit_no])
            ->andFilterWhere(['like', 'ownership', $this->ownership]);

        return $dataProvider;
    }
}
