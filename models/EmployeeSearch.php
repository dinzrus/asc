<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Employee;

/**
 * app\models\EmployeeSearch represents the model behind the search form about `app\models\Employee`.
 */
 class EmployeeSearch extends Employee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id'], 'integer'],
            [['firstname', 'lastname', 'middlename', 'birth_date', 'gender', 'civil_status', 'home_address', 'sss_no', 'philhealth_no', 'tin_no', 'profile_pic', 'contact_no'], 'safe'],
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
        $query = Employee::find();

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
            'employee_id' => $this->employee_id,
            'birth_date' => $this->birth_date,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'middlename', $this->middlename])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'civil_status', $this->civil_status])
            ->andFilterWhere(['like', 'home_address', $this->home_address])
            ->andFilterWhere(['like', 'sss_no', $this->sss_no])
            ->andFilterWhere(['like', 'philhealth_no', $this->philhealth_no])
            ->andFilterWhere(['like', 'tin_no', $this->tin_no])
            ->andFilterWhere(['like', 'profile_pic', $this->profile_pic])
            ->andFilterWhere(['like', 'contact_no', $this->contact_no]);

        return $dataProvider;
    }
}
