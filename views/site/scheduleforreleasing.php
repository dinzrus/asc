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

$this->title = 'Schedule for Releasing';
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
                <?= $this->render('_search', ['model' => $borrowersearch]); ?>
            </div>
        </div>

        <br>
        <table class="table table-condensed table-bordered">
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
                            <td class="col-md-1"><?= $counter ?></td>
                            <td class="col-md-7"><?= strtoupper($li->fullname) ?></td>
                            <?php if (strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN'): ?>
                                <td><?= $li->branch->branch_description ?></td>
                            <?php endif; ?>
                            <td class="col-md-2"><a data-idd="<?= $li->id ?>" data-branch = "<?= $li->branch_id ?>" data-name="<?= $li->fullname ?>" type="button" class="btn btn-instagram btn-sm" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-ok"></i>&nbsp; Schedule</a></td>
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
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">    
                    <div class="row">
                        <div class="col-md-4">
                            <?= Html::hiddenInput('id', null, ['class' => 'clnts_id']) ?>
                            <label for="">Loan Type</label>
                            <select class="form-control" name="loantype">
                                <?php foreach ($loantype as $lt): ?>
                                    <option value="<?= $lt->loan_id ?>"><?= $lt->loan_description ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Daily</label>
                            <div  id="daily"></div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Unit</label>
                            <div id="unit"></div>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>

                        </div>
                        <div class="col-md-6">
                            <?= Html::a('<i class="fa fa-calendar"></i> Schedule', Url::to(['site/schedulerelease']), ['class' => 'btn btn-primary btn-block', 'onclick' => 'javascript:addURL(this);']) ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php $this->registerJsFile("@web/js/scheduleforreleasing.js", ['depends' => [\yii\web\JqueryAsset::className()]]); ?>



