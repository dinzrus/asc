<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\LoanScheme */

$this->title = $model->loan_scheme_id;
$this->params['breadcrumbs'][] = ['label' => 'Loan Scheme', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-scheme-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Loan Scheme'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model->loan_scheme_id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            
            <?= Html::a('Update', ['update', 'id' => $model->loan_scheme_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->loan_scheme_id], [
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
        'loan_scheme_id',
        [
            'attribute' => 'loanschemeType.loanscheme_type_id',
            'label' => 'Loanscheme Type',
        ],
        'daily',
        'term',
        'gross_day',
        'gross_amount',
        'interest',
        'interest_amount',
        'gas',
        'doc_percentage',
        'doc_stamp',
        'mis_percentage',
        'misc',
        'admin_fee',
        'notarial_fee',
        'additional_fee',
        'total_deductions',
        'add_days',
        'add_coll',
        'net_proceeds',
        'penalty',
        'vat_interest',
        'vat_amount',
        'processing_fee',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerBranchLoanscheme->totalCount){
    $gridColumnBranchLoanscheme = [
        ['class' => 'yii\grid\SerialColumn'],
            'branch_loanscheme_id',
                        [
                'attribute' => 'branch0.branch_id',
                'label' => 'Branch'
            ],
            'date_created',
            'date_updated',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerBranchLoanscheme,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-branch-loanscheme']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Branch Loanscheme'),
        ],
        'columns' => $gridColumnBranchLoanscheme
    ]);
}
?>
    </div>
</div>