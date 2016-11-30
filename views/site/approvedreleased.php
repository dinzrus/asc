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

$this->title = 'Approved for Release';
$this->params['breadcrumbs'][] = $this->title;
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
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <td><strong>#</strong></td>
                        <td><strong>Name</strong></td>
                        <td><strong>Daily</strong></td>
                        <td></td>
                    </tr>
                    <?php $cnt = 1; ?>
                    <?php foreach ($loans as $loan): ?>
                    <tr>
                        <td><?= $cnt ?></td>
                        <td><?= $loan['fullname'] ?></td>
                        <td><?= $loan['daily'] ?></td>
                        <td><a class="btn btn-primary btn-sm">Released</a></td>
                    </tr>
                    <?php $cnt++; ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>







