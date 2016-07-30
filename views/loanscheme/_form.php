<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoanScheme */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'BranchLoanscheme', 
        'relID' => 'branch-loanscheme', 
        'value' => \yii\helpers\Json::encode($model->branchLoanschemes),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="loan-scheme-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'loan_scheme_id')->textInput(['placeholder' => 'Loan Scheme']) ?>

    <?= $form->field($model, 'loanscheme_type')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\LoanschemeType::find()->orderBy('loanscheme_type_id')->asArray()->all(), 'loanscheme_type_id', 'loanscheme_type_id'),
        'options' => ['placeholder' => 'Choose Loanscheme type'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'daily')->textInput(['placeholder' => 'Daily']) ?>

    <?= $form->field($model, 'term')->textInput(['placeholder' => 'Term']) ?>

    <?= $form->field($model, 'gross_day')->textInput(['placeholder' => 'Gross Day']) ?>

    <?= $form->field($model, 'gross_amount')->textInput(['placeholder' => 'Gross Amount']) ?>

    <?= $form->field($model, 'interest')->textInput(['placeholder' => 'Interest']) ?>

    <?= $form->field($model, 'interest_amount')->textInput(['placeholder' => 'Interest Amount']) ?>

    <?= $form->field($model, 'gas')->textInput(['placeholder' => 'Gas']) ?>

    <?= $form->field($model, 'doc_percentage')->textInput(['placeholder' => 'Doc Percentage']) ?>

    <?= $form->field($model, 'doc_stamp')->textInput(['placeholder' => 'Doc Stamp']) ?>

    <?= $form->field($model, 'mis_percentage')->textInput(['placeholder' => 'Mis Percentage']) ?>

    <?= $form->field($model, 'misc')->textInput(['placeholder' => 'Misc']) ?>

    <?= $form->field($model, 'admin_fee')->textInput(['placeholder' => 'Admin Fee']) ?>

    <?= $form->field($model, 'notarial_fee')->textInput(['placeholder' => 'Notarial Fee']) ?>

    <?= $form->field($model, 'additional_fee')->textInput(['placeholder' => 'Additional Fee']) ?>

    <?= $form->field($model, 'total_deductions')->textInput(['placeholder' => 'Total Deductions']) ?>

    <?= $form->field($model, 'add_days')->textInput(['placeholder' => 'Add Days']) ?>

    <?= $form->field($model, 'add_coll')->textInput(['placeholder' => 'Add Coll']) ?>

    <?= $form->field($model, 'net_proceeds')->textInput(['placeholder' => 'Net Proceeds']) ?>

    <?= $form->field($model, 'penalty')->textInput(['placeholder' => 'Penalty']) ?>

    <?= $form->field($model, 'vat_interest')->textInput(['placeholder' => 'Vat Interest']) ?>

    <?= $form->field($model, 'vat_amount')->textInput(['placeholder' => 'Vat Amount']) ?>

    <?= $form->field($model, 'processing_fee')->textInput(['placeholder' => 'Processing Fee']) ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('BranchLoanscheme'),
            'content' => $this->render('_formBranchLoanscheme', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->branchLoanschemes),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
