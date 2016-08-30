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
            [['id', 'age', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'spouse_age', 'no_dependent', 'branch_id'], 'integer'],
            [['profile_pic', 'first_name', 'last_name', 'middle_name', 'birthdate', 'birthplace', 'address_street_house_no', 'civil_status', 'contact_no', 'ci_date', 'canvass_date', 'tin_no', 'sss_no', 'ctc_no', 'license_no', 'spouse_name', 'spouse_occupation', 'spouse_birthdate', 'collaterals', 'status', 'attachment', 'acount_type'], 'safe'],
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
            'id' => $this->id,
            'birthdate' => $this->birthdate,
            'age' => $this->age,
            'address_province_id' => $this->address_province_id,
            'address_city_municipality_id' => $this->address_city_municipality_id,
            'address_barangay_id' => $this->address_barangay_id,
            'ci_date' => $this->ci_date,
            'canvass_date' => $this->canvass_date,
            'spouse_age' => $this->spouse_age,
            'spouse_birthdate' => $this->spouse_birthdate,
            'no_dependent' => $this->no_dependent,
            'branch_id' => (strtoupper(Yii::$app->user->identity->branch->branch_description) === "MAIN")? $this->branch_id : Yii::$app->user->identity->branch_id,
            'status' => 'A',
            'acount_type' => 'B', // so that borrowers will only display in the table
        ]);

        $query->andFilterWhere(['like', 'profile_pic', $this->profile_pic])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'birthplace', $this->birthplace])
            ->andFilterWhere(['like', 'address_street_house_no', $this->address_street_house_no])
            ->andFilterWhere(['like', 'civil_status', $this->civil_status])
            ->andFilterWhere(['like', 'contact_no', $this->contact_no])
            ->andFilterWhere(['like', 'tin_no', $this->tin_no])
            ->andFilterWhere(['like', 'sss_no', $this->sss_no])
            ->andFilterWhere(['like', 'ctc_no', $this->ctc_no])
            ->andFilterWhere(['like', 'license_no', $this->license_no])
            ->andFilterWhere(['like', 'spouse_name', $this->spouse_name])
            ->andFilterWhere(['like', 'spouse_occupation', $this->spouse_occupation])
            ->andFilterWhere(['like', 'collaterals', $this->collaterals])
            ->andFilterWhere(['like', 'attachment', $this->attachment]);
            //->andFilterWhere(['like', 'acount_type', $this->acount_type]);

        return $dataProvider;
    }
}
