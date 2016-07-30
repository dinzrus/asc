<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\LoanType */

$this->title = $model->loan_id;
$this->params['breadcrumbs'][] = ['label' => 'Loan Type', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-type-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Loan Type'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model->loan_id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            
            <?= Html::a('Update', ['update', 'id' => $model->loan_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->loan_id], [
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
        'loan_id',
        'loan_description',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerLoan->totalCount){
    $gridColumnLoan = [
        ['class' => 'yii\grid\SerialColumn'],
            'loan_id',
            'loan_no',
                        'borrower',
            [
                'attribute' => 'unit0.unit_id',
                'label' => 'Unit'
            ],
            'release_date',
            'maturity_date',
            'daily',
            'term',
            'gross_amount',
            'interest_bdays',
            'gas',
            'doc_stamp',
            'misc',
            'admin_fee',
            'notarial_fee',
            'additional_fee',
            'total_deductions',
            'add_days',
            'add_coll',
            'net_proceeds',
            'penalty',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerLoan,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-loan']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Loan'),
        ],
        'columns' => $gridColumnLoan
    ]);
}
?>
    </div>
</div>