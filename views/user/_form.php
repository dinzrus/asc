<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="panel panel-primary">
        <div class="panel-heading"></div>
        <div class="panel-body">
            <?= $form->errorSummary($model); ?>

            <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <div class="row">
                <div class="col-md-4">
                    <?php
                    echo $form->field($model, 'photo')->widget(FileInput::classname(), [
                        'pluginOptions' => [
                            'initialPreview' => [
                                empty($model->picture) ? 'fileupload/default.jpg' : $model->picture
                            ],
                            'initialPreviewAsData' => true,
                            'overwriteInitial' => true,
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                            'browseLabel' => 'Select Photo',
                            'maxFileSize' => 250,
                        ],
                        'options' => ['accept' => 'image/*']
                    ]);
                    ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Username']) ?>
                    
                    <?= $form->field($model, 'pass')->textInput(['maxlength' => true, 'placeholder' => 'Password']) ?>

                    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>

                    <?=
                    $form->field($model, 'branch_id')->widget(\kartik\widgets\Select2::classname(), [
                        'data' => \yii\helpers\ArrayHelper::map(\app\models\Branch::find()->orderBy('branch_id')->asArray()->all(), 'branch_id', 'branch_description'),
                        'options' => ['placeholder' => 'Choose Branch'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>

                    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true, 'placeholder' => 'Firstname']) ?>

                    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'placeholder' => 'Lastname']) ?>

                    <?= $form->field($model, 'middlename')->textInput(['maxlength' => true, 'placeholder' => 'Middlename']) ?>

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

                    <?= $form->field($model, 'age')->textInput(['placeholder' => 'Age']) ?>

                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'gender')->dropDownList([
                        'Male' => 'Male',
                        'Female' => 'Female'
                        ],['prompt' => '--select--']) ?>

                    <?= $form->field($model, 'civil_status')->dropDownList([
                        'Single' => 'Single',
                        'Married' => 'Married',
                        'Widowed' => 'Widowed',
                        'Common Law' => 'Common Law'
                        ],['prompt' => '--select--']) ?>

                    <?= $form->field($model, 'home_address')->textInput(['maxlength' => true, 'placeholder' => 'Home Address']) ?>

                    <?= $form->field($model, 'sss_no')->textInput(['maxlength' => true, 'placeholder' => 'Sss No']) ?>

                    <?= $form->field($model, 'philhealth_no')->textInput(['maxlength' => true, 'placeholder' => 'Philhealth No']) ?>

                    <?= $form->field($model, 'tin_no')->textInput(['maxlength' => true, 'placeholder' => 'Tin No']) ?>

                    <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true, 'placeholder' => 'Contact No']) ?>
                </div>
            </div>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
