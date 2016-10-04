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
                            <td><a data-idd="<?= $li->id ?>" data-branch = "<?= $li->branch_id ?>" data-name="<?= $li->fullname ?>" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-ok"></i>&nbsp; Schedule</a></td>
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
<form action="<?= Url::to(['site/schedulerelease/']); ?>" method="get">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="font-weight: bold"></h4>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>

        </div>
    </div>
</form>

<?php
$this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var recipient = button.data('idd');
            var fname = button.data('name');
            var branch = button.data('branch');
            var modal = $(this);
            
            $.get('index.php?r=site/test',{ id:recipient, branch:branch }, function(data) {
                var jsn = JSON.parse(data);
                // alert(data);
                var d1 = jsn[0];
                var d2 = jsn[1];
                
                // dropdown for daily and unit ----------------------------------
                var s = $('<select/>');
                var x = $('<select/>');
                
                s.addClass('form-control daily');
                s.attr('name','daily');
                
                x.addClass('form-control unit');
                x.attr('name','unit');
                
                for(var key in d1) {
                    $('<option />', {value: d1[key].id, text: d1[key].daily}).appendTo(s);
                }
                
                for(var key in d2) {
                    $('<option />', {value: d2[key].unit_id, text: d2[key].unit_description}).appendTo(x);
                }
                //-----------------------------------------------------
                
                $('.daily').remove();
                s.appendTo('#daily');
                
                $('.unit').remove();
                x.appendTo('#unit');

                } );

                modal . find('.modal-title') . text('Schedule: ' + fname);
                modal . find('.clnts_id').val(recipient);
                //modal.find('.modal-body input').val(recipient);
            }
)", View::POS_END);
?>


