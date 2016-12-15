<?php
/* @var $this yii\web\View */

use yii\bootstrap\Modal;
use yii\web\view;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#breakdown" data-toggle="tab"><i class="fa fa-arrow-circle-o-right"></i> <strong>Collection Breakdown</strong></a></li>
                <li><a href="#collection" data-toggle="tab"><i class="fa fa-arrow-circle-o-right"></i> <strong>Collection</strong></a></li>
            </ul>

            <div class="tab-content">     
                <div class="tab-pane active" id="breakdown">    
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->errorSummary($money) ?> 
                            <table class="table table-condensed table-hover">
                                <tr>
                                    <td class="break-label text-center"><strong>NO.</strong></td>
                                    <td class="break-label text-center"><strong>DENOMINATION</strong></td>
                                    <td class="break-label text-center"><strong>TOTAL COUNT</strong></td>
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
                <div class="tab-pane" id="collection"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-lg pull-right"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>

    </div>     
</div>
<?php
$form = ActiveForm::end();
?>
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
                        <div class="col-md-6">
                            <?=
                            $form->field($money, 'collection_date')->widget(\kartik\datecontrol\DateControl::classname(), [
                                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                                'saveFormat' => 'php:Y-m-d',
                                'ajaxConversion' => true,
                                'options' => [
                                    'pluginOptions' => [
                                        'placeholder' => 'Collection Date',
                                        'autoclose' => true,
                                    ],
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <label class="break-text">Unit</label>
                            <select class="form-control break-text" name="unit">
                                <option value="1">A1</option>
                                <option value="2">A2</option>
                                <option value="3">A3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button value="submit" class = 'btn btn-success btn-block'><i class="fa fa-save"></i> Submit</button>
                        </div>
                        <div class="col-md-6">
                            <button class = 'btn btn-success btn-danger btn-block'>Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->registerJs("
        
        
        $(window).load(function(){
            //$('#myModal').modal('show');
        });
        
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46) {
                return false;
            }
            return true;
        }
        
        function calculateTotal(amount, eid, ttamt){
        
            var money_cnt = $(eid).val();
            total = money_cnt * amount;
            $(ttamt).val(parseFloat(total).toFixed(2));

            var ttotal = 0;
            var m1000 = $('#money-total_1000').val() || 0;
            var m500 = $('#money-total_500').val() || 0;
            var m200 = $('#money-total_200').val() || 0;
            var m100 = $('#money-total_100').val() || 0;
            var m50 = $('#money-total_50').val() || 0;
            var m20 = $('#money-total_20').val() || 0;
            var mcoin = $('#money-money_coin').val() || 0;
                          
            ttotal = parseInt(m1000) + parseFloat(m500) + parseFloat(m200) + parseFloat(m100) + parseFloat(m50) + parseFloat(m20) + parseFloat(mcoin);  
            $('#money-money_total_amount').val(parseFloat(ttotal).toFixed(2));
         
        }
        
         
        ", View::POS_END); ?>


