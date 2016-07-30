<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BorrowerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-borrower-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'borrower_id')->textInput(['placeholder' => 'Borrower']) ?>

    <?= $form->field($model, 'principal_profile_pic')->textInput(['maxlength' => true, 'placeholder' => 'Principal Profile Pic']) ?>

    <?= $form->field($model, 'principal_first_name')->textInput(['maxlength' => true, 'placeholder' => 'Principal First Name']) ?>

    <?= $form->field($model, 'principal_last_name')->textInput(['maxlength' => true, 'placeholder' => 'Principal Last Name']) ?>

    <?= $form->field($model, 'principal_middle_name')->textInput(['maxlength' => true, 'placeholder' => 'Principal Middle Name']) ?>

    <?php /* echo $form->field($model, 'principal__suffix')->textInput(['maxlength' => true, 'placeholder' => 'Principal  Suffix']) */ ?>

    <?php /* echo $form->field($model, 'principal_birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Principal Birthdate',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'principal_age')->textInput(['placeholder' => 'Principal Age']) */ ?>

    <?php /* echo $form->field($model, 'principal_birthplace')->textInput(['maxlength' => true, 'placeholder' => 'Principal Birthplace']) */ ?>

    <?php /* echo $form->field($model, 'principal_address_street_house')->textInput(['maxlength' => true, 'placeholder' => 'Principal Address Street House']) */ ?>

    <?php /* echo $form->field($model, 'principal_address_barangay')->textInput(['maxlength' => true, 'placeholder' => 'Principal Address Barangay']) */ ?>

    <?php /* echo $form->field($model, 'principal_address_province')->textInput(['maxlength' => true, 'placeholder' => 'Principal Address Province']) */ ?>

    <?php /* echo $form->field($model, 'principal_civil_status')->textInput(['maxlength' => true, 'placeholder' => 'Principal Civil Status']) */ ?>

    <?php /* echo $form->field($model, 'principal_contact_no')->textInput(['maxlength' => true, 'placeholder' => 'Principal Contact No']) */ ?>

    <?php /* echo $form->field($model, 'principal_business_type')->textInput(['placeholder' => 'Principal Business Type']) */ ?>

    <?php /* echo $form->field($model, 'principal_ci_date')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Principal Ci Date',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'principal_canvass_date')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Principal Canvass Date',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'principal_tin_no')->textInput(['maxlength' => true, 'placeholder' => 'Principal Tin No']) */ ?>

    <?php /* echo $form->field($model, 'principal_sss_no')->textInput(['maxlength' => true, 'placeholder' => 'Principal Sss No']) */ ?>

    <?php /* echo $form->field($model, 'principal_ctc_no')->textInput(['maxlength' => true, 'placeholder' => 'Principal Ctc No']) */ ?>

    <?php /* echo $form->field($model, 'principal_license_no')->textInput(['maxlength' => true, 'placeholder' => 'Principal License No']) */ ?>

    <?php /* echo $form->field($model, 'principal_spouse_name')->textInput(['maxlength' => true, 'placeholder' => 'Principal Spouse Name']) */ ?>

    <?php /* echo $form->field($model, 'principal_spouse_occupation')->textInput(['maxlength' => true, 'placeholder' => 'Principal Spouse Occupation']) */ ?>

    <?php /* echo $form->field($model, 'principal_spouse_age')->textInput(['placeholder' => 'Principal Spouse Age']) */ ?>

    <?php /* echo $form->field($model, 'principal_spouse_birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Principal Spouse Birthdate',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'principal_no_children')->textInput(['placeholder' => 'Principal No Children']) */ ?>

    <?php /* echo $form->field($model, 'principal_child1_name')->textInput(['maxlength' => true, 'placeholder' => 'Principal Child1 Name']) */ ?>

    <?php /* echo $form->field($model, 'principal_child2_name')->textInput(['maxlength' => true, 'placeholder' => 'Principal Child2 Name']) */ ?>

    <?php /* echo $form->field($model, 'principal_child1_birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Principal Child1 Birthdate',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'principal_child2_birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Principal Child2 Birthdate',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'principal_child1_age')->textInput(['placeholder' => 'Principal Child1 Age']) */ ?>

    <?php /* echo $form->field($model, 'principal_child2_age')->textInput(['placeholder' => 'Principal Child2 Age']) */ ?>

    <?php /* echo $form->field($model, 'comaker_profile_pic')->textInput(['maxlength' => true, 'placeholder' => 'Comaker Profile Pic']) */ ?>

    <?php /* echo $form->field($model, 'comaker_name')->textInput(['maxlength' => true, 'placeholder' => 'Comaker Name']) */ ?>

    <?php /* echo $form->field($model, 'comaker_address')->textInput(['maxlength' => true, 'placeholder' => 'Comaker Address']) */ ?>

    <?php /* echo $form->field($model, 'comaker_alias')->textInput(['maxlength' => true, 'placeholder' => 'Comaker Alias']) */ ?>

    <?php /* echo $form->field($model, 'comaker_contact')->textInput(['maxlength' => true, 'placeholder' => 'Comaker Contact']) */ ?>

    <?php /* echo $form->field($model, 'comaker_occupation')->textInput(['maxlength' => true, 'placeholder' => 'Comaker Occupation']) */ ?>

    <?php /* echo $form->field($model, 'comaker_birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Comaker Birthdate',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'comaker_age')->textInput(['placeholder' => 'Comaker Age']) */ ?>

    <?php /* echo $form->field($model, 'comaker_relation')->textInput(['maxlength' => true, 'placeholder' => 'Comaker Relation']) */ ?>

    <?php /* echo $form->field($model, 'business_name')->textInput(['maxlength' => true, 'placeholder' => 'Business Name']) */ ?>

    <?php /* echo $form->field($model, 'business_address')->textInput(['maxlength' => true, 'placeholder' => 'Business Address']) */ ?>

    <?php /* echo $form->field($model, 'business_type')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\BusinessType::find()->orderBy('business_id')->asArray()->all(), 'business_id', 'business_id'),
        'options' => ['placeholder' => 'Choose Business type'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'business_years')->textInput(['placeholder' => 'Business Years']) */ ?>

    <?php /* echo $form->field($model, 'business_income')->textInput(['placeholder' => 'Business Income']) */ ?>

    <?php /* echo $form->field($model, 'collaterals')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'status')->textInput(['placeholder' => 'Status']) */ ?>

    <?php /* echo $form->field($model, 'branch')->textInput(['placeholder' => 'Branch']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
