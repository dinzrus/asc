<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LoanschemeType */

$this->title = 'Update Loanscheme Type: ' . ' ' . $model->loanscheme_type_id;
$this->params['breadcrumbs'][] = ['label' => 'Loanscheme Type', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->loanscheme_type_id, 'url' => ['view', 'id' => $model->loanscheme_type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="loanscheme-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
