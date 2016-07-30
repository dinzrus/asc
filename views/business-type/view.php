<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\BusinessType */

$this->title = $model->business_id;
$this->params['breadcrumbs'][] = ['label' => 'Business Type', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-type-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Business Type'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->business_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->business_id], [
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
        'business_id',
        'business_description',
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
            'borrower_id',
            'borrower_pic',
            'first_name',
            'last_name',
            'middle_name',
            'name_suffix',
            'principal_birthdate',
            'principal_age',
            'birthplace',
            'address_streetname',
            'address_barangay',
            'address_province',
            'marriage_status',
            'contact_no',
                        'date_canvass',
            'date_ci',
            'co_fname',
            'co_lname',
            'co_middlename',
            'co_pic',
            'relation',
            'co_alias',
            'co_address',
            'co_contact_no',
            'branch',
            'spouse_age',
            'no_of_dependents',
            'business_address',
            'business_years',
            'chattel',
            'borrower_status',
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