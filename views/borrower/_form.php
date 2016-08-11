<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $borrower app\models\Borrower */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borrower-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->errorSummary($borrower); ?>

    <!-- start your form here -->

    <!------------------------------- tabs start here ------------------------------>     
    <div class="row">   
        <div class="col-md-12">

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#principal" data-toggle="tab">Principal Applicant</a></li>
                    <li><a href="#second" data-toggle="tab">Second Signatory</a></li>
                    <li><a href="#attachment" data-toggle="tab">Attachments</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="principal">
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($borrower, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

                                <?php
                                echo $form->field($borrower, 'borrower_pic')->widget(FileInput::classname(), [
                                    'pluginOptions' => [
                                        'initialPreview' => [
                                            $borrower->profile_pic
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

                                <?= $form->field($borrower, 'first_name')->textInput(['maxlength' => true, 'placeholder' => 'First Name']) ?>

                                <?= $form->field($borrower, 'last_name')->textInput(['maxlength' => true, 'placeholder' => 'Last Name']) ?>

                                <?= $form->field($borrower, 'middle_name')->textInput(['maxlength' => true, 'placeholder' => 'Middle Name']) ?>

                                <?= $form->field($borrower, 'suffix')->textInput(['maxlength' => true, 'placeholder' => 'Suffix']) ?>

                                <?=
                                $form->field($borrower, 'birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
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

                                <?= $form->field($borrower, 'age')->textInput(['placeholder' => 'Age']) ?>

                                <?= $form->field($borrower, 'birthplace')->textInput(['maxlength' => true, 'placeholder' => 'Birthplace']) ?>

                                <?=
                                $form->field($borrower, 'address_province_id')->widget(\kartik\widgets\Select2::classname(), [
                                    'data' => \yii\helpers\ArrayHelper::map(\app\models\Province::find()->orderBy('id')->asArray()->all(), 'id', 'province'),
                                    'options' => ['placeholder' => 'Choose Province', 'id' => 'address-province-id'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                                ?>

                                <?=
                                $form->field($borrower, 'address_city_municipality_id')->widget(DepDrop::classname(), [
                                    'options' => ['id' => 'address-city-municipality-id'],
                                    'pluginOptions' => [
                                        'depends' => ['address-province-id'],
                                        'placeholder' => 'Select city/municipality',
                                        'url' => Url::to(['/borrower/addresscitymunicipality'])
                                    ]
                                ]);
                                ?>

                                <?=
                               $form->field($borrower, 'address_barangay_id')->widget(DepDrop::classname(), [
                                    'options' => ['id' => 'address-barangay-id'],
                                    'pluginOptions' => [
                                        'depends' => ['address-city-municipality-id'],
                                        'placeholder' => 'Select barangay',
                                        'url' => Url::to(['/site/subcat'])
                                    ]
                                ]);
                                ?>

                                <?= $form->field($borrower, 'address_street_house_no')->textInput(['maxlength' => true, 'placeholder' => 'Address Street House No']) ?>

                            </div>
                            <div class="col-md-4">
                                <?= $form->field($borrower, 'civil_status')->textInput(['maxlength' => true, 'placeholder' => 'Civil Status']) ?>

                                <?= $form->field($borrower, 'contact_no')->textInput(['maxlength' => true, 'placeholder' => 'Contact No']) ?>

                                <?=
                                $form->field($borrower, 'ci_date')->widget(\kartik\datecontrol\DateControl::classname(), [
                                    'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                                    'saveFormat' => 'php:Y-m-d',
                                    'ajaxConversion' => true,
                                    'options' => [
                                        'pluginOptions' => [
                                            'placeholder' => 'Choose Ci Date',
                                            'autoclose' => true
                                        ]
                                    ],
                                ]);
                                ?>

                                <?=
                                $form->field($borrower, 'canvass_date')->widget(\kartik\datecontrol\DateControl::classname(), [
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

                                <?= $form->field($borrower, 'tin_no')->textInput(['maxlength' => true, 'placeholder' => 'Tin No']) ?>

                                <?= $form->field($borrower, 'sss_no')->textInput(['maxlength' => true, 'placeholder' => 'Sss No']) ?>

                                <?= $form->field($borrower, 'ctc_no')->textInput(['maxlength' => true, 'placeholder' => 'Ctc No']) ?>

                                <?= $form->field($borrower, 'license_no')->textInput(['maxlength' => true, 'placeholder' => 'License No']) ?>

                                <?= $form->field($borrower, 'spouse_name')->textInput(['maxlength' => true, 'placeholder' => 'Spouse Name']) ?>

                                <?= $form->field($borrower, 'spouse_occupation')->textInput(['maxlength' => true, 'placeholder' => 'Spouse Occupation']) ?>

                                <?= $form->field($borrower, 'spouse_age')->textInput(['placeholder' => 'Spouse Age']) ?>

                                <?=
                                $form->field($borrower, 'spouse_birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
                                    'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                                    'saveFormat' => 'php:Y-m-d',
                                    'ajaxConversion' => true,
                                    'options' => [
                                        'pluginOptions' => [
                                            'placeholder' => 'Choose Spouse Birthdate',
                                            'autoclose' => true
                                        ]
                                    ],
                                ]);
                                ?>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-4">
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $form->field($borrower, 'no_dependent')->textInput(['placeholder' => 'No Dependent']) ?> 
                                    </div>                  
                                </div>
                                <!-- dependent start -->
                                <?php if ($update): ?>
                                    <?php foreach ($dependents as $i => $dependent): ?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <?php
                                                echo \yii\helpers\Html::activeHiddenInput($dependent, "[$i]id");
                                                ?>
                                                <?= $form->field($dependent, "[$i]name")->textInput() ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?= $form->field($dependent, "[$i]age")->textInput() ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?=
                                                $form->field($dependent, "[$i]birthdate")->widget(\kartik\datecontrol\DateControl::classname(), [
                                                    'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                                                    'saveFormat' => 'php:Y-m-d',
                                                    'ajaxConversion' => true,
                                                    'options' => [
                                                        'pluginOptions' => [
                                                            'placeholder' => 'Birthdate',
                                                            'autoclose' => true
                                                        ]
                                                    ],
                                                ]);
                                                ?>
                                            </div>

                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <?php for ($i = 0; $i < 3; $i++): ?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <?= $form->field($dependent, "[$i]name")->textInput() ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?= $form->field($dependent, "[$i]age")->textInput() ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?=
                                                $form->field($dependent, "[$i]birthdate")->widget(\kartik\datecontrol\DateControl::classname(), [
                                                    'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                                                    'saveFormat' => 'php:Y-m-d',
                                                    'ajaxConversion' => true,
                                                    'options' => [
                                                        'pluginOptions' => [
                                                            'placeholder' => 'Birthdate',
                                                            'autoclose' => true
                                                        ]
                                                    ],
                                                ]);
                                                ?>
                                            </div>

                                        </div>
                                    <?php endfor; ?>
                                <?php endif; ?>
                                <!-- dependent end -->
                                <hr>
                                <?= $form->field($borrower, 'collaterals')->textarea(['rows' => 6]) ?>

                                <?=
                                $form->field($borrower, 'status')->widget(\kartik\widgets\Select2::classname(), [
                                    'data' => \yii\helpers\ArrayHelper::map(\app\models\Status::find()->orderBy('code')->asArray()->all(), 'code', 'status'),
                                    'options' => ['placeholder' => 'Choose Status'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                                ?>

                                <?= $form->field($borrower, 'branch_id')->textInput(['placeholder' => 'Branch']) ?>

                                <?= $form->field($borrower, 'acount_type')->textInput(['maxlength' => true, 'placeholder' => 'Acount Type']) ?>

                            </div>
                        </div>
                    </div> <!-- principal tab end here -->
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="second">
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($comaker, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>


                                <?php
                                echo $form->field($comaker, 'comaker_pic')->widget(FileInput::classname(), [
                                    'pluginOptions' => [
                                        'initialPreview' => [
                                            $comaker->profile_pic
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

                                <?= $form->field($comaker, 'first_name')->textInput(['maxlength' => true, 'placeholder' => 'First Name']) ?>

                                <?= $form->field($comaker, 'last_name')->textInput(['maxlength' => true, 'placeholder' => 'Last Name']) ?>

                                <?= $form->field($comaker, 'middle_name')->textInput(['maxlength' => true, 'placeholder' => 'Middle Name']) ?>

                                <?= $form->field($comaker, 'suffix')->textInput(['maxlength' => true, 'placeholder' => 'Suffix']) ?>

                                <?=
                                $form->field($comaker, 'birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
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

                                <?= $form->field($comaker, 'age')->textInput(['placeholder' => 'Age']) ?>

                                <?= $form->field($comaker, 'birthplace')->textInput(['maxlength' => true, 'placeholder' => 'Birthplace']) ?>

                                <?=
                                $form->field($comaker, 'address_province_id')->widget(\kartik\widgets\Select2::classname(), [
                                    'data' => \yii\helpers\ArrayHelper::map(\app\models\Province::find()->orderBy('id')->asArray()->all(), 'id', 'province'),
                                    'options' => ['placeholder' => 'Choose Province'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                                ?>

                                <?=
                                $form->field($comaker, 'address_city_municipality_id')->widget(\kartik\widgets\Select2::classname(), [
                                    'data' => \yii\helpers\ArrayHelper::map(\app\models\MunicipalityCity::find()->orderBy('id')->asArray()->all(), 'id', 'municipality_city'),
                                    'options' => ['placeholder' => 'Choose Municipality city'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                                ?>

                                <?=
                                $form->field($comaker, 'address_barangay_id')->widget(\kartik\widgets\Select2::classname(), [
                                    'data' => \yii\helpers\ArrayHelper::map(\app\models\Barangay::find()->orderBy('id')->asArray()->all(), 'id', 'barangay'),
                                    'options' => ['placeholder' => 'Choose Barangay'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                                ?>

                                <?= $form->field($comaker, 'address_street_house_no')->textInput(['maxlength' => true, 'placeholder' => 'Address Street House No']) ?>

                            </div>
                            <div class="col-md-4">
                                <?= $form->field($comaker, 'civil_status')->textInput(['maxlength' => true, 'placeholder' => 'Civil Status']) ?>

                                <?= $form->field($comaker, 'contact_no')->textInput(['maxlength' => true, 'placeholder' => 'Contact No']) ?>

                                <?= $form->field($comaker, 'tin_no')->textInput(['maxlength' => true, 'placeholder' => 'Tin No']) ?>

                                <?= $form->field($comaker, 'sss_no')->textInput(['maxlength' => true, 'placeholder' => 'Sss No']) ?>

                                <?= $form->field($comaker, 'ctc_no')->textInput(['maxlength' => true, 'placeholder' => 'Ctc No']) ?>

                                <?= $form->field($comaker, 'license_no')->textInput(['maxlength' => true, 'placeholder' => 'License No']) ?>

                                <?= $form->field($comaker, 'spouse_name')->textInput(['maxlength' => true, 'placeholder' => 'Spouse Name']) ?>

                                <?= $form->field($comaker, 'spouse_occupation')->textInput(['maxlength' => true, 'placeholder' => 'Spouse Occupation']) ?>

                                <?= $form->field($comaker, 'spouse_age')->textInput(['placeholder' => 'Spouse Age']) ?>

                                <?=
                                $form->field($comaker, 'spouse_birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
                                    'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                                    'saveFormat' => 'php:Y-m-d',
                                    'ajaxConversion' => true,
                                    'options' => [
                                        'pluginOptions' => [
                                            'placeholder' => 'Choose Spouse Birthdate',
                                            'autoclose' => true
                                        ]
                                    ],
                                ]);
                                ?>

                                <?= $form->field($comaker, 'relation_to_applicant')->textInput(['maxlength' => true, 'placeholder' => 'Relation To Applicant']) ?>

                                <?= $form->field($comaker, 'acount_type')->textInput(['maxlength' => true, 'placeholder' => 'Acount Type']) ?>

                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="attachment">
                        <?php
                        echo FileInput::widget([
                            'model' => $borrower,
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
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->

        </div>
    </div>
    <!-----------------------------  tabs end here -------------------------------->    

    <div class="form-group">
        <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
            <?= Html::submitButton($borrower->isNewRecord ? 'Create' : 'Update', ['class' => $borrower->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if (Yii::$app->controller->action->id != 'create'): ?>
            <?= Html::submitButton('Save As New', ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
        <?php endif; ?>
    </div>

    <!-- end your form here -->

    <?php ActiveForm::end(); ?>

</div>
