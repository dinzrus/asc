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

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'enableAjaxValidation' => 'true']); ?>

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
                            <?= $form->errorSummary($borrower); ?>
                            <div class="col-md-4">
                                <?php
                                echo $form->field($borrower, 'borrower_pic')->widget(FileInput::classname(), [
                                    'pluginOptions' => [
                                        'initialPreview' => [
                                            empty($borrower->profile_pic) ? 'fileupload/default.jpg' : $borrower->profile_pic
                                        ],
                                        'initialPreviewAsData' => true,
                                        'overwriteInitial' => true,
                                        'showCaption' => false,
                                        'showRemove' => false,
                                        'showUpload' => false,
                                        'browseClass' => 'btn btn-primary btn-block',
                                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                        'browseLabel' => 'Select Photo',
                                        'maxFileSize' => 500,
                                    ],
                                    'options' => ['accept' => 'image/*']
                                ]);
                                ?>

                            </div>
                            <div class="col-md-4">

                                <?= $form->field($borrower, 'last_name')->textInput(['maxlength' => true, 'placeholder' => 'Last Name']) ?>

                                <?= $form->field($borrower, 'first_name')->textInput(['maxlength' => true, 'placeholder' => 'First Name']) ?>

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
                                            'autoclose' => true,
                                        ],
                                    ],
                                ]);
                                ?>

                                <?= $form->field($borrower, 'age')->textInput(['placeholder' => 'Age']) ?>

                                <?= $form->field($borrower, 'birthplace')->textInput(['maxlength' => true, 'placeholder' => 'Birthplace']) ?>

                                <?=
                                $form->field($borrower, 'address_province_id')->widget(\kartik\widgets\Select2::classname(), [
                                    'data' => \yii\helpers\ArrayHelper::map(\app\models\Province::find()->orderBy('id')->asArray()->all(), 'id', 'province'),
                                    'options' => ['placeholder' => 'Choose Province'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                                ?>

                                <?=
                                $form->field($borrower, 'address_city_municipality_id')->widget(DepDrop::classname(), [
                                    'options' => ['id' => Html::getInputId($borrower, 'address_city_municipality_id')],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'pluginOptions' => [
                                        'depends' => [Html::getInputId($borrower, 'address_province_id')],
                                        'placeholder' => 'Select city/municipality',
                                        'url' => Url::to(['/borrower/getmunicipalitycity'])
                                    ]
                                ]);
                                ?>

                                <?=
                                $form->field($borrower, 'address_barangay_id')->widget(DepDrop::classname(), [
                                    //'options' => ['id' => 'address-barangay-id'],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'pluginOptions' => [
                                        'depends' => [Html::getInputId($borrower, 'address_city_municipality_id')],
                                        'placeholder' => 'Select barangay',
                                        'url' => Url::to(['/borrower/getbarangay'])
                                    ]
                                ]);
                                ?>

                                <?= $form->field($borrower, 'address_street_house_no')->textInput(['maxlength' => true, 'placeholder' => 'Address Street House No']) ?>

                            </div>
                            <div class="col-md-4">
                                <?=
                                $form->field($borrower, 'civil_status')->dropDownList([
                                    'Single' => 'Single',
                                    'Married' => 'Married',
                                    'Widowed' => 'Widowed',
                                    'Common_law' => 'Common Law',
                                    'Separated' => 'Separated'
                                        ], ['prompt' => '- Select - '])
                                ?>

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

                                <?= $form->field($borrower, 'spouse_age')->textInput(['placeholder' => 'Spouse Age']) ?>

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
                                            <div class="col-md-4">
                                                <?= $form->field($dependent, "[$i]age")->textInput() ?>
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
                                            <div class="col-md-4">
                                                <?= $form->field($dependent, "[$i]age")->textInput() ?>
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

                                <?=
                                $form->field($borrower, 'branch_id')->widget(\kartik\widgets\Select2::classname(), [
                                    'data' => \yii\helpers\ArrayHelper::map(\app\models\Branch::find()->orderBy('branch_id')->asArray()->all(), 'branch_id', 'branch_description'),
                                    'options' => ['placeholder' => 'Choose Branch'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                                ?>

                            </div>
                        </div>
                    </div> <!-- principal tab end here -->
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="second">
                        <div class="row">
                            <?= $form->errorSummary($comaker); ?>
                            <div class="col-md-4">
                                <?php
                                echo $form->field($comaker, 'comaker_pic')->widget(FileInput::classname(), [
                                    'pluginOptions' => [
                                        'initialPreview' => [
                                            empty($comaker->profile_pic) ? 'fileupload/default.jpg' : $comaker->profile_pic
                                        ],
                                        'showCaption' => false,
                                        'showRemove' => false,
                                        'showUpload' => false,
                                        'initialPreviewAsData' => true,
                                        'overwriteInitial' => true,
                                        'browseClass' => 'btn btn-primary btn-block',
                                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                        'browseLabel' => 'Select Photo',
                                        'maxFileSize' => 500,
                                    ],
                                    'options' => ['accept' => 'image/*']
                                ]);
                                ?>
                            </div>
                            <div class="col-md-4">

                                <?= $form->field($comaker, 'last_name')->textInput(['maxlength' => true, 'placeholder' => 'Last Name']) ?>

                                <?= $form->field($comaker, 'first_name')->textInput(['maxlength' => true, 'placeholder' => 'First Name']) ?>

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

                                <?= $form->field($comaker, 'birthplace')->textInput(['maxlength' => true, 'placeholder' => 'Birthplace']) ?>

                                <?= $form->field($comaker, 'age')->textInput(['placeholder' => 'Age']) ?>

                            </div>
                            <div class="col-md-4">
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
                                $form->field($comaker, 'address_city_municipality_id')->widget(DepDrop::classname(), [
                                    'options' => ['id' => Html::getInputId($comaker, 'address_city_municipality_id')],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'pluginOptions' => [
                                        'depends' => [Html::getInputId($comaker, 'address_province_id')],
                                        'placeholder' => 'Select city/municipality',
                                        'url' => Url::to(['/borrower/getmunicipalitycity'])
                                    ]
                                ]);
                                ?>

                                <?=
                                $form->field($comaker, 'address_barangay_id')->widget(DepDrop::classname(), [
                                    //'options' => ['id' => 'address-barangay-id'],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'pluginOptions' => [
                                        'depends' => [Html::getInputId($comaker, 'address_city_municipality_id')],
                                        'placeholder' => 'Select barangay',
                                        'url' => Url::to(['/borrower/getbarangay'])
                                    ]
                                ]);
                                ?>

                                <?= $form->field($comaker, 'address_street_house_no')->textInput(['maxlength' => true, 'placeholder' => 'Address Street House No']) ?>

                                <?=
                                $form->field($comaker, 'civil_status')->dropDownList([
                                    'Single' => 'Single',
                                    'Married' => 'Married',
                                    'Widowed' => 'Widowed',
                                    'Common_law' => 'Common Law',
                                    'Separated' => 'Separated'
                                        ], ['prompt' => '- Select -'])
                                ?>

                                <?= $form->field($comaker, 'contact_no')->textInput(['maxlength' => true, 'placeholder' => 'Contact No']) ?>
                                <?=
                                $form->field($borrower_comaker, 'relationship')->dropDownList([
                                    'brother' => 'Brother',
                                    'sister' => 'Sister',
                                    'neighbor' => 'Neighbor',
                                    'husband' => 'Husband',
                                    'daughter' => 'Daughter',
                                        ], ['prompt' => '- Select -'])
                                ?>
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
                                'maxFileSize' => 500,
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

<script type="text/javascript">
    function calculateAge(birthDate, id) {
        var birthDate = new Date(birthDate);
        var currentDate = new Date();

        var years = (otherDate.getFullYear() - birthDate.getFullYear());

        if (currentDate.getMonth() < birthDate.getMonth() ||
                currentDate.getMonth() == birthDate.getMonth() && currentDate.getDate() < birthDate.getDate()) {
            years--;
        }
        $('#' + id).val(years);
    }
</script>
