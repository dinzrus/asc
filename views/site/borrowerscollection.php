<?php
/* @var $this yii\web\View */

use yii\bootstrap\Modal;
use yii\web\view;
use yii\helpers\Html;

$this->title = 'Borrowers Collection';

$this->params['breadcrumbs'][] = 'Borrowers Collection';
?>
<style>
    .break-text{
        font-size: 1.3em;
    }

    .break-label {
        font-size: 1.2em;
    }
</style>
<div class="box box-primary">
    <div class="box-body">
        <a href="#myModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-file"></i> New</a>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="get">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="float: left; font-weight: bold;">Collection Breakdown</h4>
                    <p class="break-text text-right" style="float: right;"><strong>Transaction date:</strong> <?= date('m/d/Y'); ?> &nbsp;</p>
                </div>
                <div class="modal-body">  
                    <div class="row">
                        <div class="col-md-6">
                            <label class="break-text pull-right">Unit</label>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control break-text" name="unit">
                                <option value="1">A1</option>
                                <option value="2">A2</option>
                                <option value="3">A3</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-condensed table-hover">
                                    <tr>
                                        <td class="break-label text-center"><strong>NO.</strong></td>
                                        <td class="break-label text-center"><strong>DENOMINATION</strong></td>
                                        <td class="break-label text-center"><strong>TOTAL COUNT</strong></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="break-text form form-control text-center"></td>
                                        <td class="text-center break-text"><strong>1000</strong></td>
                                        <td class="text-right break-text">15,000.00</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="break-text form form-control text-center"></td>
                                        <td class="text-center break-text"><strong>500</strong></td>
                                        <td class="text-right break-text">15,000.00</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="break-text form form-control text-center"></td>
                                        <td class="text-center break-text"><strong>200</strong></td>
                                        <td class="text-right break-text">15,000.00</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="break-text form form-control text-center"></td>
                                        <td class="text-center break-text"><strong>100</strong></td>
                                        <td class="text-right break-text">15,000.00</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="break-text form form-control text-center"></td>
                                        <td class="text-center break-text"><strong>50</strong></td>
                                        <td class="text-right break-text">15,000.00</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="break-text form form-control text-center"></td>
                                        <td class="text-center break-text"><strong>20</strong></td>
                                        <td class="text-right break-text">15,000.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong><p class="pull-right break-label">TOTAL COINS</p></strong></td>
                                        <td><input type="text" class="break-text form form-control text-right"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong><p class="pull-right break-label">TOTAL COLLECTION</p></strong></td>
                                        <td class="text-right break-text">15,000.00</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <?= Html::button('Save', ['class' => 'btn btn-success btn-block']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= Html::button('Cancel', ['class' => 'btn btn-danger btn-block']) ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->registerJs("
        $(window).load(function(){
            $('#myModal').modal('show');
        });
        ", View::POS_END); ?>


