<div class="form-group" id="add-business">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'Business',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
        'business_name' => ['type' => TabularForm::INPUT_TEXT],
        'address_province_id' => [
            'label' => 'Province',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Province::find()->orderBy('province')->asArray()->all(), 'id', 'province'),
                'options' => ['placeholder' => 'Choose Province'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'address_city_municipality_id' => [
            'label' => 'Municipality city',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\MunicipalityCity::find()->orderBy('municipality_city')->asArray()->all(), 'id', 'municipality_city'),
                'options' => ['placeholder' => 'Choose Municipality city'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'address_barangay_id' => [
            'label' => 'Barangay',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Barangay::find()->orderBy('barangay')->asArray()->all(), 'id', 'barangay'),
                'options' => ['placeholder' => 'Choose Barangay'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'address_st_bldng_no' => ['type' => TabularForm::INPUT_TEXT],
        'business_years' => ['type' => TabularForm::INPUT_TEXT],
        'permit_no' => ['type' => TabularForm::INPUT_TEXT],
        'average_weekly_income' => ['type' => TabularForm::INPUT_TEXT],
        'average_gross_daily_income' => ['type' => TabularForm::INPUT_TEXT],
        'ownership' => ['type' => TabularForm::INPUT_TEXT],
        'borrower_id' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowBusiness(' . $key . '); return false;', 'id' => 'business-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Business', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowBusiness()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

