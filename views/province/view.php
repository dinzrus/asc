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
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-borrower']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Borrower'),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-municipality-city']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Municipality City'),
        ],
        'columns' => $gridColumnMunicipalityCity
    ]);
}
?>
    </div>
</div>