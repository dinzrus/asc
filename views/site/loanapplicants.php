<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\Growl;
use kartik\widgets\Select2;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'Loan Applicants';
$this->params['breadcrumbs'][] = ['label' => 'Transactions'];
$this->params['breadcrumbs'][] = $this->title;

$newborrowers->pagination->pageParam = 'new-page';
$newborrowers->sort->sortParam = 'new-sort';

$renewalborrowers->pagination->pageParam = 'renewal-page';
$renewalborrowers->sort->sortParam = 'renewal-sort';
?>

<?php
$flash = null;
if (Yii::$app->session->getFlash('borrower_save')) {
    $flash = Yii::$app->session->getFlash('borrower_save');
}
if (Yii::$app->session->getFlash('borrower_new_delete')) {
    $flash = Yii::$app->session->getFlash('borrower_new_delete');
}
if (Yii::$app->session->getFlash('borrower_renewal_remove')) {
    $flash = Yii::$app->session->getFlash('borrower_renewal_remove');
}
if (Yii::$app->session->getFlash('borrower_renewal_added')) {
    $flash = Yii::$app->session->getFlash('borrower_renewal_added');
}
if ($flash != null) {
    echo Growl::widget([
        'type' => Growl::TYPE_SUCCESS,
        'title' => 'Well done!',
        'icon' => 'glyphicon glyphicon-ok-sign',
        'body' => $flash,
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
<?php Pjax::begin() ?>
<div class="row">
    <div class="col-md-12">
        <div class="box  box-default">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-user"></i> New Borrowers</h3>
                <br><br>
                <div class="row">
                    <div class="col-md-12">
                        <?=
                        Html::a('<span class="fa fa-plus"></span> Add New', Url::to(['site/canvass']), [
                            'class' => 'btn btn-success'
                        ])
                        ?>
                    </div>  
                </div>
            </div>
            <div class="box-body">
                <?=
                GridView::widget([
                    'dataProvider' => $newborrowers,
                    'condensed' => true,
                    'hover' => true,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'last_name',
                        'first_name',
                        'canvass_date:date',
                        'canvasser',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{removenew}',
                            'controller' => 'borrower',
                            'buttons' => [
                                'removenew' => function($url) {
                                    return Html::a('<i class="glyphicon glyphicon-trash"></i> ', $url, ['onclick' => 'return confirm("Are you sure to delete this borrower?")']);
                                },
                            ],
                        ],
                    ]
                ])
                ?>
            </div>
        </div>
        <div class="box  box-default">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-user"></i> Renewal Borrowers</h3>
                <br><br>
                <div class="row">
                    <div class="col-md-12">
                        <?= Html::button('<span class="fa fa-plus"></span> Add Renewal', ['class' => 'btn btn-success', 'data-target' => '#myModal', 'data-toggle' => 'modal']) ?>
                    </div>  
                </div>
            </div>
            <div class="box-body">
                <?=
                GridView::widget([
                    'dataProvider' => $renewalborrowers,
                    'condensed' => true,
                    'hover' => true,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'last_name',
                        'first_name',
                        'canvass_date:date',
                        'canvasser',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{removerenewal}',
                            'controller' => 'borrower',
                            'buttons' => [
                                'removerenewal' => function($url) {
                                    return Html::a('<i class="glyphicon glyphicon-trash"></i> ', $url, ['onclick' => 'return confirm("Are you sure to remove this borrower?")']);
                                },
                            ],
                        ],
                    ]
                ])
                ?>
            </div>
        </div>
    </div>
</div>
<?php Pjax::end() ?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i> Add Renewal</h4>
            </div>
            <div class="modal-body">
                <?php
                $form = ActiveForm::begin([
                            'action' => ['borrower/renewapplicant'],
                            'method' => 'post'
                        ])
                ?>
                <?=
                Select2::widget([
                    'name' => 'borrowers',
                    'data' => yii\helpers\ArrayHelper::map($borrowers, 'id', 'fullname'),
                    'options' => [
                        'placeholder' => 'Select borrower',
                        'multiple' => true,
                        'required' => true,
                    ],
                ]);
                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>


