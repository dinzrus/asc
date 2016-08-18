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
            <li class="active"><a href="#principal" data-toggle="tab">Principal Applicant</a></li>
            <li><a href="#comaker" data-toggle="tab">Second Signatory</a></li>
            <li><a href="#attachments" data-toggle="tab">Attachments</a></li>
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="principal">
                <div class="row">
                    <div class="col-md-4">
                        <br>
                        <center>
                            <?= (isset($borrower->profile_pic)) ? Html::img($borrower->profile_pic, ['width' => 200, 'class' => 'img-thumbnail']) : Html::img('fileupload/default.jpg', ['width' => 200, 'class' => 'img-thumbnail']) ?>
                        </center>
                        <br>
                        <?php
                        $gridColumn = [
                            //['attribute' => 'id', 'hidden' => true],
                            'first_name',
                            'last_name',
                            'middle_name',
                            'suffix',
                        ];
                        echo DetailView::widget([
                            'model' => $borrower,
                            'attributes' => $gridColumn
                        ]);
                        ?>
                    </div>
                    <div class="col-md-4">
                        <?php
                        $gridColumn = [
                            //['attribute' => 'id', 'hidden' => true],
                            'birthdate',
                            'age',
                            'birthplace',
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
                            'address_street_house_no',
                            'civil_status',
                            'contact_no',
                            'tin_no',
                            'sss_no',
                            'ctc_no',
                            'no_dependent',
                        ];
                        echo DetailView::widget([
                            'model' => $borrower,
                            'attributes' => $gridColumn
                        ]);
                        ?>
                    </div>
                    <div class="col-md-4">
                        <?php
                        $gridColumn = [
                            'license_no',
                            'spouse_name',
                            'spouse_occupation',
                            'spouse_age',
                            'spouse_birthdate',
                            'ci_date',
                            'canvass_date',
                            [
                                'attribute' => 'status0.status',
                                'label' => 'Status',
                            ],
                            'branch_id',
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
                        <?php
                        $gridColumn = [
                            'collaterals:ntext',
                        ];
                        echo DetailView::widget([
                            'model' => $borrower,
                            'attributes' => $gridColumn
                        ]);
                        ?>
                    </div>
                </div>
            </div> <!-- principal tab end here -->
            <div class="tab-pane" id="comaker">
                <div class="row">
                    <div class="col-md-4">
                        <br>
                        <center>
                            <?= Html::img($comaker->profile_pic, ['width' => 200, 'class' => 'img-thumbnail']) ?>
                        </center>
                        <br>
                    </div>
                    <div class="col-md-4">
                        <?php
                        $gridColumn = [
                            //['attribute' => 'id', 'hidden' => true],
                            'last_name',
                            'first_name',
                            'middle_name',
                            'age',
                            'birthdate',
                            'birthplace',
                        ];
                        echo DetailView::widget([
                            'model' => $comaker,
                            'attributes' => $gridColumn
                        ]);
                        ?>
                    </div>
                    <div class="col-md-4">
                        <?php
                        $gridColumn = [
                            //['attribute' => 'id', 'hidden' => true],
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
                            'address_street_house_no',
                            'civil_status',
                            'contact_no',
                        ];
                        echo DetailView::widget([
                            'model' => $comaker,
                            'attributes' => $gridColumn
                        ]);
                        ?>
                    </div>
                </div>
            </div> <!-- comaker tab end here -->
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