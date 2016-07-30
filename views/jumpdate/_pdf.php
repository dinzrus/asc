<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Jumpdate */

$this->title = $model->jump_id;
$this->params['breadcrumbs'][] = ['label' => 'Jumpdate', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jumpdate-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Jumpdate'.' '. Html::encode($this->title) ?></h2>
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
