<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Branch */

$this->title = 'Save As New Branch: '. ' ' . $model->branch_id;
$this->params['breadcrumbs'][] = ['label' => 'Branch', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->branch_id, 'url' => ['view', 'id' => $model->branch_id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="branch-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
