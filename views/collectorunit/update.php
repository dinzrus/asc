<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Collectorunit */

$this->title = 'Update Collectorunit: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Collectorunit', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="collectorunit-update">

    <?= $this->render('_form', [
        'model' => $model,
        'collectors' => $collectors,
    ]) ?>

</div>
