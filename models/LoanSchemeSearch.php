<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LoanScheme;

/**
 * LoanSchemeSearch represents the model behind the search form about `app\models\LoanScheme`.
 */
class LoanSchemeSearch extends LoanScheme
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loan_scheme_id', 'loanscheme_type', 'term', 'gross_day'], 'integer'],
            [['daily', 'gross_amount', 'interest', 'interest_amount', 'gas', 'doc_percentage', 'doc_stamp', 'mis_percentage', 'misc', 'admin_fee', 'notarial_fee', 'additional_fee', 'total_deductions', 'add_days', 'add_coll', 'net_proceeds', 'penalty', 'vat_interest', 'vat_amount', 'processing_fee'], 'number'],
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
        $query = LoanScheme::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'loan_scheme_id' => $this->loan_scheme_id,
            'loanscheme_type' => $this->loanscheme_type,
            'daily' => $this->daily,
            'term' => $this->term,
            'gross_day' => $this->gross_day,
            'gross_amount' => $this->gross_amount,
            'interest' => $this->interest,
            'interest_amount' => $this->interest_amount,
            'gas' => $this->gas,
            'doc_percentage' => $this->doc_percentage,
            'doc_stamp' => $this->doc_stamp,
            'mis_percentage' => $this->mis_percentage,
            'misc' => $this->misc,
            'admin_fee' => $this->admin_fee,
            'notarial_fee' => $this->notarial_fee,
            'additional_fee' => $this->additional_fee,
            'total_deductions' => $this->total_deductions,
            'add_days' => $this->add_days,
            'add_coll' => $this->add_coll,
            'net_proceeds' => $this->net_proceeds,
            'penalty' => $this->penalty,
            'vat_interest' => $this->vat_interest,
            'vat_amount' => $this->vat_amount,
            'processing_fee' => $this->processing_fee,
        ]);

        return $dataProvider;
    }
}
