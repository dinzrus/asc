<?php
$this->title = 'Borrowers Loan Collection';

use yii\widgets\ActiveForm;
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
                    font-size: 1.3em;
                }
            </style>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Transaction Date</th>
                        <td></td>
                        <th>Unit Code</th>
                        <td></td>
                    </tr>
                </table>
                <table class="table table-bordered">
                    <tr>
                        <th>No. of Pieces</th>
                        <th>Denomination</th>
                        <th>Total Amount</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td>1000</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>500</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>200</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>100</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>50</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>20</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th colspan="2">TOTAL COINS</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th colspan="2">TOTAL COLLECTION</th>
                        <td></td>
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