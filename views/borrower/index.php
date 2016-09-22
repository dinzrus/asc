<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\BorrowerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'Borrower';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="borrower-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Borrower', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button']) ?>
    </p>
    <div class="search-form" style="display:none">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'hidden' => true],
        //'profile_pic',
        'last_name',
        'first_name',
        'middle_name',
        'suffix',
        //'birthdate',
        //'age',
        //'birthplace',
//        [
//                'attribute' => 'address_province_id',
//                'label' => 'Address Province',
//                'value' => function($model){
//                    return $model->addressProvince->province;
//                },
//                'filterType' => GridView::FILTER_SELECT2,
//                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Province::find()->asArray()->all(), 'id', 'province'),
//                'filterWidgetOptions' => [
//                    'pluginOptions' => ['allowClear' => true],
//                ],
//                'filterInputOptions' => ['placeholder' => 'Province', 'id' => 'grid-borrower-search-address_province_id']
//            ],
//        [
//                'attribute' => 'address_city_municipality_id',
//                'label' => 'Address City Municipality',
//                'value' => function($model){
//                    return $model->addressCityMunicipality->municipality_city;
//                },
//                'filterType' => GridView::FILTER_SELECT2,
//                'filter' => \yii\helpers\ArrayHelper::map(\app\models\MunicipalityCity::find()->asArray()->all(), 'id', 'municipality_city'),
//                'filterWidgetOptions' => [
//                    'pluginOptions' => ['allowClear' => true],
//                ],
//                'filterInputOptions' => ['placeholder' => 'Municipality city', 'id' => 'grid-borrower-search-address_city_municipality_id']
//            ],
//        [
//                'attribute' => 'address_barangay_id',
//                'label' => 'Address Barangay',
//                'value' => function($model){
//                    return $model->addressBarangay->barangay;
//                },
//                'filterType' => GridView::FILTER_SELECT2,
//                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Barangay::find()->asArray()->all(), 'id', 'barangay'),
//                'filterWidgetOptions' => [
//                    'pluginOptions' => ['allowClear' => true],
//                ],
//                'filterInputOptions' => ['placeholder' => 'Barangay', 'id' => 'grid-borrower-search-address_barangay_id']
//            ],
        //'address_street_house_no',
        //'civil_status',
        'contact_no',
        'canvass_date',
//        'tin_no',
//        'sss_no',
//        'ctc_no',
//        'license_no',
//        'spouse_name',
//        'spouse_occupation',
        //'spouse_age',
        //'spouse_birthdate',
        //'no_dependent',
        //'collaterals:ntext',
//        [  // I comment this because our comaker has no clients.. we will solve this later.. Russel.
//                'attribute' => 'status',
//                'label' => 'Status',
//                'value' => function($model){
//                    return $model->status0->status;
//                },
//                'filterType' => GridView::FILTER_SELECT2,
//                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Status::find()->asArray()->all(), 'code', 'status'),
//                'filterWidgetOptions' => [
//                    'pluginOptions' => ['allowClear' => true],
//                ],
//                'filterInputOptions' => ['placeholder' => 'Status', 'id' => 'grid-borrower-search-status']
//            ],
        (strtoupper(Yii::$app->user->identity->branch->branch_description) === "MAIN") ?
                [
            'attribute' => 'branch_id',
            'label' => 'Branch',
            'value' => function($model) {
                return $model->branch->branch_description;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Branch::find()->asArray()->all(), 'branch_id', 'branch_description'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Branch', 'id' => 'grid-borrower-search-branch_id']
                ] : 'gender',
        //'attachment:ntext',
        //'relation_to_applicant',
        //'acount_type',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
                ],
            ];
            ?>
            <?=
            GridView::widget([
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
                    ]),
                ],
            ]);
            ?>

</div>
