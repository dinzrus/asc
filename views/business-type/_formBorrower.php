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
        'borrower_id' => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden' => true]],
        'borrower_pic' => ['type' => TabularForm::INPUT_TEXT],
        'first_name' => ['type' => TabularForm::INPUT_TEXT],
        'last_name' => ['type' => TabularForm::INPUT_TEXT],
        'middle_name' => ['type' => TabularForm::INPUT_TEXT],
        'name_suffix' => ['type' => TabularForm::INPUT_TEXT],
        'principal_birthdate' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Principal Birthdate',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'principal_age' => ['type' => TabularForm::INPUT_TEXT],
        'birthplace' => ['type' => TabularForm::INPUT_TEXT],
        'address_streetname' => ['type' => TabularForm::INPUT_TEXT],
        'address_barangay' => ['type' => TabularForm::INPUT_TEXT],
        'address_province' => ['type' => TabularForm::INPUT_TEXT],
        'marriage_status' => ['type' => TabularForm::INPUT_TEXT],
        'contact_no' => ['type' => TabularForm::INPUT_TEXT],
        'date_canvass' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Date Canvass',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'date_ci' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Date Ci',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'co_fname' => ['type' => TabularForm::INPUT_TEXT],
        'co_lname' => ['type' => TabularForm::INPUT_TEXT],
        'co_middlename' => ['type' => TabularForm::INPUT_TEXT],
        'co_pic' => ['type' => TabularForm::INPUT_TEXT],
        'relation' => ['type' => TabularForm::INPUT_TEXT],
        'co_alias' => ['type' => TabularForm::INPUT_TEXT],
        'co_address' => ['type' => TabularForm::INPUT_TEXT],
        'co_contact_no' => ['type' => TabularForm::INPUT_TEXT],
        'branch' => ['type' => TabularForm::INPUT_TEXT],
        'spouse_age' => ['type' => TabularForm::INPUT_TEXT],
        'no_of_dependents' => ['type' => TabularForm::INPUT_TEXT],
        'business_address' => ['type' => TabularForm::INPUT_TEXT],
        'business_years' => ['type' => TabularForm::INPUT_TEXT],
        'chattel' => ['type' => TabularForm::INPUT_TEXT],
        'borrower_status' => ['type' => TabularForm::INPUT_TEXT],
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

