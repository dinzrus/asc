<?php

use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;

$this->title = 'C.I. Approval New';

$this->params['breadcrumbs'][] = ['label' => 'Canvass List', 'url' => ['site/cicanvassapproval']];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<?php $form = ActiveForm::begin() ?>
<div class="row form-group">
    <div class="col-xs-12">
        <ul class="nav nav-pills nav-justified thumbnail setup-panel">
            <li class="active"><a href="#step-1">
                    <h4 class="list-group-item-heading">Step 1 <i class="fa fa-arrow-right"></i></h4>
                    <p class="list-group-item-text">Encoding of Additional Info.</p>
                </a></li>
            <li class="disabled"><a href="#step-2">
                    <h4 class="list-group-item-heading">Step 2 <i class="fa fa-arrow-right"></i></h4>
                    <p class="list-group-item-text">Business Info.</p>
                </a></li> 
            <li class="disabled"><a href="#step-3">
                    <h4 class="list-group-item-heading">Step 3 <i class="fa fa-arrow-right"></i></h4>
                    <p class="list-group-item-text">Attachments</p>
                </a></li> 
            <li class="disabled"><a href="#step-4">
                    <h4 class="list-group-item-heading">Step 4</h4>
                    <p class="list-group-item-text">Loan Info. / Scheduling</p>
                </a></li> 
        </ul>
    </div>
</div>

