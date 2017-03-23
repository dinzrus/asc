<?php
$this->title = 'Borrowers Loan Collection';

use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Unit List', 'url' => ['site/borrowerscollection']];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<?php $form = ActiveForm::begin() ?>
<div class="row form-group">
    <div class="col-xs-12">
        <ul class="nav nav-pills nav-justified thumbnail setup-panel">
            <li class="active"><a href="#step-1">
                    <h4 class="list-group-item-heading">Step 1 <i class="fa fa-arrow-right"></i></h4>
                    <p class="list-group-item-text">Collection Breakdown</p>
                </a></li> 
            <li class="disabled"><a href="#step-2">
                    <h4 class="list-group-item-heading">Step 2 <i class="fa fa-arrow-right"></i></h4>
                    <p class="list-group-item-text">Active Collection</p>
                </a></li> 
            <li class="disabled"><a href="#step-3">
                    <h4 class="list-group-item-heading">Step 3 <i class="fa fa-arrow-right"></i></h4>
                    <p class="list-group-item-text">Pastdue Collection</p>
                </a></li> 
            <li class="disabled"><a href="#step-4">
                    <h4 class="list-group-item-heading">Step 4 <i class="fa fa-save"></i></h4>
                    <p class="list-group-item-text">Collection Summary</p>
                </a></li> 
        </ul>
    </div>
</div>

<!-- step-1 -->
<div class="box box-default setup-content" id="step-1">
    <div class="box-header"></div>  
    <div class="box-body">
        <div class="panel panel-primary">
            <style>
                table th {
                    font-size: 1.2em;
                    text-align: center;
                }
                .align-center {
                    text-align: center;
                    font-weight: bolder;
                    font-size: 1.3em;
                }

                .align-right {
                    text-align: right;
                    font-weight: bolder;
                    font-size: 1.3em;
                }
            </style>
            <div class="panel-body">
                <table class="table table-bordered table-condensed">
                    <tr bgcolor="#92e5be">
                        <th>Transaction Date</th>
                        <td class="align-center"><?= $money->collection_date ?></td>
                        <th>Unit Code</th>
                        <td class="align-center"><?= $unit->unit_description ?></td>
                    </tr>
                </table>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th><center>No. of Pieces</center></th>
                    <th><center>Denomination</center></th>
                    <th class="align-right">Total Amount</th>
                    </tr>
                    <tr>
                        <td><?= $form->field($money, 'money_1000')->textInput(['class' => 'align-center form-control'])->label(false) ?></td>
                        <td class="align-center">1000</td>
                        <td><?= $form->field($money, 'total_1000')->textInput(['class' => 'align-right form-control', 'readonly' => true])->label(false) ?></td>
                    </tr>
                    <tr>
                        <td><?= $form->field($money, 'money_500')->textInput(['class' => 'align-center form-control'])->label(false) ?></td>
                        <td class="align-center">500</td>
                        <td><?= $form->field($money, 'total_500')->textInput(['class' => 'align-right form-control', 'readonly' => true])->label(false) ?></td>
                    </tr>
                    <tr>
                        <td><?= $form->field($money, 'money_200')->textInput(['class' => 'align-center form-control'])->label(false) ?></td>
                        <td class="align-center">200</td>
                        <td><?= $form->field($money, 'total_200')->textInput(['class' => 'align-right form-control', 'readonly' => true])->label(false) ?></td>
                    </tr>
                    <tr>
                        <td><?= $form->field($money, 'money_100')->textInput(['class' => 'align-center form-control'])->label(false) ?></td>
                        <td class="align-center">100</td>
                        <td><?= $form->field($money, 'total_100')->textInput(['class' => 'align-right form-control', 'readonly' => true])->label(false) ?></td>
                    </tr>
                    <tr>
                        <td><?= $form->field($money, 'money_50')->textInput(['class' => 'align-center form-control'])->label(false) ?></td>
                        <td class="align-center">50</td>
                        <td><?= $form->field($money, 'total_50')->textInput(['class' => 'align-right form-control', 'readonly' => true])->label(false) ?></td>
                    </tr>
                    <tr>
                        <td><?= $form->field($money, 'money_20')->textInput(['class' => 'align-center form-control'])->label(false) ?></td>
                        <td class="align-center">20</td>
                        <td><?= $form->field($money, 'total_20')->textInput(['class' => 'align-right form-control', 'readonly' => true])->label(false) ?></td>
                    </tr>
                    <tr>
                        <th class="align-right" colspan="2">TOTAL COINS</th>
                        <td><?= $form->field($money, 'money_coin')->textInput(['class' => 'align-right form-control'])->label(false) ?></td>
                    </tr>
                    <tr>
                        <th class="align-right" colspan="2">TOTAL COLLECTION</th>
                        <td><?= $form->field($money, 'money_total_amount')->textInput(['class' => 'align-right form-control', 'readonly' => true])->label(false) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="form-group">
            <div class="col-lg-12">
                <button id="activate-step-2" class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-right"></i> Next</button>
            </div>
        </div>
    </div>
</div>
<!-- step-2 end -->
<div class="box box-default setup-content" id="step-2">
    <div class="box-header"></div>  
    <div class="box-body">
        <div class="panel panel-primary">
            <div class="panel-body">
                <?=
                GridView::widget([
                    'dataProvider' => $loan_provider_active,
                    'pjax' => true,
                    'columns' => [
                        [
                            'class' => 'kartik\grid\SerialColumn',
                        ],
                        'loan_no',
                        'name',
                        [
                            'label' => 'Total Balance',
                            'value' => function () {
                                return 1000.00;
                            },
                        ],
                        'daily',
                        [
                            'label' => 'Adv./ Del.',
                            'value' => function() {
                                return 1000.00;
                            },
                        ],
                        [
                            'label' => 'Penalty',
                            'value' => function() {
                                return 1000.00;
                            },
                        ],
                        [
                            'label' => 'Debit',
                            'value' => function() {
                                return 1000.00;
                            },
                        ],
                        [
                            'label' => 'Payment',
                            'format' => 'raw',
                            'value' => function() {
                                return Html::textInput('payment', null, ['class' => 'form-control', 'id' => 'payment-amount']);
                            },
                        ],
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="form-group">
            <div class="col-lg-12">
                <button id="activate-step-3" class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-right"></i> Next</button>
            </div>
        </div>
    </div>
</div>

<!-- step-3 -->
<div class="box box-default setup-content" id="step-3">
    <div class="box-header"></div>  
    <div class="box-body">
        <!-- Loan Information -->
        <div class="panel panel-primary">
            <div class="panel-body">

            </div>

        </div>
    </div>
    <div class="box-footer">
        <div class="form-group">
            <div class="col-lg-12">
                <button id="activate-step-4" class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-right"></i> Next</button>
            </div>
        </div>
    </div>
</div>

<!-- step-4 -->
<div class="box box-default setup-content" id="step-4">
    <div class="box-header"></div>  
    <div class="box-body">
        <!-- Loan Information -->
        <div class="panel panel-primary">
            <div class="panel-body">

            </div>

        </div>
    </div>
    <div class="box-footer">
        <div class="form-group">
            <div class="col-lg-12">
                <?= Html::submitButton('<i class="fa fa-save"></i>  Save', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>


<?php ActiveForm::end() ?>

<?php $this->registerJsFile("@web/js/collection.js", ['depends' => [\yii\web\JqueryAsset::className()]]); ?>