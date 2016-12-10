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
                            <table class="table table-condensed table-hover">
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
                <div class="tab-pane" id="collection"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button value="submit" class="btn btn-primary btn-lg pull-right"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>

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
        ", View::POS_END); ?>


