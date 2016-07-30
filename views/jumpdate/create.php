<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Jumpdate */

$this->title = 'Create Jumpdate';
$this->params['breadcrumbs'][] = ['label' => 'Jumpdate', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jumpdate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
