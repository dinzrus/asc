<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Business */

?>
<div class="business-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'business_name',
        [
            'attribute' => 'businessType.id',
            'label' => 'Business Type',
        ],
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
        'address_st_bldng_no',
        'business_years',
        'permit_no',
        'average_weekly_income',
        'avergage_gross_daily_income',
        'ownership',
        [
            'attribute' => 'borrower.id',
            'label' => 'Borrower',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>