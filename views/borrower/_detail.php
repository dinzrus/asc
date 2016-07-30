<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Borrower */

?>
<div class="borrower-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->borrower_id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'borrower_id',
        'principal_profile_pic',
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
        'principal_contact_no',
        'principal_business_type',
        'principal_ci_date',
        'principal_canvass_date',
        'principal_tin_no',
        'principal_sss_no',
        'principal_ctc_no',
        'principal_license_no',
        'principal_spouse_name',
        'principal_spouse_occupation',
        'principal_spouse_age',
        'principal_spouse_birthdate',
        'principal_no_children',
        'principal_child1_name',
        'principal_child2_name',
        'principal_child1_birthdate',
        'principal_child2_birthdate',
        'principal_child1_age',
        'principal_child2_age',
        'comaker_profile_pic',
        'comaker_name',
        'comaker_address',
        'comaker_alias',
        'comaker_contact',
        'comaker_occupation',
        'comaker_birthdate',
        'comaker_age',
        'comaker_relation',
        'business_name',
        'business_address',
        [
            'attribute' => 'businessType.business_id',
            'label' => 'Business Type',
        ],
        'business_years',
        'business_income',
        'collaterals:ntext',
        'status',
        'branch',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>