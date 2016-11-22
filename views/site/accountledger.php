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
                            <td><a data-borrowerid="<?= $li->id ?>" data-branch = "<?= $li->branch_id ?>" data-name="<?= $li->fullname ?>" type="button" class="btn btn-instagram btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i>&nbsp; View Accounts</a></td>
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
$this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var borrower_id = button.data('borrowerid');
                var borrower_name = button.data('name');
                var modal = $(this);
                
                $('#account-list').find('tr:gt(0)').remove();
                
                var table = document.getElementById('account-list');
                var ctr = 1;
                
                // ajax call to get loan details
                $.get('index.php?r=site/loandetails',{id:borrower_id},function(data){
                    var loan = JSON.parse(data);
                 
                    for (var i = 0; i < loan.length; i++) {
                       var row = table.insertRow(i+1); 
                       var c1 = row.insertCell(0);
                       var c2 = row.insertCell(1);
                       var c3 = row.insertCell(2);
                       var c4 = row.insertCell(3);
                       var c5 = row.insertCell(4);
                       var c6 = row.insertCell(5);
                       var c7 = row.insertCell(6);
                       
                       c1.innerHTML = ctr;
                       c2.innerHTML = loan[i].loan_no;
                       c3.innerHTML = loan[i].release_date;
                       c4.innerHTML = loan[i].maturity_date;
                       c5.innerHTML = loan[i].loan_type;
                       c6.innerHTML = loan[i].unit;
                        
                       c7.innerHTML = '<a>View</a>';
                       
                       ctr++;
                    }
                    
                    if (loan.length == 0) {
                       var row = table.insertRow(i+1); 
                       var c1 = row.insertCell(0);
                       c1.innerHTML = 'No data!';
                    }

                    //modal . find('#title-text') . text(loan.loan_no);
                    //modal . find('#daily') . text(loan.daily);
                });
                // end ajax call 
                modal.find('.modal-title').text('BORROWER: ' + borrower_name.toUpperCase());
            }  
        )   
", View::POS_END);
?>


