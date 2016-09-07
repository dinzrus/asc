<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Exceltest */
/* @var $form ActiveForm */
?>
<div class="site-excelupload">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'daily') ?>
        <?= $form->field($model, 'gross_amt') ?>
        <?= $form->field($model, 'interest') ?>
        <?= $form->field($model, 'vat') ?>
        <?= $form->field($model, 'notarial') ?>
        <?= $form->field($model, 'processing_fee') ?>
        <?= $form->field($model, 'total_deductions') ?>
        <?= $form->field($model, 'add_coll') ?>
        <?= $form->field($model, 'net_proceeds') ?>
        <?= $form->field($model, 'penalty') ?>
        <?= $form->field($model, 'term') ?>
        <?= $form->field($model, 'add_days') ?>
        <?= $form->field($model, 'pen_days') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-excelupload -->
