<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Emposition */

$this->title = 'New Employee Position';
$this->params['breadcrumbs'][] = ['label' => 'Employee Position', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emposition-create">


    <?= $this->render('_form', [
        'model' => $model,
        'employee' => $employee,
    ]) ?>

</div>
