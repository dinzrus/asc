<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $borrower app\models\Borrower */

$this->title = $borrower->last_name . ', ' . $borrower->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Borrower', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrower-view">
    <div class="row">
        <div class="col-sm-8">
        </div>
        <div class="col-sm-4">
            <?=
            Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', ['pdf', 'id' => $borrower->id], [
                'class' => 'btn btn-danger',
                'target' => '_blank',
                'data-toggle' => 'tooltip',
                'title' => 'Will open the generated PDF file in a new window'
                    ]
            )
            ?>          
            <?= Html::a('Update', ['update', 'id' => $borrower->id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $borrower->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>
    <br>
    <!-- tab begin here -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#principal" data-toggle="tab"><i class="fa fa-bookmark-o"></i> Principal Applicant</a></li>
            <li><a href="#business" data-toggle="tab"><i class="fa fa-bookmark-o"></i> Business</a></li>
            <li><a href="#attachments" data-toggle="tab"><i class="fa fa-bookmark-o"></i> Attachments</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" id="business">
                <?php
                $gridColumn = [
                    ['attribute' => 'id', 'visible' => false],
                    'business_name',
                    [
                        'attribute' => 'businessType.business_description',
                        'label' => 'Business Type',
                    ],
                    [
                        'attribute' => 'addressProvince.province',
                        'label' => 'Address Province',
                    ],
                    [
                        'attribute' => 'addressCityMunicipality.municipality_city',
                        'label' => 'Address City Municipality',
                    ],
                    [
                        'attribute' => 'addressBarangay.barangay',
                        'label' => 'Address Barangay',
                    ],
                    'address_st_bldng_no',
                    'business_years',
                    'permit_no',
                    'average_weekly_income',
                    'average_gross_daily_income',
                    'ownership',
                ];
                echo DetailView::widget([
                    'model' => $business,
                    'attributes' => $gridColumn
                ]);
                ?>
            </div>
            <div class="active tab-pane" id="principal">
                <div class="row">
                    <div class="col-md-4">
                        <?php
                        if (strtoupper(Yii::$app->user->identity->branch->branch_description) === 'MAIN') {
                            $gridColumn = [
                                [
                                    'attribute' => 'branch.branch_description',
                                    'label' => 'Branch'
                                ]
                            ];
                            echo DetailView::widget([
                                'model' => $borrower,
                                'attributes' => $gridColumn
                            ]);
                        }
                        ?>
                        <br>
                        <center>
                            <?= (isset($borrower->profile_pic)) ? Html::img($borrower->profile_pic, ['width' => 200, 'class' => 'img-thumbnail']) : Html::img('fileupload/default.jpg', ['width' => 200, 'class' => 'img-thumbnail']) ?>
                        </center>

                    </div>
                    <div class="col-md-4">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td><strong>Name</strong></td>
                                <td><?= $borrower->last_name . ', ' . $borrower->first_name . $borrower->suffix . ', ' . $borrower->middle_name ?></td>
                            </tr>
                            <tr>
                                <td><strong>Address</strong></td>
                                <td><?= $borrower->address_street_house_no . ', ' . $borrower->addressBarangay->barangay . ', ' . $borrower->addressCityMunicipality->municipality_city . ', ' . $borrower->addressProvince->province ?></td>
                            </tr>
                            <tr>
                                <td><strong>Contact</strong></td>
                                <td><?= $borrower->contact_no ?></td>
                            </tr>
                            <tr>
                                <td><strong>Date of Birth</strong></td>
                                <td><?= $borrower->birthdate ?></td>
                            </tr>
                            <tr>
                                <td><strong>Age</strong></td>
                                <td><?= $borrower->age ?></td>
                            </tr>
                            <tr>
                                <td><strong>Place of Birth</strong></td>
                                <td><?= $borrower->birthplace ?></td>
                            </tr>
                            <tr>
                                <td><strong>Gender</strong></td>
                                <td><?= $borrower->gender ?></td>
                            </tr>
                            <tr>
                                <td><strong>Civil Status</strong></td>
                                <td><?= $borrower->civil_status ?></td>
                            </tr>

                        </table>
                    </div>
                    <div class="col-md-4">
                        <?php
                        if (!($borrower->spouse_name === "")) {
                            $gridColumn = [
                                'spouse_name',
                                'spouse_occupation',
                                'spouse_age',
                                'spouse_birthdate',
                            ];
                            echo DetailView::widget([
                                'model' => $borrower,
                                'attributes' => $gridColumn
                            ]);
                        }
                        ?>
                        <?php
                        $gridColumn = [
                            'canvasser.fullname',
                            'canvass_date',
                        ];
                        echo DetailView::widget([
                            'model' => $borrower,
                            'attributes' => $gridColumn
                        ]);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <td><strong>No. of Dependent(s)</strong></td>
                                        <td><?= $borrower->no_dependent ?></td>
                                    </tr>
                                </table>
                            </div></div>
                        <?php if ((count($dependents) > 0)): ?>
                            <table class="table table-striped table-bordered detail-view">
                                <tr>
                                    <td><strong>Name</strong></td>
                                    <td><strong>Age</strong></td>
                                    <td><strong>Date of Birth</strong></td>
                                </tr>
                                <?php foreach ($dependents as $dependent): ?>
                                    <tr>
                                        <td><?= $dependent->name ?></td>
                                        <td><?= $dependent->age ?></td>
                                        <td><?= $dependent->birthdate ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php endif; ?>    

                        <table class="table table-striped table-bordered">
                            <?php if (!($borrower->father_name === "")): ?>
                                <tr>
                                    <td><strong>Father Name</strong></td>
                                    <td><?= $borrower->father_name ?></td>
                                    <td><strong>Age</strong></td>
                                    <td><?= $borrower->father_age ?></td>
                                    <td><strong>Date of Birth</strong></td>
                                    <td><?= $borrower->father_birthdate ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if (!($borrower->mother_name === "")): ?>
                                <tr>
                                    <td><strong>Mother Name</strong></td>
                                    <td><?= $borrower->mother_name ?></td>
                                    <td><strong>Age</strong></td>
                                    <td><?= $borrower->mother_age ?></td>
                                    <td><strong>Date of Birth</strong></td>
                                    <td><?= $borrower->mother_birthdate ?></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div> <!-- principal tab end here -->
            <div class="tab-pane" id="attachments">
                <?php
                $urls = [];
                $urls = explode(";", $borrower->attachment);
                if (isset($borrower->attachment)):
                    foreach ($urls as $url) :
                        ?>
                        <a href="<?= Url::to($url) ?>" target="_blank"><?= Html::img($url, ['width' => 200, 'class' => 'img-thumbnail']) ?></a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <center>
                        <?= Html::img('fileupload/folder.png', ['width' => 400, 'class' => 'img-thumbnail']) ?>
                    </center>
                <?php endif; ?>
            </div> <!-- attachments tab end here -->
        </div>
    </div>
    <!-- tab end here -->

</div>