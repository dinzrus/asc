<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'New Borrowers'
?>
<div class="box  box-solid">
    <div class="box-header">
        <div class="row">
            <div class="col-md-12">
                <?=
                Html::a('<span class="fa fa-plus"></span> New', Url::to(['site/canvass']), [
                    'class' => 'btn btn-success'
                ])
                ?>
                <?=
                Html::a('<span class="fa fa-print"></span> Print', Url::to(['site/canvass']), [
                    'class' => 'btn btn-default pull-right'
                ])
                ?>
            </div>
        </div>
    </div>
    <div class="box-body">
        <?=
        GridView::widget([
            'dataProvider' => $newborrowers,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'last_name',
                'first_name',
                'middle_name',
                'canvass_date:date',
            ]
        ])
        ?>
    </div>
</div>



