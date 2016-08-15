<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $borrower app\models\Borrower */

$this->title = $borrower->id;
$this->params['breadcrumbs'][] = ['label' => 'Borrower', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrower-view">
    <div class="row">
        <div class="col-sm-8">
            <h2><?= 'Borrower' . ' ' . Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
            <?=
            Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', ['pdf', 'id' => $borrower->id], [
                'class' => 'btn btn-danger',
                'target' => '_blank',
                'data-toggle' => 'tooltip',
                'title' => 'Will open the generated PDF file in a new window'
                    ]
            )
            ?>
            <?= Html::a('Save As New', ['save-as-new', 'id' => $borrower->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a('Update', ['update', 'id' => $borrower->id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $borrower->id], [
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
        <div class="row">
            <div class="col-md-3">
                <center>
                    <?= Html::img($borrower->profile_pic, ['width' => 200, 'class' => 'img-thumbnail']) ?>
                </center>
            </div>
            <div class="col-md-4">
                <?php
                $gridColumn = [
                    //['attribute' => 'id', 'hidden' => true],
                    'first_name',
                    'last_name',
                    'middle_name',
                    'suffix',
                    'birthdate',
                    'age',
                    'birthplace',
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
                    'address_street_house_no',
                    'civil_status',
                    'contact_no',
                ];
                echo DetailView::widget([
                    'model' => $borrower,
                    'attributes' => $gridColumn
                ]);
                ?>
            </div>
            <div class="col-md-4">
                <?php
                $gridColumn = [
                    'tin_no',
                    'sss_no',
                    'ctc_no',
                    'license_no',
                    'spouse_name',
                    'spouse_occupation',
                    'spouse_age',
                    'spouse_birthdate',
                    'collaterals:ntext',
                    'ci_date',
                    'canvass_date',
                    [
                        'attribute' => 'status0.status',
                        'label' => 'Status',
                    ],
                    'branch_id',
                ];
                echo DetailView::widget([
                    'model' => $borrower,
                    'attributes' => $gridColumn
                ]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-8">
                <?php
                $gridColumn = [
                    'no_dependent',
                ];
                echo DetailView::widget([
                    'model' => $borrower,
                    'attributes' => $gridColumn
                ]);
                ?>
            </div>
        </div>
    </div>
</div>