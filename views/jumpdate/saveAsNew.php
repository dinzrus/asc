<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Jumpdate */

$this->title = 'Save As New Jumpdate: '. ' ' . $model->jump_id;
$this->params['breadcrumbs'][] = ['label' => 'Jumpdate', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jump_id, 'url' => ['view', 'id' => $model->jump_id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="jumpdate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
