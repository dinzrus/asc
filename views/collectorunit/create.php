<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Collectorunit */

$this->title = 'Add assignment';
$this->params['breadcrumbs'][] = ['label' => 'Collector assignment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collectorunit-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
