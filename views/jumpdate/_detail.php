<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Jumpdate */

?>
<div class="jumpdate-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->jump_id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'jump_id',
        'jump_date',
        'jump_description',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>