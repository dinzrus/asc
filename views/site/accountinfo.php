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

$this->title = 'Accounts Details';
$this->params['breadcrumbs'][] = ['label' => 'Borrowers', 'url' => ['site/accountledger']];
$this->params['breadcrumbs'][] = $this->title;

$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
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
                                <td><a type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i></a></td>
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
            <form method="get">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 style="font-weight: bold; color: blue;">LOAN HISTORY</h3>
                    <i style="float: left; margin: 6px 3px" class="fa fa-user"></i> <h4 style="float: left; font-weight: bold;" class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">  
                    <table class="table table-striped table-responsive" id="account-list">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account No.</th>
                                <th>Release Date</th>
                                <th>Maturity Date</th>
                                <th>Loan Type</th>
                                <th>Unit</th>
                                <th>View Ledger</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
//$this->registerJsFile('@web/js/ledger.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>




