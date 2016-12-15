<?php
/* @var $this yii\web\View */

use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title = 'Hold for Scheduling';

$this->params['breadcrumbs'][] = $this->title;
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
                    <th>Action</th>
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
                            <td><?= $li['canvasser_lname'] . ', ' . $li['canvasser_fname'] . ' ' . $li['canvasser_middlename'] ?></td>
                            <td><?= $li['canvass_date'] ?></td>
                            <td><a href="<?= Url::to(['/borrower/view', 'id' => $li['id']]); ?>" class="btn btn-success"><i class="glyphicon glyphicon-eye-open"></i></a> | <a href="<?= Url::to(['borrower/approvedcicanvass', 'id' => $li['id']]); ?>" class="btn btn-primary" onclick="return confirm('Approved canvass?')"><i class="fa fa-thumbs-o-up "></i></a></td>
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
