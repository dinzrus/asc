<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Canvasser */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-solid">
    <div class="box-body">
        <div class="canvasser-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->errorSummary($model); ?>

            <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <?= $form->field($model, 'fname')->textInput(['maxlength' => true, 'placeholder' => 'Fname']) ?>

            <?= $form->field($model, 'lname')->textInput(['maxlength' => true, 'placeholder' => 'Lname']) ?>

            <?= $form->field($model, 'middlename')->textInput(['maxlength' => true, 'placeholder' => 'Middlename']) ?>

            <?= $form->field($model, 'age')->textInput(['placeholder' => 'Age']) ?>

            <?=
            $form->field($model, 'birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Birthdate',
                        'autoclose' => true
                    ]
                ],
            ]);
            ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder' => 'Address']) ?>

            <?=
            $form->field($model, 'branch_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Branch::find()->orderBy('branch_id')->asArray()->all(), 'branch_id', 'branch_description'),
                'options' => ['placeholder' => 'Choose Branch'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
