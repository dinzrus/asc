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
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    </div>
    <?php Pjax::end(); ?>
</div>
