<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MunicipalityCity */

$this->title = 'Create Municipality City';
$this->params['breadcrumbs'][] = ['label' => 'Municipality City', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="municipality-city-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
