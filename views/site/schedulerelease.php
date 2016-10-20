<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'SCHEDULE FOR LOAN RELEASING';
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
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <td><strong>Account Type:</strong></td>
                                <td><?= $ltype->loan_description ?></td>
                            </tr>
                            <tr>
                                <td><strong>Daily Amount:</strong></td>
                                <td><?= $damount->daily ?></td>
                            </tr>
                            <tr>
                                <td><strong>Unit:</strong></td>
                                <td><?= $unt->unit_description ?></td>
                            </tr>
                            <tr>
                                <td><strong>Date of Release:</strong></td>
                                <td><?= date('m/d/y'); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <td><strong>Gross Amount:</strong></td>
                                <td style="text-align: right"><?= $damount->gross_amt ?></td>
                            </tr>
                            <tr>
                                <td><strong>Total Deductions:</strong></td>
                                <td style="text-align: right"><?= $damount->total_deductions ?></td>
                            </tr>
                            <tr>
                                <td><strong>Net Proceeds:</strong></td>
                                <td style="text-align: right"><?= $damount->net_proceeds ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <label>Collaterals <small style="color: red;">(required)</small></label>
                        <textarea class="form-control" style="height: 100px" placeholder="Collaterals"></textarea>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success"><i class="fa fa-hdd-o"></i> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

