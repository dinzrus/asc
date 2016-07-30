<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoanSchemeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loan-scheme-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'loan_scheme_id') ?>

    <?= $form->field($model, 'loanscheme_type') ?>

    <?= $form->field($model, 'daily') ?>

    <?= $form->field($model, 'term') ?>

    <?= $form->field($model, 'gross_day') ?>

    <?php // echo $form->field($model, 'gross_amount') ?>

    <?php // echo $form->field($model, 'interest') ?>

    <?php // echo $form->field($model, 'interest_amount') ?>

    <?php // echo $form->field($model, 'gas') ?>

    <?php // echo $form->field($model, 'doc_percentage') ?>

    <?php // echo $form->field($model, 'doc_stamp') ?>

    <?php // echo $form->field($model, 'mis_percentage') ?>

    <?php // echo $form->field($model, 'misc') ?>

    <?php // echo $form->field($model, 'admin_fee') ?>

    <?php // echo $form->field($model, 'notarial_fee') ?>

    <?php // echo $form->field($model, 'additional_fee') ?>

    <?php // echo $form->field($model, 'total_deductions') ?>

    <?php // echo $form->field($model, 'add_days') ?>

    <?php // echo $form->field($model, 'add_coll') ?>

    <?php // echo $form->field($model, 'net_proceeds') ?>

    <?php // echo $form->field($model, 'penalty') ?>

    <?php // echo $form->field($model, 'vat_interest') ?>

    <?php // echo $form->field($model, 'vat_amount') ?>

    <?php // echo $form->field($model, 'processing_fee') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
