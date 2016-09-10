<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Barangay */

$this->title = $model->barangay;
$this->params['breadcrumbs'][] = ['label' => 'Barangay', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barangay-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Barangay'.' '. Html::encode($this->title) ?></h2>
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
        ['attribute' => 'id', 'visible' => false],
        'barangay',
        [
            'attribute' => 'municipalityCity.municipality_city',
            'label' => 'Municipality City',
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
if($providerBorrower->totalCount){
    $gridColumnBorrower = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
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
                'attribute' => 'addressCityMunicipality.municipality_city',
                'label' => 'Address City Municipality'
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
            'status',
            'branch_id',
            'attachment:ntext',
            'acount_type',
            'gender',
            'mother_name',
            'mother_age',
            'mother_birthdate',
            'father_name',
            'father_age',
            'father_birthdate',
            'canvass_by',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerBorrower,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-borrower']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Borrower'),
        ],
        'export' => false,
        'columns' => $gridColumnBorrower
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerBusiness->totalCount){
    $gridColumnBusiness = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'business_name',
            [
                'attribute' => 'businessType.id',
                'label' => 'Business Type'
            ],
            [
                'attribute' => 'addressProvince.province',
                'label' => 'Address Province'
            ],
            [
                'attribute' => 'addressCityMunicipality.municipality_city',
                'label' => 'Address City Municipality'
            ],
                        'address_st_bldng_no',
            'business_years',
            'permit_no',
            'average_weekly_income',
            'average_gross_daily_income',
            'ownership',
            'borrower_id',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerBusiness,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-business']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Business'),
        ],
        'export' => false,
        'columns' => $gridColumnBusiness
    ]);
}
?>
    </div>
</div>
