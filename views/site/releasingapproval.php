<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\BorrowerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\web\View;
use yii\widgets\Pjax;

$this->title = 'Releasing Approval';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <?php Pjax::begin(); ?>  
    <div class="box-body"> 
        <!------ flash message ------->
        <div class="row">
            <div class="col-md-12">
                <?php if (Yii::$app->session->hasFlash('loanReleased')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> <?= Yii::$app->session->getFlash('loanReleased') ?></h4>           
                    </div>
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
                    <th>C.I. Officer</th>
                    <th>C.I. Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                if ($loan_for_approval > 0):
                    foreach ($loan_for_approval as $loan):
                        ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= strtoupper($loan['last_name'] . ', ' . $loan['first_name'] . ' ' . $loan['suffix'] . ' ' . $loan['middle_name'])?></td>
                            <td><?= $loan['branch_description'] ?></td>
                            <td><?= strtoupper($loan['ci_lname'] . ', ' . $loan['ci_fname'] . ' ' . $loan['ci_middlename'])  ?></td>
                            <td><?= Yii::$app->formatter->asDate($loan['ci_date']) ?></td>
                            <td>
                                <a href="" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</a>
                                <a href="<?= Url::to(['site/releasingapproval']) ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure to approve this loan?')"><i class="fa fa-check"></i> Approve</a>
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
