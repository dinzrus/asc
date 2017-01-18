<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\BorrowerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\web\View;
use yii\widgets\Pjax;
use kartik\widgets\Growl;

$this->title = 'Accounts';
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
    <div class="col-md-3">
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
                        <td><strong>Name:</strong></td>
                        <td><?= $borrower->fullname ?></td>
                    </tr>
                    <tr>
                        <td><strong>Address:</strong></td>
                        <td><?= $borrower->address_street_house_no . ', ' . $borrower->addressBarangay->barangay . ', ' . $borrower->addressCityMunicipality->municipality_city . ', ' . $borrower->addressProvince->province ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-solid">
            <div class="box-header">
                <center><h4><strong>Accounts</strong></h4></center>
            </div>
            <div class="box-body">
                <br>
                <table class="table table-bordered">
                    <tr>
                        <td><strong>#</strong></td>
                        <td><strong>TYPE</strong></td>
                        <td><strong>UNIT</strong></td>
                        <td><strong>ACCOUNT CODE</strong></td>
                        <td><strong>RELEASE DATE</strong></td>
                        <td><strong>MATURITY</strong></td>
                        <td><strong>DAILY PAY</strong></td>
                        <td><strong>TERM</strong></td>
                        <td><strong>Status</strong></td>
                        <td><strong>VIEW LEDGER</strong></td>
                    </tr>
                    <?php
                    $counter = 1;
                    if (count($loans) > 0) :
                        foreach ($loans as $loan) :
                            ?>
                            <tr>
                                <td><?= $counter ?></td>
                                <td><?= $loan->loanType->loan_description ?></td>
                                <td><?= $loan->unit0->unit_description ?></td>
                                <td><?= $loan->loan_no ?></td>
                                <td><?= Yii::$app->formatter->asDate($loan->release_date) ?></td>
                                <td><?= Yii::$app->formatter->asDate($loan->maturity_date) ?></td>
                                <td><?= Yii::$app->formatter->asCurrency($loan->daily) ?></td>
                                <td><?= $loan->term ?></td>
                                <td>
                                    <?php
                                    switch ($loan->status) {
                                        case 'A':
                                            echo "<span class='label label-success'>Active</span>";
                                            break;
                                        case 'PD':
                                            echo "<span class='label label-danger'>Pastdue</span>";
                                            break;
                                        case 'WA':
                                            echo "<span class='label label-default'>Waived</span>";
                                            break;
                                        case 'PO':
                                            echo "<span class='label label-info'>Payout</span>";
                                            break;
                                    }
                                    ?>
                                </td>
                                <td><a type="button" data-loanid="<?= $loan->id ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i></a></td>
                            </tr>
                            <?php $counter++; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td class="alert-info" colspan="10" style="text-align: center;">No data to display</td>
                        </tr>
                    <?php endif; ?>
                </table>
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




