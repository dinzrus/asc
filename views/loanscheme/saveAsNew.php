<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LoanScheme */

$this->title = 'Save As New Loan Scheme: '. ' ' . $model->loan_scheme_id;
$this->params['breadcrumbs'][] = ['label' => 'Loan Scheme', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->loan_scheme_id, 'url' => ['view', 'id' => $model->loan_scheme_id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="loan-scheme-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
