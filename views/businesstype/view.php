<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\BusinessType */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Business Type', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-solid">
    <div class="box-body">
        <div class="business-type-view">
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
                'business_description',
            ];
            echo DetailView::widget([
                'model' => $model,
                'attributes' => $gridColumn
            ]);
            ?>
            <?php
            if ($providerBusiness->totalCount) {
                $gridColumnBusiness = [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['attribute' => 'id', 'visible' => false],
                    'business_name',
                    [
                        'attribute' => 'addressProvince.province',
                        'label' => 'Address Province'
                    ],
                    [
                        'attribute' => 'addressCityMunicipality.municipality_city',
                        'label' => 'Address City Municipality'
                    ],
                    [
                        'attribute' => 'addressBarangay.barangay',
                        'label' => 'Address Barangay'
                    ],
                    'address_st_bldng_no',
                ];
                echo Gridview::widget([
                    'dataProvider' => $providerBusiness,
                    'pjax' => true,
                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-business']],
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Business'),
                    ],
                    'columns' => $gridColumnBusiness
                ]);
            }
            ?>

        </div>

    </div>
</div>