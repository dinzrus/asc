<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Employee'.' '. Html::encode($this->title) ?></h2>
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
        'first_name',
        'last_name',
        'middle_name',
        'date_birth',
        'age',
        'gender',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerEmposition->totalCount){
    $gridColumnEmposition = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'branch.branch_id',
                'label' => 'Branch'
            ],
            [
                'attribute' => 'position.position',
                'label' => 'Position'
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEmposition,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-emposition']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Emposition'),
        ],
        'export' => false,
        'columns' => $gridColumnEmposition
    ]);
}
?>
    </div>
</div>
