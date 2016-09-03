<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Canvasser */

$this->title = 'Update Canvasser: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Canvasser', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="canvasser-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
