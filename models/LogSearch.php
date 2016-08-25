<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Log;

/**
 * app\models\LogSearch represents the model behind the search form about `app\models\Log`.
 */
 class LogSearch extends Log
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'branch_id'], 'integer'],
            [['log_type', 'log_description', 'log_date'], 'safe'],
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
        $query = Log::find();

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
            'log_type' => $this->log_type,
            'log_date' => $this->log_date,
            'user_id' => $this->user_id,
            'branch_id' => $this->branch_id,
        ]);

        $query->andFilterWhere(['like', 'log_description', $this->log_description]);

        return $dataProvider;
    }
}
