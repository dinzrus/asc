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

$this->title = 'Borrowers';
$this->params['breadcrumbs'][] = $this->title;

$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="box box-primary">
    <div class="box-body">  
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
                            <td><a type="button" href="<?= Url::to(['site/ledger', 'id' => $li->id]) ?>" class="btn btn-instagram btn-sm"><i class="fa fa-eye"></i>&nbsp; View Accounts</a></td>
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



