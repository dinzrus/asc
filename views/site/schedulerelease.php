<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'SCHEDULE FOR LOAN RELEASING';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-5">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#account" data-toggle="tab"><i class="fa fa-tag"></i> <strong>Account Info.</strong></a></li>
                <li><a href="#second" data-toggle="tab"><i class="fa fa-tag"></i> <strong>Second Sig.</strong></a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="account">
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
                    <label>Collaterals</label>
                    <textarea class="form-control"></textarea>
                </div>
                <div class="tab-pane" id="second">

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
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
                                <td>
                                    <select class="form-control">
                                        <option>N-celp</option>
                                        <option>PD-celp</option>
                                        <option>ERP-celp</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Account Type:</strong></td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <td><strong>Account Type:</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Account Type:</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Account Type:</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-hdd-o"></i> Save</button>
    </div>
</div>
