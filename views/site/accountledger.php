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

$this->title = 'Accounts Ledger';
$this->params['breadcrumbs'][] = $this->title;

$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="box box-primary">
    <div class="box-body">  
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
        <?php Pjax::begin(); ?>      
        <div class="search-form">
            <div class="search-form">
                <?= $this->render('_ledgersearch', ['model' => $borrowersearch]); ?>
            </div>
        </div>

        <br>
        <table class="table table-condensed table-bordered table-responsive">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <?php if (strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN'): ?>
                        <th>Branch</th>
                    <?php endif; ?>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                if (count($borrowers) > 0) :
                    foreach ($borrowers as $li):
                        ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= strtoupper($li->fullname) ?></td>
                            <?php if (strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN'): ?>
                                <td><?= $li->branch->branch_description ?></td>
                            <?php endif; ?>
                            <td><a data-idd="<?= $li->id ?>" data-branch = "<?= $li->branch_id ?>" data-name="<?= $li->fullname ?>" type="button" class="btn btn-instagram btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i>&nbsp; View Accounts</a></td>
                            <?php $counter++; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td class="alert-info" colspan="6" style="text-align: center;">No data to display</td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>
        <?php Pjax::end(); ?>
    </div>
</div>

<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="get">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 style="text-align: center; font-weight: bold; color: blue;">LOAN HISTORY</h3>
                    <i style="float: left; margin: 6px 3px" class="fa fa-user"></i> <h4 style="float: left; font-weight: bold;" class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">    
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <td><strong>#</strong></td>
                            <td><strong>Account No.</strong></td>
                            <td><strong>Release Date</strong></td>
                            <td><strong>Loan Type</strong></td>
                            <td><strong>Unit</strong></td>
                            <td><strong>View Ledger</strong></td>
                        </tr>
                        <tr>
                            <td>1</td> 
                            <td>TSJ15166FDGD</td> 
                            <td>11/18/2016</td> 
                            <td>ERP-CELP</td> 
                            <td>T1</td> 
                            <td><a href="#"><i class="fa fa-eye"></i></a></td> 
                        </tr>
                        <tr>
                            <td>1</td> 
                            <td>TSJ15166FDGD</td> 
                            <td>11/18/2016</td> 
                            <td>ERP-CELP</td> 
                            <td>T1</td> 
                            <td><a href="#"><i class="fa fa-eye"></i></a></td> 
                        </tr>
                        <tr>
                            <td>1</td> 
                            <td>TSJ15166FDGD</td> 
                            <td>11/18/2016</td> 
                            <td>ERP-CELP</td> 
                            <td>T1</td> 
                            <td><a href="#"><i class="fa fa-eye"></i></a></td> 
                        </tr>
                        <tr>
                            <td>1</td> 
                            <td>TSJ15166FDGD</td> 
                            <td>11/18/2016</td> 
                            <td>ERP-CELP</td> 
                            <td>T1</td> 
                            <td><a href="#"><i class="fa fa-eye"></i></a></td> 
                        </tr>
                        <tr>
                            <td>1</td> 
                            <td>TSJ15166FDGD</td> 
                            <td>11/18/2016</td> 
                            <td>ERP-CELP</td> 
                            <td>T1</td> 
                            <td><a href="#"><i class="fa fa-eye"></i></a></td> 
                        </tr>
                        <tr>
                            <td>1</td> 
                            <td>TSJ15166FDGD</td> 
                            <td>11/18/2016</td> 
                            <td>ERP-CELP</td> 
                            <td>T1</td> 
                            <td><a href="#"><i class="fa fa-eye"></i></a></td> 
                        </tr>
                        <tr>
                            <td>1</td> 
                            <td>TSJ15166FDGD</td> 
                            <td>11/18/2016</td> 
                            <td>ERP-CELP</td> 
                            <td>T1</td> 
                            <td><a href="#"><i class="fa fa-eye"></i></a></td> 
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </form>
        </div>
    </div>
</div>


<?php
$this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var loan_id = button.data('loanid');
                var borrower_name = button.data('name');
                var modal = $(this);
                
                // ajax call to get loan details
                $.get('index.php?r=site/loandetails',{id:loan_id},function(data){
                    var loan = JSON.parse(data);
                    
                    var r = $('<tr/>');
                    
                    

                    //modal . find('#title-text') . text(loan.loan_no);
                    //modal . find('#daily') . text(loan.daily);
                });
                // end ajax call 
                modal.find('.modal-title').text('BORROWER: ' + borrower_name.toUpperCase());
            }  
        )   
", View::POS_END);
?>


