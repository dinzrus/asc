<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\LoanschemeType */

$this->title = $model->loanscheme_type_id;
$this->params['breadcrumbs'][] = ['label' => 'Loanscheme Type', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loanscheme-type-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Loanscheme Type'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model->loanscheme_type_id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            
            <?= Html::a('Update', ['update', 'id' => $model->loanscheme_type_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->loanscheme_type_id], [
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
        'loanscheme_type_id',
        'type_description',
        'created_date',
        'updated_date',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerLoanScheme->totalCount){
    $gridColumnLoanScheme = [
        ['class' => 'yii\grid\SerialColumn'],
            'loan_scheme_id',
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
    echo Gridview::widget([
        'dataProvider' => $providerLoanScheme,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-loan-scheme']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Loan Scheme'),
        ],
        'columns' => $gridColumnLoanScheme
    ]);
}
?>
    </div>
</div>