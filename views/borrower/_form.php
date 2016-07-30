<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Borrower */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borrower-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->errorSummary($model);   ?>
    <div class="box box-primary"> <!-- start of principal applicant form  -->
        <div class="box-header with-border">
            <h3 class="box-title"><strong>Principal Applicant</strong></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <?php
                    echo $form->field($model, 'principal_pic')->widget(FileInput::classname(), [
                        'pluginOptions' => [
                            'initialPreview' => [
                                $model->principal_profile_pic
                            ],
                            'initialPreviewAsData' => true,
                            'overwriteInitial' => true,
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                            'browseLabel' => 'Select Photo'
                        ],
                        'options' => ['accept' => 'image/*']
                    ]);
                    ?>

                </div>
                <div class="col-md-4">

                    <?php
                    if (Yii::$app->user->identity->branch_id == 9) {
                        echo $form->field($model, 'branch')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\Branch::find()->orderBy('branch_id')->asArray()->all(), 'branch_id', 'branch_description'),
                            'options' => ['placeholder' => 'Choose branch'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                    }
                    ?>

                    <?= $form->field($model, 'principal_first_name')->textInput(['maxlength' => true, 'placeholder' => 'First Name']) ?>

                    <?= $form->field($model, 'principal_last_name')->textInput(['maxlength' => true, 'placeholder' => 'Last Name']) ?>

                    <?= $form->field($model, 'principal_middle_name')->textInput(['maxlength' => true, 'placeholder' => 'Middle Name']) ?>

                    <?= $form->field($model, 'principal__suffix')->textInput(['maxlength' => true, 'placeholder' => 'Suffix']) ?>

                    <?=
                    $form->field($model, 'principal_birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
                        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                        'saveFormat' => 'php:Y-m-d',
                        'ajaxConversion' => true,
                        'options' => [
                            'pluginOptions' => [
                                'placeholder' => 'Choose Date of Birth',
                                'autoclose' => true
                            ]
                        ],
                    ]);
                    ?>

                    <?= $form->field($model, 'principal_age')->textInput(['placeholder' => 'Age']) ?>

                    <?= $form->field($model, 'principal_birthplace')->textInput(['maxlength' => true, 'placeholder' => 'Birth of place']) ?>

                    <?= $form->field($model, 'principal_address_street_house')->textInput(['maxlength' => true, 'placeholder' => 'Street/House no.']) ?>

                    <?= $form->field($model, 'principal_address_barangay')->textInput(['maxlength' => true, 'placeholder' => 'Barangay']) ?>

                    <?= $form->field($model, 'principal_address_province')->textInput(['maxlength' => true, 'placeholder' => 'Province']) ?>

                    <?= $form->field($model, 'principal_civil_status')->dropDownList(['Single' => 'Single', 'Married' => 'Married', 'Widowed' => 'Widowed', 'Common law' => 'Common law', 'Separated' => 'Separated'], ['prompt' => 'Select Status']) ?>

                    <?= $form->field($model, 'principal_contact_no')->textInput(['maxlength' => true, 'placeholder' => 'Contact No']) ?>

                </div>
                <div class="col-md-4">
                    <?=
                    $form->field($model, 'principal_ci_date')->widget(\kartik\datecontrol\DateControl::classname(), [
                        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                        'saveFormat' => 'php:Y-m-d',
                        'ajaxConversion' => true,
                        'options' => [
                            'pluginOptions' => [
                                'placeholder' => 'Choose CI Date',
                                'autoclose' => true
                            ]
                        ],
                    ]);
                    ?>

                    <?=
                    $form->field($model, 'principal_canvass_date')->widget(\kartik\datecontrol\DateControl::classname(), [
                        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                        'saveFormat' => 'php:Y-m-d',
                        'ajaxConversion' => true,
                        'options' => [
                            'pluginOptions' => [
                                'placeholder' => 'Choose Canvass Date',
                                'autoclose' => true
                            ]
                        ],
                    ]);
                    ?>
                    <?= $form->field($model, 'principal_tin_no')->textInput(['maxlength' => true, 'placeholder' => 'TIN No']) ?>

                    <?= $form->field($model, 'principal_sss_no')->textInput(['maxlength' => true, 'placeholder' => 'SSS No']) ?>

                    <?= $form->field($model, 'principal_ctc_no')->textInput(['maxlength' => true, 'placeholder' => 'CTC No']) ?>

                    <?= $form->field($model, 'principal_license_no')->textInput(['maxlength' => true, 'placeholder' => 'Driver License No']) ?>

                    <?= $form->field($model, 'principal_spouse_name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

                    <?= $form->field($model, 'principal_spouse_occupation')->textInput(['maxlength' => true, 'placeholder' => 'Occupation']) ?>

                    <?=
                    $form->field($model, 'principal_spouse_birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
                        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                        'saveFormat' => 'php:Y-m-d',
                        'ajaxConversion' => true,
                        'options' => [
                            'pluginOptions' => [
                                'placeholder' => 'Choose Date of Birth',
                                'autoclose' => true
                            ]
                        ],
                    ]);
                    ?>
                    <?= $form->field($model, 'principal_spouse_age')->textInput(['placeholder' => 'Age']) ?>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-8"> 
                    <?= $form->field($model, 'principal_no_children')->textInput(['placeholder' => 'No. Children']) ?>
                    <div class="row">
                        <div class="col-md-5">
                            <?= $form->field($model, 'principal_child1_name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

                            <?= $form->field($model, 'principal_child2_name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>
                        </div>
                        <div class="col-md-4">
                            <?=
                            $form->field($model, 'principal_child1_birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
                                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                                'saveFormat' => 'php:Y-m-d',
                                'ajaxConversion' => true,
                                'options' => [
                                    'pluginOptions' => [
                                        'placeholder' => 'Choose date of birth',
                                        'autoclose' => true
                                    ]
                                ],
                            ]);
                            ?>

                            <?=
                            $form->field($model, 'principal_child2_birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
                                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                                'saveFormat' => 'php:Y-m-d',
                                'ajaxConversion' => true,
                                'options' => [
                                    'pluginOptions' => [
                                        'placeholder' => 'Choose date of birth',
                                        'autoclose' => true
                                    ]
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($model, 'principal_child1_age')->textInput(['placeholder' => 'Age']) ?>

                            <?= $form->field($model, 'principal_child2_age')->textInput(['placeholder' => 'Age']) ?>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div> <!-- end of principal applicant form  -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><strong>Second Signatory</strong></h3>
        </div>
        <div class="box-body">
            <!-- row2 ---------------------------------------------------------------------------------------------------- -->
            <div class="row">
                <div class="col-md-3">

                    <?php
                    echo $form->field($model, 'second_signatory_pic')->widget(FileInput::classname(), [
                        'pluginOptions' => [
                            'initialPreview' => [
                                $model->comaker_profile_pic
                            ],
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'initialPreviewAsData' => true,
                            'overwriteInitial' => true,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                            'browseLabel' => 'Select Photo'
                        ],
                        'options' => ['accept' => 'image/*']
                    ]);
                    ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'comaker_name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

                    <?= $form->field($model, 'comaker_address')->textInput(['maxlength' => true, 'placeholder' => 'Address']) ?>

                    <?= $form->field($model, 'comaker_alias')->textInput(['maxlength' => true, 'placeholder' => 'Alias']) ?>

                    <?= $form->field($model, 'comaker_contact')->textInput(['maxlength' => true, 'placeholder' => 'Contact']) ?>

                    <?= $form->field($model, 'comaker_occupation')->textInput(['maxlength' => true, 'placeholder' => 'Occupation']) ?>

                    <?=
                    $form->field($model, 'comaker_birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
                        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                        'saveFormat' => 'php:Y-m-d',
                        'ajaxConversion' => true,
                        'options' => [
                            'pluginOptions' => [
                                'placeholder' => 'Choose date of birth',
                                'autoclose' => true
                            ]
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'comaker_age')->textInput(['placeholder' => 'Age']) ?>

                    <?= $form->field($model, 'comaker_relation')->dropDownList(['Brother' => 'Brother', 'Sister' => 'Sister', 'Friend' => 'Friend'], ['prompt' => 'Select Status']) ?>

                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><strong>Business</strong></h3>
        </div>
        <div class="box-body">
            <!-- row3 --------------------------------------------------------------------------------------------------- -->
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'business_name')->textInput(['maxlength' => true, 'placeholder' => 'Business Name']) ?>

                    <?= $form->field($model, 'business_address')->textInput(['maxlength' => true, 'placeholder' => 'Business Address']) ?>

                    <?=
                    $form->field($model, 'business_type')->widget(\kartik\widgets\Select2::classname(), [
                        'data' => \yii\helpers\ArrayHelper::map(\app\models\BusinessType::find()->orderBy('business_id')->asArray()->all(), 'business_id', 'business_description'),
                        'options' => ['placeholder' => 'Choose Business type'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'business_years')->textInput(['placeholder' => 'Business Years']) ?>

                    <?= $form->field($model, 'business_income')->textInput(['placeholder' => 'Business Income']) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- collateral -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Collaterals</strong></h3>
                </div>
                <div class="box-body">
                    <?= $form->field($model, 'collaterals')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>
    </div> <!-- collateral's end -->
    <?= $form->field($model, 'status')->hiddenInput(['value' => 0]) ?>

    <!-- attachment's -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Attachments (201/VALID ID)</strong></h3>
                    <small style='color: red'>Please select at the same time all your attachments</small>
                </div>
                <div class="box-body">
                    <?php
                    echo FileInput::widget([
                        'model' => $model,
                        'attribute' => 'attachfiles[]',
                        'pluginOptions' => [
                            'showCaption' => false,
                            'showRemove' => true,
                            'showPreview' => true,
                            'showUpload' => false,
                            'browseLabel' => 'Select Attachment',
                            'removeLabel' => ' ',
                            'maxFileCount' => 3,
                        ],
                        'options' => [
                            'accept' => 'image/*',
                            'multiple' => true,
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div> <!-- attachment's end -->
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
