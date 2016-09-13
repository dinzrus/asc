<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Business */

$this->title = 'Update Business: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Business', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="business-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
