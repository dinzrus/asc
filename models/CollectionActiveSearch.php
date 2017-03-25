<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Borrower;

/**
 * app\models\BorrowerSearch represents the model behind the search form about `app\models\Borrower`.
 */
class CollectionActiveSearch extends Borrower {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'age', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'spouse_age', 'no_dependent', 'branch_id'], 'integer'],
            [['first_name', 'last_name', 'middle_name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
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
            'branch_id' => (strtoupper(Yii::$app->user->identity->branch->branch_description) === "MAIN") ? $this->branch_id : Yii::$app->user->identity->branch_id
                //'status' => 'AR',
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name]);
        $query->andFilterWhere(['like', 'last_name', $this->last_name]);
        $query->andFilterWhere(['like', 'middle_name', $this->middle_name]);

        return $dataProvider;
    }

}
