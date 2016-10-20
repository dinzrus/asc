<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comaker */
/* @var $form ActiveForm */
?>
<div class="site-comakerform">

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
        <?= $form->field($model, 'ci_date') ?>
        <?= $form->field($model, 'canvass_date') ?>
        <?= $form->field($model, 'spouse_birthdate') ?>
        <?= $form->field($model, 'created_at') ?>
        <?= $form->field($model, 'updated_at') ?>
        <?= $form->field($model, 'spouse_age') ?>
        <?= $form->field($model, 'no_dependent') ?>
        <?= $form->field($model, 'branch_id') ?>
        <?= $form->field($model, 'collaterals') ?>
        <?= $form->field($model, 'attachment') ?>
        <?= $form->field($model, 'profile_pic') ?>
        <?= $form->field($model, 'suffix') ?>
        <?= $form->field($model, 'tin_no') ?>
        <?= $form->field($model, 'sss_no') ?>
        <?= $form->field($model, 'ctc_no') ?>
        <?= $form->field($model, 'license_no') ?>
        <?= $form->field($model, 'spouse_name') ?>
        <?= $form->field($model, 'spouse_occupation') ?>
        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'acount_type') ?>
        <?= $form->field($model, 'comaker_pic') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-comakerform -->
