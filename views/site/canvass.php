<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

$this->title = 'New Borrower';
$form = ActiveForm::begin();
?>
<div class="row form-group">
    <div class="col-xs-12">
        <ul class="nav nav-pills nav-justified thumbnail setup-panel">
            <li class="active"><a href="#step-1">
                    <h4 class="list-group-item-heading">Step 1</h4>
                    <p class="list-group-item-text">Encoding of Initial Info.</p>
                </a></li>
            <li class="disabled"><a href="#step-2">
                    <h4 class="list-group-item-heading">Step 2</h4>
                    <p class="list-group-item-text">Canvasser Info.</p>
                </a></li> 
        </ul>
    </div>
</div>
<div class="box setup-content" id="step-1">
    <div class="box-header">
        <h3 class="box-title">Borrowers Information</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($borrower, 'last_name') ?>
                <?= $form->field($borrower, 'first_name') ?>
                <?= $form->field($borrower, 'middle_name') ?>
                <?= $form->field($borrower, 'suffix')->textInput(['maxlength' => true, 'placeholder' => 'Suffix']) ?>
                <?= $form->field($borrower, 'gender')->dropDownList(['Male' => 'Male', 'Female' => 'Female'], ['prompt' => '-- select --']) ?>
<?= $form->field($borrower, 'contact_no') ?>
            </div>
            <div class="col-md-6">
                <?=
                $form->field($borrower, 'civil_status')->dropDownList([
                    'Single' => 'Single',
                    'Married' => 'Married',
                    'Widowed' => 'Widowed',
                    'Common_law' => 'Common Law',
                    'Separated' => 'Separated'
                        ], ['prompt' => '- Select - '])
                ?>
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
<div class="box setup-content" id="step-2">
    <div class="box-header">
        <h3 class="box-title">Canvasser Information</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <?=
                $form->field($borrower, 'canvass_by')->widget(\kartik\widgets\Select2::classname(), [
                    'data' => \yii\helpers\ArrayHelper::map($canvassers, 'id', 'fullname'),
                    'options' => ['placeholder' => 'Canvasser'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-6">
                <?=
                $form->field($borrower, 'canvass_date')->widget(\kartik\datecontrol\DateControl::classname(), [
                    'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                    'saveFormat' => 'php:Y-m-d',
                    'ajaxConversion' => true,
                    'value' => date('m/d/Y'),
                    'options' => [
                        'pluginOptions' => [
                            'placeholder' => 'Choose Canvass Date',
                            'autoclose' => true,
                            'format' => 'm/d/Y'
                        ]
                    ],
                ]);
                ?>

            </div>
        </div>

    </div>  
    <div class="box-footer">
        <div class="form-group">
            <div class="col-lg-12">
                <button class="btn btn-primary btn-md"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </div>

</div>
<?php ActiveForm::end(); ?>

<?php $this->registerJsFile("@web/js/canvassing.js", ['depends' => [\yii\web\JqueryAsset::className()]]); ?>


