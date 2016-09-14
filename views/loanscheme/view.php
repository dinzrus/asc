<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Loanscheme */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Loanscheme', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-solid">
    <div class="box-body">
        <div class="loanscheme-view">

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
                'loanscheme_name',
            ];
            echo DetailView::widget([
                'model' => $model,
                'attributes' => $gridColumn
            ]);
            ?>


            <?php
            if ($providerLoanschemeAssignment->totalCount) {
                $gridColumnLoanschemeAssignment = [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['attribute' => 'id', 'visible' => false],
                    [
                        'attribute' => 'branch.branch_description',
                        'label' => 'Branch'
                    ],
                ];
                echo Gridview::widget([
                    'dataProvider' => $providerLoanschemeAssignment,
                    'pjax' => true,
                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-loanscheme-assignment']],
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Loanscheme Assignment'),
                    ],
                    'export' => false,
                    'columns' => $gridColumnLoanschemeAssignment
                ]);
            }
            ?>

            <?php
            if ($providerLoanschemeValues->totalCount) {
                $gridColumnLoanschemeValues = [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['attribute' => 'id', 'visible' => false],
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
                echo Gridview::widget([
                    'dataProvider' => $providerLoanschemeValues,
                    'pjax' => true,
                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-loanscheme-values']],
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Loanscheme Values'),
                    ],
                    'export' => false,
                    'columns' => $gridColumnLoanschemeValues
                ]);
            }
            ?>
        </div>
    </div>
</div>
