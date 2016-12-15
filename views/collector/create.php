<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Collector */

$this->title = 'Create Collector';
$this->params['breadcrumbs'][] = ['label' => 'Collector', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collector-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
