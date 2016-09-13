<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Province */

$this->title = $model->province;
$this->params['breadcrumbs'][] = ['label' => 'Province', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-solid">
    <div class="box-body">
        <div class="province-view">

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
                    'province',
                ];
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => $gridColumn
                ]);
                ?>

                <?php
                if ($providerMunicipalityCity->totalCount) {
                    $gridColumnMunicipalityCity = [
                        ['class' => 'yii\grid\SerialColumn'],
                        ['attribute' => 'id', 'visible' => false],
                        'municipality_city',
                    ];
                    echo Gridview::widget([
                        'dataProvider' => $providerMunicipalityCity,
                        'pjax' => true,
                        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-municipality-city']],
                        'panel' => [
                            'type' => GridView::TYPE_PRIMARY,
                            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Municipality City'),
                        ],
                        'export' => false,
                        'columns' => $gridColumnMunicipalityCity
                    ]);
                }
                ?>

        </div>
    </div>
</div>
