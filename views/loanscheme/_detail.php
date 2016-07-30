<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\LoanScheme */

?>
<div class="loan-scheme-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->loan_scheme_id) ?></h2>
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
</div>