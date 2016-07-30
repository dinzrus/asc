<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-employee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'employee_id')->textInput(['placeholder' => 'Employee']) ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true, 'placeholder' => 'Firstname']) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'placeholder' => 'Lastname']) ?>

    <?= $form->field($model, 'middlename')->textInput(['maxlength' => true, 'placeholder' => 'Middlename']) ?>

    <?= $form->field($model, 'birth_date')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Birth Date',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?php /* echo $form->field($model, 'gender')->textInput(['maxlength' => true, 'placeholder' => 'Gender']) */ ?>

    <?php /* echo $form->field($model, 'civil_status')->textInput(['maxlength' => true, 'placeholder' => 'Civil Status']) */ ?>

    <?php /* echo $form->field($model, 'home_address')->textInput(['maxlength' => true, 'placeholder' => 'Home Address']) */ ?>

    <?php /* echo $form->field($model, 'sss_no')->textInput(['maxlength' => true, 'placeholder' => 'Sss No']) */ ?>

    <?php /* echo $form->field($model, 'philhealth_no')->textInput(['maxlength' => true, 'placeholder' => 'Philhealth No']) */ ?>

    <?php /* echo $form->field($model, 'tin_no')->textInput(['maxlength' => true, 'placeholder' => 'Tin No']) */ ?>

    <?php /* echo $form->field($model, 'profile_pic')->textInput(['maxlength' => true, 'placeholder' => 'Profile Pic']) */ ?>

    <?php /* echo $form->field($model, 'contact_no')->textInput(['maxlength' => true, 'placeholder' => 'Contact No']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
