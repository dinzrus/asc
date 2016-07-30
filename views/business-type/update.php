<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BusinessType */

$this->title = 'Update Business Type: ' . ' ' . $model->business_id;
$this->params['breadcrumbs'][] = ['label' => 'Business Type', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->business_id, 'url' => ['view', 'id' => $model->business_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="business-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
