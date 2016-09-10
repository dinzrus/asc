<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BusinessSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-business-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'business_name')->textInput(['maxlength' => true, 'placeholder' => 'Business Name']) ?>

    <?= $form->field($model, 'business_type_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\BusinessType::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Business type'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'address_province_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Province::find()->orderBy('id')->asArray()->all(), 'id', 'province'),
        'options' => ['placeholder' => 'Choose Province'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'address_city_municipality_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\MunicipalityCity::find()->orderBy('id')->asArray()->all(), 'id', 'municipality_city'),
        'options' => ['placeholder' => 'Choose Municipality city'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php /* echo $form->field($model, 'address_barangay_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Barangay::find()->orderBy('id')->asArray()->all(), 'id', 'barangay'),
        'options' => ['placeholder' => 'Choose Barangay'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'address_st_bldng_no')->textInput(['maxlength' => true, 'placeholder' => 'Address St Bldng No']) */ ?>

    <?php /* echo $form->field($model, 'business_years')->textInput(['placeholder' => 'Business Years']) */ ?>

    <?php /* echo $form->field($model, 'permit_no')->textInput(['maxlength' => true, 'placeholder' => 'Permit No']) */ ?>

    <?php /* echo $form->field($model, 'average_weekly_income')->textInput(['placeholder' => 'Average Weekly Income']) */ ?>

    <?php /* echo $form->field($model, 'average_gross_daily_income')->textInput(['placeholder' => 'Average Gross Daily Income']) */ ?>

    <?php /* echo $form->field($model, 'ownership')->textInput(['maxlength' => true, 'placeholder' => 'Ownership']) */ ?>

    <?php /* echo $form->field($model, 'borrower_id')->textInput(['placeholder' => 'Borrower']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
