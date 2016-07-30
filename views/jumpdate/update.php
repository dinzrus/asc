<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jumpdate */

$this->title = 'Update Jumpdate: ' . ' ' . $model->jump_id;
$this->params['breadcrumbs'][] = ['label' => 'Jumpdate', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jump_id, 'url' => ['view', 'id' => $model->jump_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jumpdate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
