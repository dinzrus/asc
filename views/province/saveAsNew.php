<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Province */

$this->title = 'Save As New Province: '. ' ' . $model->province;
$this->params['breadcrumbs'][] = ['label' => 'Province', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->province, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="province-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
