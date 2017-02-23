<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comaker */
/* @var $form ActiveForm */
?>
<div class="borrower-comaker_form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'first_name') ?>
        <?= $form->field($model, 'last_name') ?>
        <?= $form->field($model, 'middle_name') ?>
        <?= $form->field($model, 'birthdate') ?>
        <?= $form->field($model, 'age') ?>
        <?= $form->field($model, 'birthplace') ?>
        <?= $form->field($model, 'address_province_id') ?>
        <?= $form->field($model, 'address_city_municipality_id') ?>
        <?= $form->field($model, 'address_barangay_id') ?>
        <?= $form->field($model, 'address_street_house_no') ?>
        <?= $form->field($model, 'civil_status') ?>
        <?= $form->field($model, 'contact_no') ?>
        <?= $form->field($model, 'gender') ?>
        <?= $form->field($model, 'branch_id') ?>
        <?= $form->field($model, 'attachment') ?>
        <?= $form->field($model, 'profile_pic') ?>
        <?= $form->field($model, 'suffix') ?>
        <?= $form->field($model, 'status') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- borrower-comaker_form -->
