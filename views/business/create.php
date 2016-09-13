<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Business */

$this->title = 'Create Business';
$this->params['breadcrumbs'][] = ['label' => 'Business', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
