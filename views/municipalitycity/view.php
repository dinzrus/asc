<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\MunicipalityCity */

$this->title = $model->municipality_city;
$this->params['breadcrumbs'][] = ['label' => 'Municipality City', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-solid">
    <div class="box-body">
        <div class="municipality-city-view">

            <div class="row">
                <div class="col-sm-9">
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
            <br>

            <?php
            $gridColumn = [
                ['attribute' => 'id', 'visible' => false],
                'municipality_city',
                [
                    'attribute' => 'province.province',
                    'label' => 'Province',
                ],
            ];
            echo DetailView::widget([
                'model' => $model,
                'attributes' => $gridColumn
            ]);
            ?>


            <?php
            if ($providerBarangay->totalCount) {
                $gridColumnBarangay = [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['attribute' => 'id', 'visible' => false],
                    'barangay',
                ];
                echo Gridview::widget([
                    'dataProvider' => $providerBarangay,
                    'pjax' => true,
                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-barangay']],
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Barangay'),
                    ],
                    'export' => false,
                    'columns' => $gridColumnBarangay
                ]);
            }
            ?>
        </div>
    </div>
</div>
