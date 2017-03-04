<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Credit Investigator Approval';
$this->params['breadcrumbs'][] = ['label' => 'Transactions'];
$this->params['breadcrumbs'][] = $this->title;

$newborrowerProvider->pagination->pageParam = 'new-page';
$newborrowerProvider->sort->sortParam = 'new-sort';

$renewalborrowerProvider->pagination->pageParam = 'renewal-page';
$renewalborrowerProvider->sort->sortParam = 'renewal-sort';
?>
<div class="box box-primary">
    <div class="box-header">
        <h4><i class="fa fa-user"></i> New Borrowers</h4>
    </div>
    <div class="box-body">
        <?=
        GridView::widget([
            'dataProvider' => $newborrowerProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'last_name',
                'first_name',
                'middle_name',
                'canvass_date:date',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{ciapprovalnew}',
                    'controller' => 'borrower',
                    'buttons' => [
                        'ciapprovalnew' => function ($url, $model) {
                            return Html::a(
                                            '<span class="fa fa-thumbs-up"></span> Approve', $url, [
                                        'title' => Yii::t('app', 'Approve'),
                                        'class' => 'btn btn-primary btn-xs',]
                            );
                        },
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'ciapprovalnew') {
                                $url = 'ciapprovalnew?id=' . $model->id;
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
<div class="box box-primary">
    <div class="box-header">
        <h4><i class="fa fa-user"></i> Renewal Borrowers</h4>
    </div>
    <div class="box-body">
        <?=
        GridView::widget([
            'dataProvider' => $renewalborrowerProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'last_name',
                'first_name',
                'middle_name',
                'canvass_date:date',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{ciapprovalrenewal}',
                    'controller' => 'borrower',
                    'buttons' => [
                        'ciapprovalrenewal' => function ($url, $model) {
                            return Html::a(
                                            '<span class="fa fa-thumbs-up"></span> Approve', $url, [
                                        'title' => Yii::t('app', 'Approve'),
                                        'class' => 'btn btn-primary btn-xs',]
                            );
                        }, 'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'ciapprovalrenewal') {
                                $url = 'ciapprovalrenewal?id=' . $model->id;
                                return $url;
                            }
                        },
                    ],
                ]
            ]
        ])
        ?>
    </div>
</div>