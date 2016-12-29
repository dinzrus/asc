<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Emposition */

$this->title = 'Update Emposition: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Emposition', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="emposition-update">

    <?= $this->render('_form', [
        'model' => $model,
        'employee' => $employee,
    ]) ?>

</div>
