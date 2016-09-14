<div class="form-group" id="add-loanscheme-values">
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
    'formName' => 'LoanschemeValues',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
        'daily' => ['type' => TabularForm::INPUT_TEXT],
        'term' => ['type' => TabularForm::INPUT_TEXT],
        'gross_amt' => ['type' => TabularForm::INPUT_TEXT],
        'interest' => ['type' => TabularForm::INPUT_TEXT],
        'vat' => ['type' => TabularForm::INPUT_TEXT],
        'admin_fee' => ['type' => TabularForm::INPUT_TEXT],
        'notary_fee' => ['type' => TabularForm::INPUT_TEXT],
        'misc' => ['type' => TabularForm::INPUT_TEXT],
        'doc_stamp' => ['type' => TabularForm::INPUT_TEXT],
        'gas' => ['type' => TabularForm::INPUT_TEXT],
        'total_deductions' => ['type' => TabularForm::INPUT_TEXT],
        'add_days' => ['type' => TabularForm::INPUT_TEXT],
        'add_coll' => ['type' => TabularForm::INPUT_TEXT],
        'net_proceeds' => ['type' => TabularForm::INPUT_TEXT],
        'penalty' => ['type' => TabularForm::INPUT_TEXT],
        'pen_days' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowLoanschemeValues(' . $key . '); return false;', 'id' => 'loanscheme-values-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Loanscheme Values', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowLoanschemeValues()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

