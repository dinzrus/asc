<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\BorrowerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\widgets\Growl;

$this->title = 'Borrower Accounts';
$this->params['breadcrumbs'][] = ['label' => 'Borrowers', 'url' => ['site/accountledger']];
$this->params['breadcrumbs'][] = $this->title;

$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<style>

    /* Important part */
    .modal-dialog{
        overflow-y: initial !important;
    }
    .modal-body{
        height: 250px;
        overflow-y: auto;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <?php if (Yii::$app->session->hasFlash('loanReleased')): ?>
            <?php
            echo Growl::widget([
                'type' => Growl::TYPE_SUCCESS,
                'title' => 'Well done!',
                'icon' => 'glyphicon glyphicon-ok-sign',
                'body' => Yii::$app->session->getFlash('loanReleased'),
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
<div class="row">
    <div class="col-md-4">
        <div class="box box-solid">
            <div class="box-header">
                <center><h4><strong>Borrower</strong></h4></center>
            </div>
            <div class="box-body">
                <center>
                    <?php
                    if (isset($borrower->profile_pic)) {
                        echo Html::img($borrower->profile_pic, ['class' => 'profile-user-img img-responsive img-circle', 'width' => 100]);
                    } else {
                        echo Html::img('fileupload/default.jpg', ['class' => 'profile-user-img img-responsive img-circle', 'width' => 100]);
                    }
                    ?>
                </center>
                <br>
                <table class="table table-hover table-bordered">
                    <tr>
                        <th>Name</th>
                        <td><?= $borrower->fullname ?></td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td><?= $borrower->gender ?></td>
                    </tr>
                    <tr>
                        <th>Civil Status</th>
                        <td><?= $borrower->civil_status ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?= $borrower->address_street_house_no . ', ' . $borrower->addressBarangay->barangay . ', ' . $borrower->addressCityMunicipality->municipality_city . ', ' . $borrower->addressProvince->province ?></td>
                    </tr>
                    <tr>
                        <th>Contact No.</th>
                        <td><?= $borrower->contact_no ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="box box-solid">
            <div class="box-header">
                <center><h4><strong>Accounts</strong></h4></center>
            </div>
            <div class="box-body">
                <?=
                GridView::widget([
                    'dataProvider' => $loanprovider,
                    'condensed' => true,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'loan_no',
                        [
                            'attribute' => 'release_date',
                            'format' => ['date', 'php:m/d/Y']
                        ],
                        [
                            'label' => 'Maturity Date',
                            'format' => ['date', 'php:m/d/Y'],
                            'value' => function($loanprovider) {
                                if (!$loanprovider['maturity_date'])
                                    return \app\models\Loan::getMaturityDate($loanprovider['release_date'], $loanprovider['term']);
                                else
                                    return $loanprovider['maturity_date'];
                            },
                        ],
                        [
                            'attribute' => 'daily',
                            'format' => 'currency',
                        ],
                        [
                            'label' => 'Status',
                            'format' => 'html',
                            'value' => function ($loanprovider) {
                                if ($loanprovider['status'] == 'A') {
                                    return Html::tag('small', 'Active', ['class' => 'label bg-green']);
                                }
                                if ($loanprovider['status'] == 'PD') {
                                    return Html::tag('small', 'Pastdue', ['class' => 'label bg-red']);
                                }
                                if ($loanprovider['status'] == 'PO') {
                                    return Html::tag('small', 'Pay out', ['class' => 'label bg-blue']);
                                }
                                if ($loanprovider['status'] == 'WA') {
                                    return Html::tag('small', 'Waive', ['class' => 'label bg-blue']);
                                }
                            }
                        ],
                        [
                            'class' => '\kartik\grid\ActionColumn',
                            'template' => '{viewledger}',
                            'buttons' => [
                                'viewledger' => function($url, $loanprovider) {
                                    return Html::button('<i class="fa fa-eye"></i> View Ledger', [
                                                'title' => Yii::t('app', 'View loan ledger'),
                                                'class' => 'btn btn-primary btn-xs',
                                                'type' => 'button',
                                                'data-target' => '#myModal',
                                                'data-toggle' => 'modal',
                                                'data-loanid' => $loanprovider['id'],
                                                'data-maturitydate' => app\models\Loan::getMaturityDate($loanprovider['release_date'], $loanprovider['term']),
                                    ]);
                                },
                            ],
                        ],
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="font-weight: bold;">LOAN LEDGER 
                    <a role="button" data-toggle="collapse" href="#accdetails" aria-expanded="false" aria-controls="collapseExample">
                        | Account Details <i class='glyphicon glyphicon-info-sign'></i>
                    </a>
                    <?php if (Yii::$app->user->can('IT')): ?>
                        <a role="button" data-toggle="collapse" href="#accoptions" aria-expanded="false" aria-controls="collapseExample">
                            | Account Options <i class='glyphicon glyphicon-option-vertical'></i>
                        </a>
                    <?php endif; ?>
                </h4>
                <?php if (Yii::$app->user->can('IT')): ?>
                    <div class="collapse" id="accoptions">
                        <table class="table table-condensed table-bordered">
                            <tr>
                                <td><a href="#" class="btn btn-success btn-block" role="button" href=""><strong><i class="fa fa-edit"></i> Change Unit</strong></a></td>
                                <td><a href="#" class="btn btn-success btn-block" role="button" href=""><strong><i class="fa fa-edit"></i> Change Daily</strong></a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="btn btn-primary btn-block" onclick="return confirm('Are you sure to waive balances on this account?')" role="button" href=""><strong><i class="fa fa-eraser"></i> Waive</strong></a></td>
                                <td><a href="#" class="btn btn-danger btn-block" onclick="return confirm('Are you sure to delete this account? This action is unrevokeable.')" role="button" href=""><strong><i class="fa fa-remove"></i> Delete Account</strong></a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="btn btn-success btn-block" role="button" href=""><strong><i class="fa fa-edit"></i> Change Release Date</strong></a></td>
                                <td><a href="#" class="btn btn-success btn-block" role="button" href=""><strong><i class="fa fa-edit"></i> Change Maturity Date</strong></a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="btn btn-success btn-block" role="button" href=""><strong><i class="fa fa-edit"></i> Change Branch</strong></a></td>
                                <td><a href="#" class="btn btn-success btn-block" role="button" href=""><strong><i class="fa fa-edit"></i> Change Loan Type</strong></a></td>
                            </tr>
                        </table>
                    </div>
                <?php endif; ?>
                <div class='collapse' id='accdetails'>
                    <div class="well well-sm">
                        <table class="table table-bordered table-condensed table-hover">
                            <tr>
                                <td><strong>Acc. No.</strong></td>
                                <td id="accno"></td>
                                <td><strong>Daily</strong></td>
                                <td id="daily"></td>
                            </tr>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td id="name"></td>
                                <td><strong>Beg. Balance</strong></td>
                                <td id="begbalance"></td>
                            </tr>
                            <tr>
                                <td><strong>Business Type</strong></td>
                                <td id="storetype"></td>
                                <td><strong>Total Payment</strong></td>
                                <td id="totalpay"></td>
                            </tr>
                            <tr>
                                <td><strong>Contact No.</strong></td>
                                <td id="contact"></td>
                                <td><strong>Del. / Adv.</strong></td>
                                <td id="delbalance"></td>
                            </tr>
                            <tr>
                                <td><strong>Released Date</strong></td>
                                <td id="reldate"></td>
                                <td><strong>Penalty</strong></td>
                                <td id="penalty"></td>
                            </tr>
                            <tr>
                                <td><strong>Maturity Date</strong></td>
                                <td id="matdate"></td>
                                <td><strong>Last Pay</strong></td>
                                <td id="lastpay"></td>
                            </tr>
                            <tr>
                                <td><strong>Canvasser</strong></td>
                                <td id="canvasser"></td>
                                <td><strong>Ending Bal.</strong></td>
                                <td id="totalbalance"></td>
                            </tr>
                        </table> 
                    </div>
                </div>
            </div>
            <div class="modal-body">  
                <table class="table table-bordered table-condensed table-hover" id="account-table">
                    <thead>
                        <tr>
                            <th><strong>PAY DATE</strong></th>
                            <th><strong>PAYMENT</strong></th>
                            <th><strong>DLQNT.& ADV.</strong></th>
                            <th><strong>PENALTY</strong></th>
                            <th><strong>DEBIT</strong></th>
                            <th><strong>BALANCE</strong></th>
                        </tr>
                    </thead>
                    <tbody id="pay-list">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJsFile('@web/js/loaninfo.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>




