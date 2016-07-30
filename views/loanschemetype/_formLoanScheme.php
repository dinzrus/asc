<div class="form-group" id="add-loan-scheme">
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
    'formName' => 'LoanScheme',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        'loan_scheme_id' => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden' => true]],
        'daily' => ['type' => TabularForm::INPUT_TEXT],
        'term' => ['type' => TabularForm::INPUT_TEXT],
        'gross_day' => ['type' => TabularForm::INPUT_TEXT],
        'gross_amount' => ['type' => TabularForm::INPUT_TEXT],
        'interest' => ['type' => TabularForm::INPUT_TEXT],
        'interest_amount' => ['type' => TabularForm::INPUT_TEXT],
        'gas' => ['type' => TabularForm::INPUT_TEXT],
        'doc_percentage' => ['type' => TabularForm::INPUT_TEXT],
        'doc_stamp' => ['type' => TabularForm::INPUT_TEXT],
        'mis_percentage' => ['type' => TabularForm::INPUT_TEXT],
        'misc' => ['type' => TabularForm::INPUT_TEXT],
        'admin_fee' => ['type' => TabularForm::INPUT_TEXT],
        'notarial_fee' => ['type' => TabularForm::INPUT_TEXT],
        'additional_fee' => ['type' => TabularForm::INPUT_TEXT],
        'total_deductions' => ['type' => TabularForm::INPUT_TEXT],
        'add_days' => ['type' => TabularForm::INPUT_TEXT],
        'add_coll' => ['type' => TabularForm::INPUT_TEXT],
        'net_proceeds' => ['type' => TabularForm::INPUT_TEXT],
        'penalty' => ['type' => TabularForm::INPUT_TEXT],
        'vat_interest' => ['type' => TabularForm::INPUT_TEXT],
        'vat_amount' => ['type' => TabularForm::INPUT_TEXT],
        'processing_fee' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowLoanScheme(' . $key . '); return false;', 'id' => 'loan-scheme-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Loan Scheme', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowLoanScheme()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

