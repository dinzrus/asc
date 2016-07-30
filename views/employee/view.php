<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = " ";
$temptitle = $model->employee_id;
$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['index']];
$this->params['breadcrumbs'][] = $temptitle;
?>
<div class="employee-view">

    <div class="row">
        <div class="col-sm-9">

        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            <?=
            Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', ['pdf', 'id' => $model->employee_id], [
                'class' => 'btn btn-danger',
                'target' => '_blank',
                'data-toggle' => 'tooltip',
                'title' => 'Will open the generated PDF file in a new window'
                    ]
            )
            ?>

            <?= Html::a('Update', ['update', 'id' => $model->employee_id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $model->employee_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>
    <br/>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><strong>Name: <?= ucwords($model->lastname . ', ' . $model->firstname) ?></strong></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <center>
                        <?= Html::img($model->profile_pic, ['width' => 200, 'class' => 'img-thumbnail']) ?>
                    </center>
                </div>

                <div class="col-md-8">
                    <?php
                    $gridColumn = [
                        'employee_id',
                        'firstname',
                        'lastname',
                        'middlename',
                        'birth_date',
                        'gender',
                        'civil_status',
                        'home_address',
                        'sss_no',
                        'philhealth_no',
                        'tin_no',
                        //'profile_pic',
                        'contact_no',
                    ];
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => $gridColumn
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>