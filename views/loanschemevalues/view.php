<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\LoanschemeValues */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Loanscheme Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loanscheme-values-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Loanscheme Values'.' '. Html::encode($this->title) ?></h2>
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
        [
            'attribute' => 'loanscheme.id',
            'label' => 'Loanscheme',
        ],
        'daily',
        'term',
        'gross_amt',
        'interest',
        'vat',
        'admin_fee',
        'notary_fee',
        'misc',
        'doc_stamp',
        'gas',
        'total_deductions',
        'add_days',
        'add_coll',
        'net_proceeds',
        'penalty',
        'pen_days',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
