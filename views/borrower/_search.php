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

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'profile_pic')->textInput(['maxlength' => true, 'placeholder' => 'Profile Pic']) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'placeholder' => 'First Name']) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeholder' => 'Last Name']) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true, 'placeholder' => 'Middle Name']) ?>

    <?php /* echo $form->field($model, 'suffix')->textInput(['maxlength' => true, 'placeholder' => 'Suffix']) */ ?>

    <?php /* echo $form->field($model, 'birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Birthdate',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'age')->textInput(['placeholder' => 'Age']) */ ?>

    <?php /* echo $form->field($model, 'birthplace')->textInput(['maxlength' => true, 'placeholder' => 'Birthplace']) */ ?>

    <?php /* echo $form->field($model, 'address_province_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Province::find()->orderBy('id')->asArray()->all(), 'id', 'province'),
        'options' => ['placeholder' => 'Choose Province'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'address_city_municipality_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MunicipalityCity::find()->orderBy('id')->asArray()->all(), 'id', 'municipality_city'),
        'options' => ['placeholder' => 'Choose Municipality city'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'address_barangay_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Barangay::find()->orderBy('id')->asArray()->all(), 'id', 'barangay'),
        'options' => ['placeholder' => 'Choose Barangay'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'address_street_house_no')->textInput(['maxlength' => true, 'placeholder' => 'Address Street House No']) */ ?>

    <?php /* echo $form->field($model, 'civil_status')->textInput(['maxlength' => true, 'placeholder' => 'Civil Status']) */ ?>

    <?php /* echo $form->field($model, 'contact_no')->textInput(['maxlength' => true, 'placeholder' => 'Contact No']) */ ?>

    <?php /* echo $form->field($model, 'ci_date')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Ci Date',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'canvass_date')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Canvass Date',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'tin_no')->textInput(['maxlength' => true, 'placeholder' => 'Tin No']) */ ?>

    <?php /* echo $form->field($model, 'sss_no')->textInput(['maxlength' => true, 'placeholder' => 'Sss No']) */ ?>

    <?php /* echo $form->field($model, 'ctc_no')->textInput(['maxlength' => true, 'placeholder' => 'Ctc No']) */ ?>

    <?php /* echo $form->field($model, 'license_no')->textInput(['maxlength' => true, 'placeholder' => 'License No']) */ ?>

    <?php /* echo $form->field($model, 'spouse_name')->textInput(['maxlength' => true, 'placeholder' => 'Spouse Name']) */ ?>

    <?php /* echo $form->field($model, 'spouse_occupation')->textInput(['maxlength' => true, 'placeholder' => 'Spouse Occupation']) */ ?>

    <?php /* echo $form->field($model, 'spouse_age')->textInput(['placeholder' => 'Spouse Age']) */ ?>

    <?php /* echo $form->field($model, 'spouse_birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Spouse Birthdate',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'no_dependent')->textInput(['placeholder' => 'No Dependent']) */ ?>

    <?php /* echo $form->field($model, 'collaterals')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'status')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Status::find()->orderBy('code')->asArray()->all(), 'code', 'status'),
        'options' => ['placeholder' => 'Choose Status'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'branch_id')->textInput(['placeholder' => 'Branch']) */ ?>

    <?php /* echo $form->field($model, 'attachment')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'relation_to_applicant')->textInput(['maxlength' => true, 'placeholder' => 'Relation To Applicant']) */ ?>

    <?php /* echo $form->field($model, 'acount_type')->textInput(['maxlength' => true, 'placeholder' => 'Acount Type']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
