<?php
/* @var $this yii\web\View */

use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\Growl;

$this->title = 'Credit Investigator Approval';
$this->params['breadcrumbs'][] = ['label' => 'Transactions'];
$this->params['breadcrumbs'][] = $this->title;

$newborrowerProvider->pagination->pageParam = 'new-page';
$newborrowerProvider->sort->sortParam = 'new-sort';

$renewalborrowerProvider->pagination->pageParam = 'renewal-page';
$renewalborrowerProvider->sort->sortParam = 'renewal-sort';
?>
<?php
if (Yii::$app->session->hasFlash('ciapprovalsuccess')) {
    echo Growl::widget([
        'type' => Growl::TYPE_SUCCESS,
        'title' => 'Well done!',
        'icon' => 'glyphicon glyphicon-ok-sign',
        'body' => Yii::$app->session->getFlash('ciapprovalsuccess'),
        'showSeparator' => true,
        'delay' => 0,
        'pluginOptions' => [
            'showProgressbar' => false,
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ]
        ]
    ]);
}
?>
<div class="box box-default">
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
                    'template' => '{ciapprovalnew} {cideny}',
                    'controller' => 'borrower',
                    'buttons' => [
                        'ciapprovalnew' => function ($url, $model) {
                            return Html::a(
                                            '<span class="fa fa-thumbs-up"></span> Approve', $url, [
                                        'title' => Yii::t('app', 'Approve'),
                                        'class' => 'btn btn-primary btn-xs',]
                            );
                        },
                        'cideny' => function ($url, $model) {
                            return Html::a(
                                            '<span class="fa fa-thumbs-down"></span> Deny', $url, [
                                        'title' => Yii::t('app', 'Approve'),
                                        'class' => 'btn btn-danger btn-xs',]
                            );
                        },
                    ]
                ]
            ]
        ])
        ?>
    </div>
</div>
<div class="box box-default">
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
                    'template' => '{ciapprovalrenewal} {cideny}',
                    'controller' => 'borrower',
                    'buttons' => [
                        'ciapprovalrenewal' => function ($url, $model) {
                            return Html::a(
                                            '<span class="fa fa-thumbs-up"></span> Approve', $url, [
                                        'title' => Yii::t('app', 'Approve'),
                                        'class' => 'btn btn-primary btn-xs',]
                            );
                        },
                        'cideny' => function ($url, $model) {
                            return Html::a(
                                            '<span class="fa fa-thumbs-down"></span> Deny', $url, [
                                        'title' => Yii::t('app', 'Approve'),
                                        'class' => 'btn btn-danger btn-xs',]
                            );
                        },
                    ],
                ]
            ]
        ])
        ?>
    </div>
</div>