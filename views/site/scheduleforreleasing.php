<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\BorrowerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;

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
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Branch</th>
                    <th>Canvasser</th>
                    <th>Canvass Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;

                if (count($list) > 0) :
                    foreach ($list as $li):
                        ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= $li['last_name'] . ', ' . $li['first_name'] . ' ' . $li['middle_name'] ?></td>
                            <td><?= $li['branch_description'] ?></td>
                            <td><?= $li['lname'] . ', ' . $li['fname'] . ' ' . $li['middlename'] ?></td>
                            <td><?= $li['canvass_date'] ?></td>
                            <td><a href="<?= Url::to(['/borrower/view', 'id' => $li['id']]); ?>" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i>&nbsp; Schedule</a></td>
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
    </div>
</div>



