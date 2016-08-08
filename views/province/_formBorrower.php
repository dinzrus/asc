<div class="form-group" id="add-borrower">
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
    'formName' => 'Borrower',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions'=>['hidden'=>true]],
        'profile_pic' => ['type' => TabularForm::INPUT_TEXT],
        'first_name' => ['type' => TabularForm::INPUT_TEXT],
        'last_name' => ['type' => TabularForm::INPUT_TEXT],
        'middle_name' => ['type' => TabularForm::INPUT_TEXT],
        'suffix' => ['type' => TabularForm::INPUT_TEXT],
        'birthdate' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Birthdate',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'age' => ['type' => TabularForm::INPUT_TEXT],
        'birthplace' => ['type' => TabularForm::INPUT_TEXT],
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
        'address_street_house_no' => ['type' => TabularForm::INPUT_TEXT],
        'civil_status' => ['type' => TabularForm::INPUT_TEXT],
        'contact_no' => ['type' => TabularForm::INPUT_TEXT],
        'ci_date' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Ci Date',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'canvass_date' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Canvass Date',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'tin_no' => ['type' => TabularForm::INPUT_TEXT],
        'sss_no' => ['type' => TabularForm::INPUT_TEXT],
        'ctc_no' => ['type' => TabularForm::INPUT_TEXT],
        'license_no' => ['type' => TabularForm::INPUT_TEXT],
        'spouse_name' => ['type' => TabularForm::INPUT_TEXT],
        'spouse_occupation' => ['type' => TabularForm::INPUT_TEXT],
        'spouse_age' => ['type' => TabularForm::INPUT_TEXT],
        'spouse_birthdate' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Spouse Birthdate',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'no_dependent' => ['type' => TabularForm::INPUT_TEXT],
        'collaterals' => ['type' => TabularForm::INPUT_TEXTAREA],
        'status' => [
            'label' => 'Status',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Status::find()->orderBy('status')->asArray()->all(), 'code', 'status'),
                'options' => ['placeholder' => 'Choose Status'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'branch_id' => ['type' => TabularForm::INPUT_TEXT],
        'attachment' => ['type' => TabularForm::INPUT_TEXTAREA],
        'relation_to_applicant' => ['type' => TabularForm::INPUT_TEXT],
        'acount_type' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowBorrower(' . $key . '); return false;', 'id' => 'borrower-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Borrower', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowBorrower()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

