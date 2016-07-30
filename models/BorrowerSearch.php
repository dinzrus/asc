<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Borrower;

/**
 * app\models\BorrowerSearch represents the model behind the search form about `app\models\Borrower`.
 */
 class BorrowerSearch extends Borrower
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['borrower_id', 'principal_age', 'principal_spouse_age', 'principal_no_children', 'principal_child1_age', 'principal_child2_age', 'comaker_age', 'business_type', 'business_years', 'status', 'branch'], 'integer'],
            [['principal_profile_pic', 'principal_first_name', 'principal_last_name', 'principal_middle_name', 'principal__suffix', 'principal_birthdate', 'principal_birthplace', 'principal_address_street_house', 'principal_address_barangay', 'principal_address_province', 'principal_civil_status', 'principal_contact_no', 'principal_ci_date', 'principal_canvass_date', 'principal_tin_no', 'principal_sss_no', 'principal_ctc_no', 'principal_license_no', 'principal_spouse_name', 'principal_spouse_occupation', 'principal_spouse_birthdate', 'principal_child1_name', 'principal_child2_name', 'principal_child1_birthdate', 'principal_child2_birthdate', 'comaker_profile_pic', 'comaker_name', 'comaker_address', 'comaker_alias', 'comaker_contact', 'comaker_occupation', 'comaker_birthdate', 'comaker_relation', 'business_name', 'business_address', 'collaterals'], 'safe'],
            [['business_income'], 'number'],
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
        $query = Borrower::find();

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
            'borrower_id' => $this->borrower_id,
            'principal_birthdate' => $this->principal_birthdate,
            'principal_age' => $this->principal_age,
            'principal_ci_date' => $this->principal_ci_date,
            'principal_canvass_date' => $this->principal_canvass_date,
            'principal_spouse_age' => $this->principal_spouse_age,
            'principal_spouse_birthdate' => $this->principal_spouse_birthdate,
            'principal_no_children' => $this->principal_no_children,
            'principal_child1_birthdate' => $this->principal_child1_birthdate,
            'principal_child2_birthdate' => $this->principal_child2_birthdate,
            'principal_child1_age' => $this->principal_child1_age,
            'principal_child2_age' => $this->principal_child2_age,
            'comaker_birthdate' => $this->comaker_birthdate,
            'comaker_age' => $this->comaker_age,
            'business_type' => $this->business_type,
            'business_years' => $this->business_years,
            'business_income' => $this->business_income,
            'status' => $this->status,
            'branch' => $this->branch,
        ]);

        $query->andFilterWhere(['like', 'principal_profile_pic', $this->principal_profile_pic])
            ->andFilterWhere(['like', 'principal_first_name', $this->principal_first_name])
            ->andFilterWhere(['like', 'principal_last_name', $this->principal_last_name])
            ->andFilterWhere(['like', 'principal_middle_name', $this->principal_middle_name])
            ->andFilterWhere(['like', 'principal__suffix', $this->principal__suffix])
            ->andFilterWhere(['like', 'principal_birthplace', $this->principal_birthplace])
            ->andFilterWhere(['like', 'principal_address_street_house', $this->principal_address_street_house])
            ->andFilterWhere(['like', 'principal_address_barangay', $this->principal_address_barangay])
            ->andFilterWhere(['like', 'principal_address_province', $this->principal_address_province])
            ->andFilterWhere(['like', 'principal_civil_status', $this->principal_civil_status])
            ->andFilterWhere(['like', 'principal_contact_no', $this->principal_contact_no])
            ->andFilterWhere(['like', 'principal_tin_no', $this->principal_tin_no])
            ->andFilterWhere(['like', 'principal_sss_no', $this->principal_sss_no])
            ->andFilterWhere(['like', 'principal_ctc_no', $this->principal_ctc_no])
            ->andFilterWhere(['like', 'principal_license_no', $this->principal_license_no])
            ->andFilterWhere(['like', 'principal_spouse_name', $this->principal_spouse_name])
            ->andFilterWhere(['like', 'principal_spouse_occupation', $this->principal_spouse_occupation])
            ->andFilterWhere(['like', 'principal_child1_name', $this->principal_child1_name])
            ->andFilterWhere(['like', 'principal_child2_name', $this->principal_child2_name])
            ->andFilterWhere(['like', 'comaker_profile_pic', $this->comaker_profile_pic])
            ->andFilterWhere(['like', 'comaker_name', $this->comaker_name])
            ->andFilterWhere(['like', 'comaker_address', $this->comaker_address])
            ->andFilterWhere(['like', 'comaker_alias', $this->comaker_alias])
            ->andFilterWhere(['like', 'comaker_contact', $this->comaker_contact])
            ->andFilterWhere(['like', 'comaker_occupation', $this->comaker_occupation])
            ->andFilterWhere(['like', 'comaker_relation', $this->comaker_relation])
            ->andFilterWhere(['like', 'business_name', $this->business_name])
            ->andFilterWhere(['like', 'business_address', $this->business_address])
            ->andFilterWhere(['like', 'collaterals', $this->collaterals]);

        return $dataProvider;
    }
}
