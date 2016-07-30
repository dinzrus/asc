<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LoanschemeType */

$this->title = 'Save As New Loanscheme Type: '. ' ' . $model->loanscheme_type_id;
$this->params['breadcrumbs'][] = ['label' => 'Loanscheme Type', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->loanscheme_type_id, 'url' => ['view', 'id' => $model->loanscheme_type_id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="loanscheme-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
