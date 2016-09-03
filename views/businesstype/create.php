<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BusinessType */

$this->title = 'Create Business Type';
$this->params['breadcrumbs'][] = ['label' => 'Business Type', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
