<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\MunicipalityCity */

$this->title = $model->municipality_city;
$this->params['breadcrumbs'][] = ['label' => 'Municipality City', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="municipality-city-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Municipality City'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
                'municipality_city',
        [
                'attribute' => 'province.province',
                'label' => 'Province'
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerBarangay->totalCount){
    $gridColumnBarangay = [
        ['class' => 'yii\grid\SerialColumn'],
                'barangay',
            ];
    echo Gridview::widget([
        'dataProvider' => $providerBarangay,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Barangay'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnBarangay
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerBorrower->totalCount){
    $gridColumnBorrower = [
        ['class' => 'yii\grid\SerialColumn'],
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
                'label' => 'Address Province'
            ],
                [
                'attribute' => 'addressBarangay.barangay',
                'label' => 'Address Barangay'
            ],
        'address_street_house_no',
        'civil_status',
        'contact_no',
        'ci_date',
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
                'label' => 'Status'
            ],
        'branch_id',
        'attachment:ntext',
        'relation_to_applicant',
        'acount_type',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerBorrower,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Borrower'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnBorrower
    ]);
}
?>
    </div>
</div>
