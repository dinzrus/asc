<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LoanschemeValues */

$this->title = 'Update Loanscheme Values: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Loanscheme Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="loanscheme-values-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
