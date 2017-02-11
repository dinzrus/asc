<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'C.I. Canvass Approval';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-body">
        <?=
        GridView::widget([
            'dataProvider' => $borrowerProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'last_name',
                'first_name',
                'middle_name',
                'canvass_date:date',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{approve}',
                    'controller' => 'borrower',
                    'buttons' => [
                        'approve' => function ($url, $model) {
                            return Html::a(
                                            '<span class="fa fa-thumbs-up"></span> Approve', $url, [
                                        'title' => Yii::t('app', 'Approve'),
                                        'class' => 'btn btn-primary btn-xs',]
                            );
                        },
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'approve') {
                                $url = 'approve?id=' . $model->id;
                                return $url;
                            }
                        },
                    ]
                ]
            ]
        ])
        ?>
    </div>
</div>
