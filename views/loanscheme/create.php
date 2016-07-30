<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LoanScheme */

$this->title = 'Create Loan Scheme';
$this->params['breadcrumbs'][] = ['label' => 'Loan Scheme', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-scheme-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
