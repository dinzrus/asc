<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use \kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'User',
        'relID' => 'user',
        'value' => \yii\helpers\Json::encode($model->users),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="employee-form box box-primary">

    <div class="box-body">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->errorSummary($model); ?>

        <div class="row">
            <div class="col-md-6">
                <?=
                $form->field($model, 'file')->widget(FileInput::Classname(), [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'showCaption' => true,
                        'showRemove' => false,
                        'showUpload' => false,
                        'browseClass' => 'btn btn-primary btn-block',
                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                        'browseLabel' => 'Select Photo'
                    ],
                ])
                //$form->field($model, 'file')->fileInput();
                ?>

                <?= $form->field($model, 'firstname')->textInput(['maxlength' => true, 'placeholder' => 'Firstname']) ?>

                <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'placeholder' => 'Lastname']) ?>

                <?= $form->field($model, 'middlename')->textInput(['maxlength' => true, 'placeholder' => 'Middlename']) ?>

                <?=
                $form->field($model, 'birth_date')->widget(\kartik\datecontrol\DateControl::classname(), [
                    'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                    'saveFormat' => 'php:Y-m-d',
                    'ajaxConversion' => true,
                    'options' => [
                        'pluginOptions' => [
                            'placeholder' => 'Choose Birth Date',
                            'autoclose' => true
                        ]
                    ],
                ]);
                ?>

                <?= $form->field($model, 'gender')->dropDownList(['Male' => 'Male', 'Female' => 'Female'], ['prompt' => 'Select Gender']) ?>

                <?= $form->field($model, 'civil_status')->dropDownList(['Single' => 'Single', 'Married' => 'Married', 'Widowed' => 'Widowed', 'Common law' => 'Common law', 'Separated' => 'Separated'], ['prompt' => 'Select Status']) ?>


                <?= $form->field($model, 'home_address')->textInput(['maxlength' => true, 'placeholder' => 'Home Address']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'sss_no')->textInput(['maxlength' => true, 'placeholder' => 'Sss No']) ?>

                <?= $form->field($model, 'philhealth_no')->textInput(['maxlength' => true, 'placeholder' => 'Philhealth No']) ?>

                <?= $form->field($model, 'tin_no')->textInput(['maxlength' => true, 'placeholder' => 'Tin No']) ?>

                <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true, 'placeholder' => 'Contact No']) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>  

</div>
