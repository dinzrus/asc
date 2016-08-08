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
        'municipality_city',
        [
            'attribute' => 'province.province',
            'label' => 'Province',
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-barangay']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Barangay'),
        ],
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
</div>