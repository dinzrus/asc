<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Province */

$this->title = $model->province;
$this->params['breadcrumbs'][] = ['label' => 'Province', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="province-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Province'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
                'province',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
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
                'attribute' => 'addressCityMunicipality.municipality_city',
                'label' => 'Address City Municipality'
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
    
    <div class="row">
<?php
if($providerMunicipalityCity->totalCount){
    $gridColumnMunicipalityCity = [
        ['class' => 'yii\grid\SerialColumn'],
                'municipality_city',
            ];
    echo Gridview::widget([
        'dataProvider' => $providerMunicipalityCity,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Municipality City'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnMunicipalityCity
    ]);
}
?>
    </div>
</div>
