<?php
/* @var $this yii\web\View */
$this->title = $borrower->fullname;

$this->params['breadcrumbs'][] = ['label' => 'Approval List', 'url' => ['site/releasingapproval']];
$this->params['breadcrumbs'][] = ['label' => 'View: ' . $this->title];
?>
<style>
    .bold-me {
        font-weight: bolder;
    }
</style>

<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-chevron-down"></i> Borrower</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-chevron-down"></i> Business Information</a></li>
        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false"><i class="fa fa-chevron-down"></i> Loan Information</a></li>
        <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false"><i class="fa fa-chevron-down"></i> Attachments</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Borrower Info.
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td class="bold-me">Address:</td>
                                    <td><?= $borrower->fulladdress ?></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">Date of Birth:</td>
                                    <td><?= Yii::$app->formatter->asDate($borrower->birthdate) ?></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">Place of Birth:</td>
                                    <td><?= $borrower->birthplace ?></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">Civil Status:</td>
                                    <td><?= $borrower->civil_status ?></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">Contact No.:</td>
                                    <td><?= $borrower->contact_no ?></td>
                                </tr>
                            </table>
                        </div></div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Parent Info.
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td class="bold-me">Name:</td>
                                    <td class="bold-me">Date of Birth:</td>
                                    <td class="bold-me">Age:</td>

                                </tr>
                                <tr>
                                    <td><?= $borrower->father_name ?></td>
                                    <td><?= Yii::$app->formatter->asDate($borrower->father_birthdate) ?></td>
                                    <td><?= $borrower->father_age ?></td>
                                </tr>
                                <tr>
                                    <td><?= $borrower->mother_name ?></td>
                                    <td><?= Yii::$app->formatter->asDate($borrower->mother_birthdate) ?></td>
                                    <td><?= $borrower->mother_age ?></td>
                                </tr>
                            </table>
                        </div></div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Dependent(s)</div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td class="bold-me">No. of Dependent(s)</td>
                                    <td></td>
                                    <td><?= $borrower->no_dependent ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">Name:</td>
                                    <td class="bold-me">Date of Birth</td>
                                    <td class="bold-me">Age</td>
                                </tr>
                                <?php foreach ($dependent as $dp) : ?>
                                    <tr>
                                        <td><?= $dp->name ?></td>
                                        <td><?= Yii::$app->formatter->asDate($dp->birthdate) ?></td>
                                        <td><?= $dp->age ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Spouse Information
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td class="bold-me">Name:</td>
                                    <td><?= $borrower->spouse_name ?></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">Occupation:</td>
                                    <td><?= $borrower->spouse_occupation ?></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">Date of Birth:</td>
                                    <td><?= Yii::$app->formatter->asDate($borrower->spouse_birthdate) ?></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">Age:</td>
                                    <td><?= $borrower->spouse_age ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Valid ID(s)</div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td class="bold-me">SSS NO.</td>
                                    <td><?= $borrower->sss_no ?></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">TIN NO.</td>
                                    <td><?= $borrower->tin_no ?></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">CTC NO.</td>
                                    <td><?= $borrower->ctc_no ?></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">LICENSE NO.</td>
                                    <td><?= $borrower->license_no ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td class="bold-me">Business Name</td>
                                    <td><?= $business->business_name ?></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">Type</td>
                                    <td><?= $business->businessType->business_description ?></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">Permit No.</td>
                                    <td><?= $business->permit_no ?></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">Business Average Weekly Income</td>
                                    <td><?= $business->average_weekly_income ?></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">Business Average Gross Daily Income</td>
                                    <td><?= $business->average_gross_daily_income ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td class="bold-me">Address</td>
                                    <td><?= $business->fulladdress ?></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">Years in Business</td>
                                    <td><?= $business->business_years ?></td>
                                </tr>
                                <tr>
                                    <td class="bold-me">Business Ownership</td>
                                    <td><?= $business->ownership ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Loan Details
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-condensed table-bordered table-hover">
                                <tr>
                                    <th>Daily</th>
                                    <td><?= $loan->daily ?></td>
                                </tr>
                                <tr>
                                    <th>Account Type</th>
                                    <td><?= $loan->loan_type ?></td>
                                </tr>
                                <tr>
                                    <th>Unit</th>
                                    <td><?= $loan->unit?></td>
                                </tr>
                                <tr>
                                    <th>Release Date</th>
                                    <td><?= $loan->release_date ?></td>
                                </tr>
                                <tr>
                                    <th>Maturity Date</th>
                                    <td><?= $loan->maturity_date ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-condensed table-bordered table-hover">
                                <tr bgcolor="#bef4e1">
                                    <th>GROSS AMOUNT</th>
                                    <td><?= $loan->gross_amount ?></td>
                                </tr>
                                <tr>
                                    <th>- Interest Deduction</th>
                                    <td><?= $loan->interest_bdays ?></td>
                                </tr>
                                <tr>
                                    <th>- Processing / Admin Fee</th>
                                    <td><?= $loan->admin_fee ?></td>
                                </tr>
                                <tr>
                                    <th>- Notary Fees</th>
                                    <td><?= $loan->notarial_fee ?></td>
                                </tr>
                                <tr>
                                    <th>- Gas Surcharge</th>
                                    <td><?= $loan->gas ?></td>
                                </tr>
                                <tr>
                                    <th>- Doc. Stamp</th>
                                    <td><?= $loan->doc_stamp?></td>
                                </tr>
                                <tr bgcolor="#bef4e1">
                                    <th>NET PROCEEDS</th>
                                    <td><?= $loan->net_proceeds ?></td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Comaker Info.
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered table-condensed table-hover">
                                <tr>
                                    <th>Last Name</th>
                                    <td><?= $comaker['last_name'] ?></td>
                                </tr>
                                <tr>
                                    <th>First Name</th>
                                    <td><?= $comaker['first_name'] ?></td>
                                </tr>
                                <tr>
                                    <th>Middle Name</th>
                                    <td><?= $comaker['middle_name'] ?></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><?= $comaker['full_address'] ?></td>
                                </tr>
                                <tr>
                                    <th>Contact No.</th>
                                    <td><?= $comaker['contact_no'] ?></td>
                                </tr>
                            </table>
                            
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered table-condensed table-hover">
                                <tr>
                                    <th>Gender</th>
                                    <td><?= $comaker['gender'] ?></td>
                                </tr>
                                <tr>
                                    <th>Civil Status</th>
                                    <td><?= $comaker['civil_status'] ?></td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td><?= $comaker['birthdate'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_4">

        </div>
        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->

