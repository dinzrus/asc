<?php

use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'Borrowers Collection';

$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<div class="panel panel-default">
    <div class="panel-body">
        <?=
        GridView::widget([
            'dataProvider' => $unitProvider,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn'
                ],
                'unit_description',
                [
                    'label' => 'Completed',
                    'format' => 'html',
                    'value' => function() {
                        return '50%';
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{encodecollection}',
                    'buttons' => [
                        'encodecollection' => function ($url, $unitProvider) {
                            return Html::a('<i class="fa fa-money"></i> Encode', $url, ['class' => 'btn btn-success btn-xs']);
                        }
                    ],
                ],
            ]
        ]);
        ?>
    </div>
</div>



