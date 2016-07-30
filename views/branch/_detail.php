<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Branch */

?>
<div class="branch-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->branch_id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'branch_id',
        'branch_description',
        'address',
        'telephone_no',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>