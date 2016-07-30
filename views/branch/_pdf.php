<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Branch */

$this->title = $model->branch_id;
$this->params['breadcrumbs'][] = ['label' => 'Branch', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branch-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Branch'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'branch_id',
        'branch_description',
        'address',
        'telephone_no',
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
                'attribute' => 'loanscheme0.loan_scheme_id',
                'label' => 'Loanscheme'
            ],
                'date_created',
        'date_updated',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerBranchLoanscheme,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Branch Loanscheme'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnBranchLoanscheme
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerUnit->totalCount){
    $gridColumnUnit = [
        ['class' => 'yii\grid\SerialColumn'],
        'unit_id',
        'unit_description',
            ];
    echo Gridview::widget([
        'dataProvider' => $providerUnit,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Unit'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnUnit
    ]);
}
?>
    </div>
</div>
