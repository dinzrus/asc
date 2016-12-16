<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\BorrowerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\web\View;
use yii\widgets\Pjax;
use kartik\growl\Growl;

$this->title = 'Releasing Approval';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <?php
    Pjax::begin([
        'enablePushState' => false
    ]);
    ?>  
    <div class="box-body"> 
        <!------ flash message ------->
        <div class="row">
            <div class="col-md-12">
                <?php if (Yii::$app->session->hasFlash('loan_approved')): ?>
                    <?php
                    echo Growl::widget([
                        'type' => Growl::TYPE_SUCCESS,
                        'title' => 'Well done!',
                        'icon' => 'glyphicon glyphicon-ok-sign',
                        'body' => Yii::$app->session->getFlash('loan_approved'),
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
        <!------ box-body ----------->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Branch</th>
                    <th>Unit</th>
                    <th>Daily</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                if (count($loan_for_approval) > 0):
                    foreach ($loan_for_approval as $loan):
                        ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= strtoupper($loan['last_name'] . ', ' . $loan['first_name'] . ' ' . $loan['suffix'] . ' ' . $loan['middle_name']) ?></td>
                            <td><?= $loan['branch_description'] ?></td>
                            <td><?= $loan['unit'] ?></td>
                            <td><?= Yii::$app->formatter->asCurrency($loan['daily']) ?></td>
                            <td class="col-md-2">
                                <a class="btn btn-primary btn-sm" data-fullname="<?= strtoupper($loan['last_name'] . ', ' . $loan['first_name'] . ' ' . $loan['suffix'] . ' ' . $loan['middle_name']) ?>" data-loanid="<?= $loan['loan_id'] ?>" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i> View</a>
                                <a href="<?= Url::to(['site/releasingapproval', 'id' => $loan['loan_id']]) ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure to approve this loan?')"><i class="fa fa-check"></i> Approve</a>
                            </td>
                        </tr>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td class="alert-info" colspan="6" style="text-align: center;">No data to display</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php Pjax::end(); ?>
</div>
<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Loan No.:<span id = "title-text"></span></h3>
                <div class="modal-body">
                    <table class="table table-bordered table-responsive">
                            <tr>
                                <td>Borrower: </td>
                                <td id="fullname"></td>
                            </tr>
                            <tr>
                                <td>Daily:</td>
                                <td id="daily"></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var loan_id = button.data('loanid');
                var borrower_name = button.data('fullname');
                var modal = $(this);
                
                // ajax call to get loan details
                $.get('index.php?r=site/loandetails',{id:loan_id},function(data){
                    var loan = JSON.parse(data);
                    modal . find('#title-text') . text(loan.loan_no);
                    modal . find('#daily') . text(loan.daily);
                });
                modal.find('#fullname').text(borrower_name);
            }  
        )     
", View::POS_END);
?>
