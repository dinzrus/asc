<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Loanscheme */

$this->title = 'Update Loanscheme: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Loanscheme', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="loanscheme-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
