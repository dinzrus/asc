<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Borrower */

$this->title = $model->principal_last_name . ', ' . $model->principal_first_name;
$this->params['breadcrumbs'][] = ['label' => 'Borrower', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrower-view">

    <div class="row">
        <div class="col-sm-9">
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            <?=
            Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', ['pdf', 'id' => $model->borrower_id], [
                'class' => 'btn btn-danger',
                'target' => '_blank',
                'data-toggle' => 'tooltip',
                'title' => 'Will open the generated PDF file in a new window'
                    ]
            )
            ?>

            <?= Html::a('Update', ['update', 'id' => $model->borrower_id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $model->borrower_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <br />
        </div>
    </div>

    <!------------------------------------------------------------->     
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#principal-applicant" data-toggle="tab">Principal Applicant</a></li>
                    <li><a href="#second-signatory" data-toggle="tab">Second Signatory</a></li>
                    <li><a href="#attachfiles" data-toggle="tab">201 File</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="principal-applicant">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Principal Application</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-8">
                                            <?php
                                            $gridColumn = [
                                                'branch0.branch_description'
                                            ];
                                            echo DetailView::widget([
                                                'model' => $model,
                                                'attributes' => $gridColumn
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="text-align:center;">
                                        <?php
                                            if(empty($model->principal_profile_pic)){
                                                echo Html::img('fileupload/default.jpg', ['class' => 'img-thumbnail', 'width' => '200']); 
                                            }else{
                                                echo Html::img($model->principal_profile_pic, ['class' => 'img-thumbnail', 'width' => '200']);  
                                            } 
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                        $gridColumn = [
                                            'principal_first_name',
                                            'principal_last_name',
                                            'principal_middle_name',
                                            'principal__suffix',
                                            'principal_birthdate',
                                            'principal_age',
                                            'principal_birthplace',
                                            'principal_address_street_house',
                                            'principal_address_barangay',
                                            'principal_address_province',
                                            'principal_civil_status',
                                        ];
                                        echo DetailView::widget([
                                            'model' => $model,
                                            'attributes' => $gridColumn
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                        $gridColumn = [
                                            'principal_contact_no',
                                            'principal_ci_date',
                                            'principal_canvass_date',
                                            'principal_tin_no',
                                            'principal_sss_no',
                                            'principal_ctc_no',
                                            'principal_license_no',
                                            'principal_spouse_name',
                                            'principal_spouse_occupation',
                                            'principal_spouse_birthdate',
                                            'principal_spouse_age',
                                        ];
                                        echo DetailView::widget([
                                            'model' => $model,
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
                                                <?php
                                                $gridColumn = [
                                                    'principal_no_children',
                                                ];
                                                echo DetailView::widget([
                                                    'model' => $model,
                                                    'attributes' => $gridColumn
                                                ]);
                                                ?>
                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <?php
                                                $gridColumn = [
                                                    'principal_child1_name',
                                                    'principal_child2_name',
                                                ];
                                                echo DetailView::widget([
                                                    'model' => $model,
                                                    'attributes' => $gridColumn
                                                ]);
                                                ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?php
                                                $gridColumn = [
                                                    'principal_child1_birthdate',
                                                    'principal_child2_birthdate',
                                                ];
                                                echo DetailView::widget([
                                                    'model' => $model,
                                                    'attributes' => $gridColumn
                                                ]);
                                                ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?php
                                                $gridColumn = [
                                                    'principal_child1_age',
                                                    'principal_child2_age',
                                                ];
                                                echo DetailView::widget([
                                                    'model' => $model,
                                                    'attributes' => $gridColumn
                                                ]);
                                                ?> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php
                                                $gridColumn = [
                                                    'business_name',
                                                    'business_address',
                                                    [
                                                        'attribute' => 'businessType.business_id',
                                                        'label' => 'Business Type',
                                                    ],
                                                    'business_years',
                                                    'business_income',
                                                ];
                                                echo DetailView::widget([
                                                    'model' => $model,
                                                    'attributes' => $gridColumn
                                                ]);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php
                                                $gridColumn = [
                                                    'collaterals:ntext',
                                                ];
                                                echo DetailView::widget([
                                                    'model' => $model,
                                                    'attributes' => $gridColumn
                                                ]);
                                                ?>
                                            </div>
                                        </div>
                                    </div> <!-- col-md-8 end -->
                                </div> <!-- row end -->
                            </div> <!-- box body end -->
                        </div> <!-- box end -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="second-signatory">
                        <!-- comaker start -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Second Signatory</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4" style="text-align:center;">
                                        <?php
                                            if(empty($model->comaker_profile_pic)){
                                                echo Html::img('fileupload/default.jpg', ['class' => 'img-thumbnail', 'width' => '200']); 
                                            }else{
                                                echo Html::img($model->comaker_profile_pic, ['class' => 'img-thumbnail', 'width' => '200']);  
                                            } 
                                        ?>
                                    </div>
                                    <div class="col-md-8">
                                        <?php
                                        $gridColumn = [
                                            'comaker_name',
                                            'comaker_address',
                                            'comaker_alias',
                                            'comaker_contact',
                                            'comaker_occupation',
                                            'comaker_birthdate',
                                            'comaker_age',
                                        ];
                                        echo DetailView::widget([
                                            'model' => $model,
                                            'attributes' => $gridColumn
                                        ]);
                                        ?>
                                    </div>
                                </div>
                            </div> <!-- comaker end -->
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="attachfiles">
                        <?php
                        if (!empty($model->attachments)) {
                            $files = split(' ', $model->attachments);
                            foreach ($files as $file) {
                                echo '<a href="' . Url::to($file) . '" target = "_blank">' . Html::img($file, ['class' => 'img-thumbnail', 'width' => '200']) . '</a>&nbsp;&nbsp;';
                            }
                        }
                        ?>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->

        </div>
    </div>

    <!------------------------------------------------------------->    
</div>