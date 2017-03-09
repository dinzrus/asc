<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\BorrowerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\Pjax;
use kartik\growl\Growl;

$this->title = 'Releasing Approval';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
Pjax::begin([
    'enablePushState' => false
]);
?>  

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

<div class="box box-default">
    <div class="box-header">
        <h4 class="box-title"><i class="fa fa-user"></i> New Borrowers</h4>
    </div>
    <div class="box-body">    
        <!------ box-body ----------->
        <?=
        GridView::widget([
            'dataProvider' => $newProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'fullname',
                'branch_description',
                'unit',
                'daily',
            ]
        ]);
        ?>
    </div>
    <?php Pjax::end(); ?>
</div>

<div class="box box-default">
    <div class="box-header">
        <h4 class="box-title"><i class="fa fa-user"></i> Renewal Borrowers</h4>
    </div>
    <div class="box-body">
        <?=
        GridView::widget([
            'dataProvider' => $renewalProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'fullname',
                'branch_description',
                'unit',
                'daily',
            ]
        ]);
        ?>
    </div>
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
