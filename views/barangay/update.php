<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Barangay */

$this->title = 'Update Barangay: ' . ' ' . $model->barangay;
$this->params['breadcrumbs'][] = ['label' => 'Barangay', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->barangay, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="barangay-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
