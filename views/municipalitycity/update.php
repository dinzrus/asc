<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MunicipalityCity */

$this->title = 'Update Municipality City: ' . ' ' . $model->municipality_city;
$this->params['breadcrumbs'][] = ['label' => 'Municipality City', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->municipality_city, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="municipality-city-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
