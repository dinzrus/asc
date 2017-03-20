<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\BorrowerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\widgets\Growl;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'Approved for Release';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(['enablePushState' => false]) ?>
<div class="row">
    <div class="col-md-12">
        <?php if (Yii::$app->session->hasFlash('successreleasing')): ?>
            <?php
            echo Growl::widget([
                'type' => Growl::TYPE_SUCCESS,
                'title' => 'Well done!',
                'icon' => 'glyphicon glyphicon-ok-sign',
                'body' => Yii::$app->session->getFlash('successreleasing'),
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
            ?>
        <?php endif; ?>   
    </div>
</div>

<div class="box box-default">
    <div class="box-header">
        <h4 class="box-title"><i class="fa fa-user"></i> New Borrowers</h4>
    </div>
    <div class="box-body">    
        <!------ box-body ----------->
        <?=
        GridView::widget([
            'dataProvider' => $newProvider,
            'condensed' => true,
            'hover' => true,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'fullname',
                'branch_description',
                'unit',
                'daily',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{viewnew} {newbranchrelease} {newbranchunrelease}',
                    'buttons' => [
                        'viewnew' => function ($url, $model) {
                            return Html::a('<i class="fa fa-eye"></i> View', $url, [
                                        'title' => Yii::t('app', 'View loan Information'),
                                        'class' => 'btn btn-primary btn-xs'
                            ]);
                        },
                        'newbranchrelease' => function ($url, $model) {
                            return Html::a('<i class="fa fa-thumbs-up"></i> Release', $url, [
                                        'title' => Yii::t('app', 'Approve the loan'),
                                        'class' => 'btn btn-success btn-xs',
                                        'onclick' => 'return confirm("Are you sure to approve this loan?")'
                            ]);
                        },
                        'newbranchunrelease' => function ($url, $model) {
                            return Html::a('<i class="fa fa-ban"></i> Unrelease', $url, [
                                        'title' => Yii::t('app', 'Deny the loan'),
                                        'class' => 'btn btn-danger btn-xs',
                                        'onclick' => 'return confirm("Are you sure to deny this loan?")',
                            ]);
                        },
                    ],
                    'urlCreator' => function($action, $newProvider, $url) {
                        if ($action == 'viewnew') {
                            $url = Url::to(['loan/viewnew', 'borrowerid' => $newProvider['borrower_id'], 'loanid' => $newProvider['loan_id']]);
                            return $url;
                        }
                        if ($action == 'newbranchrelease') {
                            $url = Url::to(['loan/newreleased', 'loanid' => $newProvider['loan_id']]);
                            return $url;
                        }
                    }
                ],
            ]
        ]);
        ?>
    </div>
    <?php Pjax::end(); ?>
</div>

<div class="box box-default">
    <div class="box-header">
        <h4 class="box-title"><i class="fa fa-user"></i> Renewal Borrowers</h4>
    </div>
    <div class="box-body">
        <?=
        GridView::widget([
            'dataProvider' => $renewalProvider,
            'condensed' => true,
            'hover' => true,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'fullname',
                'branch_description',
                'unit',
                'daily',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{viewrenewal} {renewalbranchrelease} {renewalbranchunrelease}',
                    'controller' => 'loan',
                    'buttons' => [
                        'viewrenewal' => function ($url, $model) {
                            return Html::a('<i class="fa fa-eye"></i> View', $url, [
                                        'title' => Yii::t('app', 'View loan Information'),
                                        'class' => 'btn btn-primary btn-xs',
                            ]);
                        },
                        'renewalbranchrelease' => function ($url, $model) {
                            return Html::a('<i class="fa fa-thumbs-up"></i> Release', $url, [
                                        'title' => Yii::t('app', 'Approve the loan'),
                                        'class' => 'btn btn-success btn-xs',
                                        'onclick' => 'return confirm("Are you sure to approve this loan?")'
                            ]);
                        },
                        'renewalbranchunrelease' => function ($url, $model) {
                            return Html::a('<i class="fa fa-ban"></i> Unrelease', $url, [
                                        'title' => Yii::t('app', 'Deny the loan'),
                                        'class' => 'btn btn-danger btn-xs',
                                        'onclick' => 'return confirm("Are you sure to deny this loan?")',
                            ]);
                        },
                    ],
                    'urlCreator' => function($action, $newProvider, $url) {
                        if ($action == 'viewrenewal') {
                            $url = Url::to(['loan/viewrenewal', 'borrowerid' => $newProvider['borrower_id'], 'loanid' => $newProvider['loan_id']]);
                            return $url;
                        }
                        if ($action == 'renewalbranchrelease') {
                            $url = Url::to(['loan/renewalreleased', 'loanid' => $newProvider['loan_id']]);
                            return $url;
                        }
                    }
                ],
            ]
        ]);
        ?>
    </div>
</div>






