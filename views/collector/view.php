<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Collector */

$this->title = $model->lname;
$this->params['breadcrumbs'][] = ['label' => 'Collector', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-solid">
    <div class="box-body">
        <div class="collector-view">

            <div class="row">
                <div class="col-sm-9">
                    <h2><?= 'Collector' . ' ' . Html::encode($this->title) ?></h2>
                </div>
                <div class="col-sm-3" style="margin-top: 15px">

                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?=
                    Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
                </div>
            </div>
                <?php
                $gridColumn = [
                        ['attribute' => 'id', 'visible' => false],
                    'fname',
                    'lname',
                    'middlename',
                    'birthdate',
                    'age',
                    'gender',
                        [
                        'attribute' => 'branch.branch_id',
                        'label' => 'Branch',
                    ],
                        [
                        'attribute' => 'unit.unit_id',
                        'label' => 'Unit',
                    ],
                ];
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => $gridColumn
                ]);
                ?>
        </div>
    </div>
</div>

