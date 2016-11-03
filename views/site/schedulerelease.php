<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

$this->title = 'Schedule for releasing';
$this->params['breadcrumbs'][] = ['label' => 'Borrowers list', 'url' => ['site/sfr']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4">
        <div class="box box-solid">
            <div class="box-header">
                <center>
                    <h4 class="box-title"><strong>ACCOUNT INFORMATION</strong></h4>
                </center>
            </div>
            <div class="box-body">
                <center>
                    <?php
                    if (isset($borrower->profile_pic)) {
                        echo Html::img($borrower->profile_pic, ['class' => 'profile-user-img img-responsive img-circle', 'width' => 100]);
                    } else {
                        echo Html::img('fileupload/default.jpg', ['class' => 'profile-user-img img-responsive img-circle', 'width' => 100]);
                    }
                    ?>
                </center>
                <br>
                <table class="table">
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td><?= $borrower->last_name . ', ' . $borrower->first_name . ' ' . $borrower->middle_name ?></td>
                    </tr>
                    <tr>
                        <td><strong>Home Address:</strong></td>
                        <td><?= $borrower->address_street_house_no . ', ' . $borrower->addressBarangay->barangay . ', ' . $borrower->addressCityMunicipality->municipality_city . ', ' . $borrower->addressProvince->province ?></td>
                    </tr>
                    <tr>
                        <td><strong>Contact No.:</strong></td>
                        <td><?= $borrower->contact_no ?></td>
                    </tr>
                    <tr>
                        <td><strong>Business Type:</strong></td>
                        <td><?= $business->businessType->business_description ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="box box-solid">
            <div class="box-header">
                <h4 class="box-title"><i class="fa fa-folder-open"></i> <strong>LOAN DETAILS</strong></h4>
            </div>
            <div class="box-body">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <td><strong>Account Type:</strong></td>
                                <td><?= $ltype->loan_description ?></td>
                            </tr>
                            <tr>
                                <td><strong>Daily Amount:</strong></td>
                                <td><?= $loanscheme->daily ?></td>
                            </tr>
                            <tr>
                                <td><strong>Unit:</strong></td>
                                <td><?= $unt->unit_description ?></td>
                            </tr>
                            <tr>
                                <td><strong>Date of Release:</strong></td>
                                <td><?= date('m/d/y'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Maturity Date:</strong></td>
                                <td><?php
                                    /**
                                     * Temporary Only
                                     * Todo...
                                     */
                                    $date = date('m/d/y');
                                    $mat = strtotime('10/21/2016' . '48 days');
                                    echo date('m/d/y', $mat);
                                    ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <td><strong>Gross Amount:</strong></td>
                                <td style="text-align: right"><?= $loanscheme->gross_amt ?></td>
                            </tr>
                            <tr>
                                <td><strong>Total Deductions:</strong></td>
                                <td style="text-align: right"><?= $loanscheme->total_deductions ?></td>
                            </tr>
                            <tr>
                                <td><strong>Net Proceeds:</strong></td>
                                <td style="text-align: right"><?= $loanscheme->net_proceeds ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?=
                        $form->field($loan, 'ci_officer')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => (!(strtoupper(Yii::$app->user->identity->branch->branch_description) === 'MAIN')) ? \yii\helpers\ArrayHelper::map(\app\models\base\Ci::find()->orderBy('lname')->where(['branch_id' => Yii::$app->user->identity->branch_id])->orderBy('id')->all(), 'id', 'fullname') : \yii\helpers\ArrayHelper::map(\app\models\base\Ci::find()->orderBy('lname')->all(), 'id', 'fullname'),
                            'options' => ['placeholder' => 'Canvasser'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?=
                        $form->field($loan, 'ci_date')->widget(\kartik\datecontrol\DateControl::classname(), [
                            'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                            'saveFormat' => 'php:Y-m-d',
                            'ajaxConversion' => true,
                            'options' => [
                                'pluginOptions' => [
                                    'placeholder' => 'CI Date',
                                    'autoclose' => true,
                                ],
                            ],
                        ]);
                        ?>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <h4><i class="fa fa-user"></i> <strong>SECOND SIGNATORY</strong></h4>
                    </div>
                </div>
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
                        <?= $form->field($comaker, 'gender') ?> 
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
                    <div class="col-md-4">
                        <?= $form->field($comaker, 'birthplace') ?>
                    </div>
                </div>
                <div class="row">
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
                    </div>
                    <div class="col-md-4">
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
                    <div class="col-md-4">
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
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($comaker, 'address_street_house_no') ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($comaker, 'contact_no') ?>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($loan, 'collaterals')->textarea() ?>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-lg']) ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>

