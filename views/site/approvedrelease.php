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
<?php Pjax::begin(['enablePushState' => false]) ?>
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
        <?php if (Yii::$app->session->hasFlash('hold_success')): ?>
            <?php
            echo Growl::widget([
                'type' => Growl::TYPE_INFO,
                'title' => 'Information!',
                'icon' => 'glyphicon glyphicon-ok-sign',
                'body' => Yii::$app->session->getFlash('hold_success'),
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
        <?php if (Yii::$app->session->hasFlash('cancel_success')): ?>
            <?php
            echo Growl::widget([
                'type' => Growl::TYPE_DANGER,
                'title' => 'Information!',
                'icon' => 'glyphicon glyphicon-ok-sign',
                'body' => Yii::$app->session->getFlash('cancel_success'),
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
        <div class="box box-primary">
            <div class="box-body">        
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <td><strong>#</strong></td>
                        <td><strong>Name</strong></td>
                        <td><strong>Daily</strong></td>
                        <td></td>
                    </tr>
                    <?php if (count($loans) > 0): ?>
                        <?php $cnt = 1; ?>
                        <?php foreach ($loans as $loan): ?>
                            <tr>
                                <td class="col-md-1"><?= $cnt ?></td>
                                <td class="col-md-4"><?= strtoupper($loan['fullname']) ?></td>
                                <td class="col-md-4"><?= $loan['daily'] ?></td>
                                <td class="col-md-3">
                                    <a href="<?= Url::to(['site/approvedrelease', 'loan_id' => $loan['loan_id'], 'action' => 'approved']) ?>" onclick="return confirm('Released loan to system?')" class="btn btn-success btn-sm"><i class="fa fa-thumbs-o-up"></i> Released</a>
                                    <a href="<?= Url::to(['site/approvedrelease', 'loan_id' => $loan['loan_id'], 'action' => 'hold']) ?>" onclick="return confirm('Hold this loan? Note: Hold accounts will be added to your sfr.')" class="btn btn-warning btn-sm"><i class="fa fa-hand-stop-o"></i> Hold</a>
                                    <a href="<?= Url::to(['site/approvedrelease', 'loan_id' => $loan['loan_id'], 'action' => 'cancel']) ?>" onclick="return confirm('Cancel this loan?')" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-remove"></i> Cancel</a>
                                </td>
                            </tr>
                            <?php $cnt++; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td class="alert-info" colspan="6" style="text-align: center;">No data to display</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php Pjax::end() ?>






