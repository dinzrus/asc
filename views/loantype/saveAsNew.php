<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LoanType */

$this->title = 'Save As New Loan Type: '. ' ' . $model->loan_id;
$this->params['breadcrumbs'][] = ['label' => 'Loan Type', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->loan_id, 'url' => ['view', 'id' => $model->loan_id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="loan-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
