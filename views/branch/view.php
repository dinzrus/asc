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
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->branch_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->branch_id], [
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-unit']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Unit'),
        ],
        'columns' => $gridColumnUnit
    ]);
}
?>
    </div>
</div>