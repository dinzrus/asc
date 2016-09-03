<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LoanType */

$this->title = 'Create Loan Type';
$this->params['breadcrumbs'][] = ['label' => 'Loan Type', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
