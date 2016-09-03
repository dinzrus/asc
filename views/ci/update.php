<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ci */

$this->title = 'Update Ci: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ci', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ci-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
