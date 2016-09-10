<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Barangay */

$this->title = 'Create Barangay';
$this->params['breadcrumbs'][] = ['label' => 'Barangay', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barangay-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
