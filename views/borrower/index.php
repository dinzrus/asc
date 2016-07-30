<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\BorrowerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Borrower';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="borrower-index">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Borrower', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button']) ?>
    </p>
    <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        //'borrower_id',
        //'principal_profile_pic',
        'principal_first_name',
        'principal_last_name',
        'principal_middle_name',
//        'principal__suffix',
//        'principal_birthdate',
//        'principal_age',
//        'principal_birthplace',
//        'principal_address_street_house',
//        'principal_address_barangay',
//        'principal_address_province',
//        'principal_civil_status',
//        'principal_contact_no',
        'principal_ci_date',
        'principal_canvass_date',
//        'principal_tin_no',
//        'principal_sss_no',
//        'principal_ctc_no',
//        'principal_license_no',
//        'principal_spouse_name',
//        'principal_spouse_occupation',
//        'principal_spouse_age',
//        'principal_spouse_birthdate',
//        'principal_no_children',
//        'principal_child1_name',
//        'principal_child2_name',
//        'principal_child1_birthdate',
//        'principal_child2_birthdate',
//        'principal_child1_age',
//        'principal_child2_age',
//        'comaker_profile_pic',
    [
        'attribute' => 'comaker_name',
        'label' => 'Comaker',
    ],
//        'comaker_address',
//        'comaker_alias',
//        'comaker_contact',
//        'comaker_occupation',
//        'comaker_birthdate',
//        'comaker_age',
//        'comaker_relation',
//        'business_name',
//        'business_address',
//        [
//                'attribute' => 'business_type',
//                'label' => 'Business Type',
//                'value' => function($model){
//                    return $model->businessType->business_id;
//                },
//                'filterType' => GridView::FILTER_SELECT2,
//                'filter' => \yii\helpers\ArrayHelper::map(\app\models\BusinessType::find()->asArray()->all(), 'business_id', 'business_id'),
//                'filterWidgetOptions' => [
//                    'pluginOptions' => ['allowClear' => true],
//                ],
//                'filterInputOptions' => ['placeholder' => 'Business type', 'id' => 'grid-borrower-search-business_type']
//            ],
//        'business_years',
//        'business_income',
//        'collaterals:ntext',
//        'status',
        [
            'attribute' => 'branch',
            'label' => 'Branch',
            'value' => function($model){
                            return $model->branch0->branch_description;
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-borrower']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
            ]) ,
        ],
    ]); ?>

</div>
