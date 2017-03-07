<?php
/* @var $this yii\web\View */

use yii\bootstrap\Modal;
use yii\helpers\Html;

$this->title = 'Reports';

$this->params['breadcrumbs'][] = 'Reports';
?>
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <?=
                Html::a('<i class="fa fa-arrow-right"></i> Schedule for Releasing', ['/report/sfr'], [
                    'class' => 'btn btn-default',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
