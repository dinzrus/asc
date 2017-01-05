<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use kartik\widgets\Growl;

$this->title = 'Borrowers Collection';

$this->params['breadcrumbs'][] = 'Borrowers Collection';
?>
<style>
    .break-text{
        font-size: 1.3em;
    }

    .inputtext {
        font-size: 1.5em;
        text-align: center;
        font-weight: bold;
    }

    .inputcoin {
        font-size: 1.8em;
        text-align: right;
    }

    .total_amount {
        font-size: 1.3em;
        text-align: right;
    }

    .break-label {
        font-size: 1.3em;
    }

    .total-money {
        font-size: 1.6em;
        text-align: right;
        font-weight: bolder;
    }
</style>
<?php
$form = ActiveForm::begin();
?>
<div class="box box-primary">
    <div class="box-header">
        <a href="#myModal" class="btn btn-success btn-lg" data-toggle="modal"><i class="fa fa-bookmark"></i> Select Unit</a>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <?php if (Yii::$app->session->hasFlash('collection')): ?>
                    <?php
                    echo Growl::widget([
                        'type' => Growl::TYPE_SUCCESS,
                        'title' => 'Success!',
                        'icon' => 'glyphicon glyphicon-ok-sign',
                        'body' => Yii::$app->session->getFlash('collection'),
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
        <?php if ($isNew == true): ?>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#breakdown" data-toggle="tab"><i class="fa fa-arrow-circle-o-right"></i> <strong>Collection Breakdown</strong></a></li>
                    <li><a href="#active-collection" data-toggle="tab"><i class="fa fa-arrow-circle-o-right"></i> <strong>Active Collection</strong></a></li>
                    <li><a href="#pastdue-collection" data-toggle="tab"><i class="fa fa-arrow-circle-o-right"></i> <strong>Pastdue Collection</strong></a></li>
                </ul>
                <div class="tab-content">   
                    <table class="table table-bordered">
                        <tr>
                            <td class="col-md-4 break-label"><strong>Collection Date: </strong><p id = "collectionDate"><?= Yii::$app->formatter->asDate($money->collection_date) ?></p></td>
                            <td class="col-md-4 break-label"><strong>Branch: </strong><p id = "branchName"><?= \app\models\Branch::idName($money->branch_id) ?></p></td>
                            <td class="col-md-4 break-label"><strong>Unit: </strong><p id = "collectionUnit"><?= \app\models\Unit::idName($money->unit_id) ?></p></td>
                        </tr>
                    </table>
                    <div class="tab-pane active" id="breakdown">    
                        <div class="row">
                            <div class="col-md-12">
                                <?= $form->errorSummary($money) ?> 
                                <table class="table table-condensed table-hover">
                                    <tr>
                                        <td class="break-label text-center"><strong>NO.</strong></td>
                                        <td class="break-label text-center"><strong>DENOMINATION</strong></td>
                                        <td class="break-label text-center"><strong>TOTAL AMOUNT</strong></td>
                                    </tr>
                                    <tr>
                                        <td><?= $form->field($money, 'money_1000')->textInput(['onkeypress' => 'return isNumber(event)', 'onchange' => 'calculateTotal(1000, "#money-money_1000", "#money-total_1000")', 'class' => 'inputtext form-control'])->label(false) ?></td>
                                        <td class="text-center break-text"><strong>1000</strong></td>
                                        <td class="text-right break-text"><?= $form->field($money, 'total_1000')->textInput(['class' => 'total_amount form-control', 'readonly' => true])->label(false) ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $form->field($money, 'money_500')->textInput(['onkeypress' => 'return isNumber(event)', 'onchange' => 'calculateTotal(500, "#money-money_500", "#money-total_500")', 'class' => 'inputtext form-control'])->label(false) ?></td>
                                        <td class="text-center break-text"><strong>500</strong></td>
                                        <td class="text-right break-text"><?= $form->field($money, 'total_500')->textInput(['class' => 'total_amount form-control', 'readonly' => true])->label(false) ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $form->field($money, 'money_200')->textInput(['onkeypress' => 'return isNumber(event)', 'onchange' => 'calculateTotal(200, "#money-money_200", "#money-total_200")', 'class' => 'inputtext form-control'])->label(false) ?></td>
                                        <td class="text-center break-text"><strong>200</strong></td>
                                        <td class="text-right break-text"><?= $form->field($money, 'total_200')->textInput(['class' => 'total_amount form-control', 'readonly' => true])->label(false) ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $form->field($money, 'money_100')->textInput(['onkeypress' => 'return isNumber(event)', 'onchange' => 'calculateTotal(100, "#money-money_100", "#money-total_100")', 'class' => 'inputtext form-control'])->label(false) ?></td>
                                        <td class="text-center break-text"><strong>100</strong></td>
                                        <td class="text-right break-text"><?= $form->field($money, 'total_100')->textInput(['class' => 'total_amount form-control', 'readonly' => true])->label(false) ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $form->field($money, 'money_50')->textInput(['onkeypress' => 'return isNumber(event)', 'onchange' => 'calculateTotal(50, "#money-money_50", "#money-total_50")', 'class' => 'inputtext form-control'])->label(false) ?></td>
                                        <td class="text-center break-text"><strong>50</strong></td>
                                        <td class="text-right break-text"><?= $form->field($money, 'total_50')->textInput(['class' => 'total_amount form-control', 'readonly' => true])->label(false) ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $form->field($money, 'money_20')->textInput(['onkeypress' => 'return isNumber(event)', 'onchange' => 'calculateTotal(20, "#money-money_20", "#money-total_20")', 'class' => 'inputtext form-control'])->label(false) ?></td>
                                        <td class="text-center break-text"><strong>20</strong></td>
                                        <td class="text-right break-text"><?= $form->field($money, 'total_20')->textInput(['class' => 'total_amount form-control', 'readonly' => true])->label(false) ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong><p class="pull-right break-label">TOTAL COINS</p></strong></td>
                                        <td><?= $form->field($money, 'money_coin')->textInput(['onkeypress' => 'return isNumber(event)', 'onchange' => 'calculateTotal(null, null, null)', 'class' => 'inputcoin form-control'])->label(false) ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong><p class="pull-right break-label">TOTAL COLLECTION</p></strong></td>
                                        <td class="text-right break-text"><?= $form->field($money, 'money_total_amount')->textInput(['class' => 'total-money form-control', 'readonly' => true])->label(false) ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="active-collection">
                        <table class="table table-condensed table-bordered">
                            <tr>
                                <td><strong>#</strong></td>
                                <td><strong>Account. #</strong></td>
                                <td><strong>Name</strong></td>
                                <td><strong>Balance</strong></td>
                                <td><strong>Maturity Date</strong></td>
                                <td><strong>Advance/Del.</strong></td>
                                <td><strong>Penalty</strong></td>
                                <td><strong>Last Pay</strong></td>
                                <td><strong>Sched. Payment</strong></td>
                                <td><strong>Payment Remitted</strong></td>
                            </tr>
                            <?php
                                $no = 1;
                                foreach ($active as $acac): ?>
                            
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $acac['loan_no'] ?></td>
                                <td><?= strtoupper($acac['last_name'] . ', ' . $acac['first_name'] . ' ' . $acac['middle_name']) ?></td>
                                <td></td>
                                <td><?= $acac['maturity_date'] ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?= $acac['daily'] ?></td>
                                <td><input type="text" class="form-control" name="amt_remitted"></td>
                            </tr>
                            <?php
                                $no++;
                                endforeach; ?>
                        </table>
                    </div>
                    <div class="tab-pane" id="pastdue-collection"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-lg pull-right"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        <?php endif; ?>
    </div>   

</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="get">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="float: left; font-weight: bold;">Collection Breakdown</h4>
                </div>
                <div class="modal-body">  
                    <div class="row">
                        <div class="col-md-5">
                            <?php
                            if (!$isNew) {
                                $money->collection_date = date('Y-m-d');
                            }
                            echo $form->field($money, 'collection_date')->widget(\kartik\datecontrol\DateControl::classname(), [
                                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                                'displayFormat' => 'php:Y-m-d',
                                'saveFormat' => 'php:Y-m-d',
                                'ajaxConversion' => true,
                                'options' => [
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                    ],
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-md-4">
                            <?=
                            $form->field($money, 'branch_id')->widget(\kartik\widgets\Select2::classname(), [
                                'data' => (strtoupper(Yii::$app->user->identity->branch->branch_description) === 'MAIN') ? \yii\helpers\ArrayHelper::map(\app\models\Branch::find()->orderBy('branch_id')->asArray()->all(), 'branch_id', 'branch_description') : \yii\helpers\ArrayHelper::map(\app\models\Branch::find()->andWhere(['branch_id' => Yii::$app->user->identity->branch_id])->all(), 'branch_id', 'branch_description'),
                                'options' => ['placeholder' => 'Select Branch'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?=
                            $form->field($money, 'unit_id')->widget(DepDrop::classname(), [
                                'options' => ['id' => Html::getInputId($money, 'unit_id')],
                                'type' => DepDrop::TYPE_SELECT2,
                                'pluginOptions' => [
                                    'depends' => [Html::getInputId($money, 'branch_id')],
                                    'placeholder' => 'Select unit',
                                    'initialize' => true,
                                    'url' => Url::to(['/site/getunits'])
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <?php if (!$isNew): ?>
                                <?= Html::a('<i class="fa fa-save"></i> Submit', Url::to(['site/borrowerscollection']), ['class' => 'btn btn-primary btn-block', 'onclick' => 'javascript:addURL(this);']) ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$form = ActiveForm::end();
?>

<?php $this->registerJsFile("@web/js/borrowerscollection.js", ['depends' => [\yii\web\JqueryAsset::className()]]); ?>