<!-- step-1 -->
<div class="box box-primary setup-content" id="step-1">
    <div class="box-header">
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <h4><i class="fa fa-info-circle"></i> Borrowers Additional Info.</h4>
                        <hr>
                        <?=
                        $form->field($borrower, 'borrower_pic')->widget(FileInput::classname(), [
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
                        <?= $form->field($borrower, 'birthplace')->textInput() ?>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-body">
                        <h4><i class="fa fa-info-circle"></i> Dependents</h4>
                        <hr>
                        <?= $form->field($borrower, 'no_dependent')->textInput(['type' => 'number']) ?>
                        <?php foreach ($dependent as $index => $dep) : ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($dep, "[$index]name")->textInput() ?>
                                </div>
                                <div class="col-md-6">
                                    <?=
                                    $form->field($dep, "[$index]birthdate")->widget(\kartik\datecontrol\DateControl::classname(), [
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
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <h4><i class="fa fa-info-circle"></i> Spouse</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($borrower, 'spouse_name')->textInput() ?>
                            </div>
                            <div class="col-md-6">
                                <?=
                                $form->field($borrower, 'spouse_birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
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
                            </div>
                        </div>
                        <?= $form->field($borrower, 'spouse_occupation')->textInput() ?>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <h4><i class="fa fa-info-circle"></i> Parents</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($borrower, 'father_name')->textInput() ?>
                            </div>
                            <div class="col-md-6">
                                <?=
                                $form->field($borrower, 'father_birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($borrower, 'mother_name')->textInput() ?>
                            </div>
                            <div class="col-md-6">
                                <?=
                                $form->field($borrower, 'mother_birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
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
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="panel panel-primary">
                    <div class="panel-body">
                        <h4><i class="fa fa-info-circle"></i> Borrowers Valid ID</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($borrower, 'tin_no')->textInput() ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($borrower, 'sss_no')->textInput() ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($borrower, 'ctc_no')->textInput() ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($borrower, 'license_no')->textInput() ?>
                            </div>
                        </div>  
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="form-group">
            <div class="col-lg-12">
                <button id="activate-step-2" class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-right"></i> Next</button>
            </div>
        </div>
    </div>
</div>
<!-- step-1 end -->

<!-- step-2 -->
<div class="box box-primary setup-content" id="step-2">
    <div class="box-header"></div>  
    <div class="box-body">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h4><i class="fa fa-info-circle"></i> Business Information</h4>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <?php $form->field($business, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

                        <?= $form->field($business, 'business_name')->textInput(['maxlength' => true, 'placeholder' => 'Business Name']) ?>

                        <?=
                        $form->field($business, 'business_type_id')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\BusinessType::find()->orderBy('id')->asArray()->all(), 'id', 'business_description'),
                            'options' => ['placeholder' => 'Choose Business type'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>

                        <?=
                        $form->field($business, 'address_province_id')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\Province::find()->orderBy('id')->asArray()->all(), 'id', 'province'),
                            'options' => ['placeholder' => 'Choose Province'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>

                        <?=
                        $form->field($business, 'address_city_municipality_id')->widget(DepDrop::classname(), [
                            'options' => ['id' => Html::getInputId($business, 'address_city_municipality_id')],
                            'type' => DepDrop::TYPE_SELECT2,
                            'pluginOptions' => [
                                'depends' => [Html::getInputId($business, 'address_province_id')],
                                'placeholder' => 'Select city/municipality',
                                'url' => Url::to(['/borrower/getmunicipalitycity'])
                            ]
                        ]);
                        ?>

                        <?=
                        $form->field($business, 'address_barangay_id')->widget(DepDrop::classname(), [
                            //'options' => ['id' => 'address-barangay-id'],
                            'type' => DepDrop::TYPE_SELECT2,
                            'pluginOptions' => [
                                'depends' => [Html::getInputId($business, 'address_city_municipality_id')],
                                'placeholder' => 'Select barangay',
                                'url' => Url::to(['/borrower/getbarangay'])
                            ]
                        ]);
                        ?>

                        <?= $form->field($business, 'address_st_bldng_no')->textInput(['maxlength' => true, 'placeholder' => 'Address St Bldng No']) ?>

                    </div>
                    <div class="col-md-6">
                        <br>
                        <?= $form->field($business, 'business_years')->textInput(['placeholder' => 'Business Years']) ?>

                        <?= $form->field($business, 'permit_no')->textInput(['maxlength' => true, 'placeholder' => 'Permit No']) ?>

                        <?= $form->field($business, 'average_weekly_income')->textInput(['placeholder' => 'Average Weekly Income']) ?>

                        <?= $form->field($business, 'average_gross_daily_income')->textInput(['placeholder' => 'Avergage Gross Daily Income']) ?>

                        <?= $form->field($business, 'ownership')->dropDownList(['Rented' => 'Rented', 'Owned' => 'Owned'], ['prompt' => '-- select --']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="form-group">
            <div class="col-lg-12">
                <button id="activate-step-3" class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-right"></i> Next</button>
            </div>
        </div>
    </div>
</div>
<!-- step-2 end -->

<!-- step-3 -->
<div class="box box-primary setup-content" id="step-3">
    <div class="box-header"></div>  
    <div class="box-body">
        <div class="panel panel-primary">
            <div class="panel-body">
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
                        'maxFileCount' => 10,
                        'maxFileSize' => 200,
                    ],
                    'options' => [
                        'accept' => 'image/*',
                        'multiple' => true,
                    ]
                ]);
                ?>
            </div>
        </div>
        <div class="box-footer">
            <div class="form-group">
                <div class="col-lg-12">
                    <button id="activate-step-4" class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-right"></i> Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- step-3 end -->

<!-- step-4 -->
<div class="box box-primary setup-content" id="step-4">
    <div class="box-header"></div>  
    <div class="box-body">
        <!-- Loan Information -->
        <div class="panel panel-primary">
            <div class="panel-body">
                <h4><i class="fa fa-info-circle"></i> Loan Information</h4>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <label>Daily</label>
                        <?=
                        Select2::widget([
                            'name' => 'Daily',
                            'data' => yii\helpers\ArrayHelper::map($daily, 'id', 'daily'),
                            'size' => Select2::MEDIUM,
                            'options' => [
                                'placeholder' => 'Select Daily',
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-md-3">
                        <label>Unit</label>
                        <?=
                        Select2::widget([
                            'name' => 'Unit',
                            'data' => yii\helpers\ArrayHelper::map($units, 'unit_id', 'unit_description'),
                            'size' => Select2::MEDIUM,
                            'options' => [
                                'placeholder' => 'Select Unit',
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-md-3">
                        <label>Canvasser</label>
                        <?=
                        Select2::widget([
                            'name' => 'Ci',
                            'data' => yii\helpers\ArrayHelper::map($canvassers, 'id', 'fullname'),
                            'size' => Select2::MEDIUM,
                            'options' => [
                                'placeholder' => 'Select C.I.',
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-md-3">
                        <label for="cidate">C.I. Date</label>
                        <?=
                        kartik\datecontrol\DateControl::widget([
                            'name' => 'cidate',
                            'value' => date('MM/dd/yyyy'),
                            'displayFormat' => 'MM/dd/yyyy',
                            'displayTimezone' => 'Asia/Singapore',
                            'type' => kartik\datecontrol\DateControl::FORMAT_DATE,
                        ]);
                        ?>
                    </div>
                </div>
                <br>
                <br>
                <!-- show when daily is selected -->
                <style>
                    .align-right { text-align: right }
                </style>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>LOAN INFORMATION</strong>
                            </div>
                            <div class="panel-body">
                                <table class="table table-condensed table-hover">
                                    <tr>
                                        <td><strong>ACCOUNT TYPE:</strong></td>
                                        <td class="align-right">N - CELP</td>
                                    </tr>
                                    <tr>
                                        <td><strong>NO. OF DAYS:</strong></td>
                                        <td class="align-right" id="no_days">0</td>
                                    </tr>
                                    <tr>
                                        <td><strong>DATE OF RELEASED:</strong></td>
                                        <td class="align-right">0</td>
                                    </tr>
                                    <tr>
                                        <td><strong>DATE OF MATURING:</strong></td>
                                        <td class="align-right">0</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="collaterals">Collaterals</label>
                            <textarea name="collaterals" class="form-control">
                            
                            </textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>LOAN BREAKDOWN</strong>
                            </div>
                            <div class="panel-body">

                                <table class="table table-condensed table-hover">
                                    <tr bgcolor="#cdf4e5">
                                        <td><strong>GROSS AMOUNT:</strong></td>
                                        <td class="align-right" id="gross_amt"><strong>0</strong></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp; - INTEREST DEDUCTION:</td>
                                        <td class="align-right" id="interest">0</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp; - PROCESSING / ADMIN FEE:</td>
                                        <td class="align-right" id="processing_admin">0</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp; - NOTARY FEES:</td>
                                        <td class="align-right" id="notary">0</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp; - GAS SURCHARGE:</td>
                                        <td class="align-right" id="gas">0</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp; - DOCUMENTARY STAMP:</td>
                                        <td class="align-right" id="docs">0</td>
                                    </tr>
                                    <tr bgcolor="#cdf4e5">
                                        <td><strong>NET PROCEEDS:</strong></td>
                                        <td class="align-right" id="netproceeds">0</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- comaker -->
        <div class="panel panel-primary">
            <div class="panel-body">
                <h4><i class="fa fa-info-circle"></i> Loan Comaker</h4>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($comaker, 'last_name') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($comaker, 'first_name') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($comaker, 'middle_name') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($comaker, 'gender')->dropDownList([null => '-- SELECT --', 'M' => 'MALE', 'F' => 'FEMALE']) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($comaker, 'civil_status')->dropDownList([null => '-- SELECT --', 'single' => 'SINGLE']) ?>
                    </div>
                    <div class="col-md-4">
                        <?=
                        $form->field($comaker, 'birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($comaker, 'birthplace') ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($comaker, 'contact_no') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?=
                        $form->field($comaker, 'address_province_id')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\app\models\Province::find()->orderBy('id')->asArray()->all(), 'id', 'province'),
                            'options' => ['placeholder' => 'Choose Province'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-md-3">
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
                    </div>
                    <div class="col-md-3">
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
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($comaker, 'address_street_house_no')->textInput(['maxlength' => true, 'placeholder' => 'Street/House No./Building No.']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="form-group">
                <div class="col-lg-12">
                    <?= Html::submitButton('<i class="fa fa-save"></i>  Save', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- step-4 end -->

<?php ActiveForm::end() ?>
<?php $this->registerJsFile("@web/js/ciapprovalnew.js", ['depends' => [\yii\web\JqueryAsset::className()]]); ?>