<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Emposition */

$this->title = 'Create Emposition';
$this->params['breadcrumbs'][] = ['label' => 'Emposition', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emposition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
