<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Province */

$this->title = 'Update Province: ' . ' ' . $model->province;
$this->params['breadcrumbs'][] = ['label' => 'Province', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->province, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="province-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
