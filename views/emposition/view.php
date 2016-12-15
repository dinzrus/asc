<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Emposition */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Emposition', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emposition-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Emposition'.' '. Html::encode($this->title) ?></h2>
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
            'attribute' => 'employee.id',
            'label' => 'Employee',
        ],
        'branch_id',
        [
            'attribute' => 'position.position',
            'label' => 'Position',
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
if($providerCollectorunit->totalCount){
    $gridColumnCollectorunit = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'unit.unit_id',
                'label' => 'Unit'
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerCollectorunit,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-collectorunit']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Collectorunit'),
        ],
        'export' => false,
        'columns' => $gridColumnCollectorunit
    ]);
}
?>
    </div>
</div>
