<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Borrower */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Borrower', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrower-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= 'Borrower'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            <?= Html::a('Save As New', ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
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