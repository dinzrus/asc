<?php
/* @var $this yii\web\View */

use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title = 'C.I. Canvass Approval';

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
                    <th><a href="#" class="btn btn-social"><i class="fa fa-lg fa-thumbs-o-up "></i> Approve All</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;        
                foreach ($list as $li): ?>
                    <tr>
                        <td><?= $counter ?></td>
                        <td><?= $li['last_name'] . ', ' . $li['first_name'] . ' ' .  $li['middle_name'] ?></td>
                        <td><?= $li['branch_description'] ?></td>
                        <td><?= $li['lname'] . ', ' . $li['fname'] .' '.  $li['middlename'] ?></td>
                        <td><?= $li['canvass_date'] ?></td>
                        <td><a href="<?= Url::to(['/borrower/view', 'id' => $li['id']]); ?>" class="btn btn-success"><i class="glyphicon glyphicon-eye-open"></i></a> | <a href="<?= Url::to(['borrower/approvedcicanvass', 'id' => $li['id']]); ?>" class="btn btn-primary"><i class="fa fa-thumbs-o-up "></i></a> | <a href="<?= Url::to(['borrower/deniedcicanvass', 'id' => $li['id']]); ?>" class="btn btn-danger"><i class="fa fa-thumbs-o-down "></i></a></td>
                        <?php $counter++;  ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
