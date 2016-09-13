<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Business */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Business', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-solid">
    <div class="box-body">
        <div class="business-view">

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
                    'business_name',
                    [
                        'attribute' => 'businessType.id',
                        'label' => 'Business Type',
                    ],
                    [
                        'attribute' => 'addressProvince.province',
                        'label' => 'Address Province',
                    ],
                    [
                        'attribute' => 'addressCityMunicipality.municipality_city',
                        'label' => 'Address City Municipality',
                    ],
                    [
                        'attribute' => 'addressBarangay.barangay',
                        'label' => 'Address Barangay',
                    ],
                    'address_st_bldng_no',
                    'permit_no',
                    'average_weekly_income',
                    'average_gross_daily_income',
                    'ownership',
                    'borrower_id',
                ];
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => $gridColumn
                ]);
                ?>
        </div>
    </div>
</div>
