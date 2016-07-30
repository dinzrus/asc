<div class="form-group" id="add-loan">
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
    'formName' => 'Loan',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        'loan_id' => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden' => true]],
        'loan_no' => ['type' => TabularForm::INPUT_TEXT],
        'borrower' => ['type' => TabularForm::INPUT_TEXT],
        'unit' => [
            'label' => 'Unit',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Unit::find()->orderBy('unit_id')->asArray()->all(), 'unit_id', 'unit_id'),
                'options' => ['placeholder' => 'Choose Unit'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'release_date' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Release Date',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'maturity_date' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Maturity Date',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'daily' => ['type' => TabularForm::INPUT_TEXT],
        'term' => ['type' => TabularForm::INPUT_TEXT],
        'gross_amount' => ['type' => TabularForm::INPUT_TEXT],
        'interest_bdays' => ['type' => TabularForm::INPUT_TEXT],
        'gas' => ['type' => TabularForm::INPUT_TEXT],
        'doc_stamp' => ['type' => TabularForm::INPUT_TEXT],
        'misc' => ['type' => TabularForm::INPUT_TEXT],
        'admin_fee' => ['type' => TabularForm::INPUT_TEXT],
        'notarial_fee' => ['type' => TabularForm::INPUT_TEXT],
        'additional_fee' => ['type' => TabularForm::INPUT_TEXT],
        'total_deductions' => ['type' => TabularForm::INPUT_TEXT],
        'add_days' => ['type' => TabularForm::INPUT_TEXT],
        'add_coll' => ['type' => TabularForm::INPUT_TEXT],
        'net_proceeds' => ['type' => TabularForm::INPUT_TEXT],
        'penalty' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowLoan(' . $key . '); return false;', 'id' => 'loan-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Loan', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowLoan()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

