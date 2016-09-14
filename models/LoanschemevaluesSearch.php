<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LoanschemeValues;

/**
 * app\models\LoanschemevaluesSearch represents the model behind the search form about `app\models\LoanschemeValues`.
 */
 class LoanschemevaluesSearch extends LoanschemeValues
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'loanscheme_id', 'term', 'add_days', 'pen_days'], 'integer'],
            [['daily', 'gross_amt', 'interest', 'vat', 'admin_fee', 'notary_fee', 'misc', 'doc_stamp', 'gas', 'total_deductions', 'add_coll', 'net_proceeds', 'penalty'], 'number'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
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
        $query = LoanschemeValues::find();

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
            'loanscheme_id' => $this->loanscheme_id,
            'daily' => $this->daily,
            'term' => $this->term,
            'gross_amt' => $this->gross_amt,
            'interest' => $this->interest,
            'vat' => $this->vat,
            'admin_fee' => $this->admin_fee,
            'notary_fee' => $this->notary_fee,
            'misc' => $this->misc,
            'doc_stamp' => $this->doc_stamp,
            'gas' => $this->gas,
            'total_deductions' => $this->total_deductions,
            'add_days' => $this->add_days,
            'add_coll' => $this->add_coll,
            'net_proceeds' => $this->net_proceeds,
            'penalty' => $this->penalty,
            'pen_days' => $this->pen_days,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
