<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\BorrowerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\web\View;

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
        <label for="srcword">Search</label>
        <form action="<?= Url::to(['/']); ?>" method="get">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search text" name="srcword">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </div>

        </form>
        <br>
        <table class="table table-condensed table-bordered">
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
                            <td><?= $li->fullname ?></td>
                            <td><?= $li->branch->branch_description ?></td>
                            <td><?= $li->canvasser->lname . ', ' . $li->canvasser->fname . ' ' . $li->canvasser->middlename ?></td>
                            <td><?= $li['canvass_date'] ?></td>
                            <td><a data-id="<?= $li->id ?>" data-name="<?= $li->fullname ?>" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-ok"></i>&nbsp; Schedule</a></td>
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
        <?=
        LinkPager::widget([
            'pagination' => $pagination,
        ]);
        ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="font-weight: bold"></h4>
            </div>
            <div class="modal-body">
                <label for="">Loan Type</label>
                <input type="text" name="recipient" class="form-control">
                <label for="">Daily</label>
                <input type="text" name="recipient" class="form-control">
                <label for="">Unit</label>
                <input type="text" name="recipient" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Schedule</button>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var recipient = button.data('id');
            var fname = button.data('name');
            
            $.get('index.php?r=site/test',{ id:recipient } , function(data) {
                alert(data);
            } );

            var modal = $(this);
            modal.find('.modal-title').text('Schedule: ' + fname);
            modal.find('.modal-body input').val(recipient);
          }
)", View::POS_END);
?>

    
