<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LoanScheme */

$this->title = 'Update Loan Scheme: ' . ' ' . $model->loan_scheme_id;
$this->params['breadcrumbs'][] = ['label' => 'Loan Scheme', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->loan_scheme_id, 'url' => ['view', 'id' => $model->loan_scheme_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="loan-scheme-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
