<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Borrower */

?>
<div class="borrower-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'profile_pic',
        'first_name',
        'last_name',
        'middle_name',
        'suffix',
        'birthdate',
        'age',
        'birthplace',
        [
            'attribute' => 'addressProvince.province',
            'label' => 'Address Province',
        ],
        [
            'attribute' => 'addressCityMunicipality.municipality_city',
            'label' => 'Address City Municipality',
        ],
        [
            'attribute' => 'addressBarangay.barangay',
            'label' => 'Address Barangay',
        ],
        'address_street_house_no',
        'civil_status',
        'contact_no',
        'canvass_date',
        'tin_no',
        'sss_no',
        'ctc_no',
        'license_no',
        'spouse_name',
        'spouse_occupation',
        'spouse_age',
        'spouse_birthdate',
        'no_dependent',
        'collaterals:ntext',
        [
            'attribute' => 'status0.status',
            'label' => 'Status',
        ],
        'branch_id',
        'attachment:ntext',
        'relation_to_applicant',
        'acount_type',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>