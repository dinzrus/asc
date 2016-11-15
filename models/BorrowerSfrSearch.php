<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Borrower;

/**
 * app\models\BorrowerSearch represents the model behind the search form about `app\models\Borrower`.
 */
class BorrowerSfrSearch extends Borrower {

    public $keyword;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['id', 'age', 'address_province_id', 'address_city_municipality_id', 'address_barangay_id', 'spouse_age', 'no_dependent', 'branch_id'], 'integer'],
                [['profile_pic', 'keyword', 'first_name', 'last_name', 'middle_name', 'birthdate', 'birthplace', 'address_street_house_no', 'civil_status', 'contact_no', 'canvass_date', 'tin_no', 'sss_no', 'ctc_no', 'license_no', 'spouse_name', 'spouse_occupation', 'spouse_birthdate', 'status', 'attachment', 'acount_type'], 'safe'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'profile_pic' => 'Profile Pic',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
            'suffix' => 'Suffix',
            'birthdate' => 'Birthdate',
            'age' => 'Age',
            'birthplace' => 'Birthplace',
            'address_province_id' => 'Province',
            'address_city_municipality_id' => 'City/Municipality',
            'address_barangay_id' => 'Barangay',
            'address_street_house_no' => 'Street/House No.',
            'civil_status' => 'Civil Status',
            'contact_no' => 'Contact No',
            'canvass_date' => 'Canvass Date',
            'tin_no' => 'TIN No',
            'sss_no' => 'SSS No',
            'ctc_no' => 'CTC No',
            'license_no' => 'License No',
            'spouse_name' => 'Spouse Name',
            'spouse_occupation' => 'Spouse Occupation',
            'spouse_age' => 'Spouse Age',
            'spouse_birthdate' => 'Spouse Date of Birth',
            'no_dependent' => 'No Dependent',
            'status' => 'Status',
            'branch_id' => 'Branch',
            'attachment' => 'Attachment',
            'gender' => 'Gender',
            'acount_type' => 'Acount Type',
            'borrower_pic' => '',
            'canvass_by' => 'Canvasser',
            'keyword' => 'Search (Lastname)',
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
            'branch_id' => (strtoupper(Yii::$app->user->identity->branch->branch_description) === "MAIN") ? $this->branch_id : Yii::$app->user->identity->branch_id,
        ]);

        $query->andFilterWhere(['like', 'last_name', $this->keyword]);

        return $dataProvider;
    }

}
