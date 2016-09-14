<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoanschemeValues */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="loanscheme-values-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'loanscheme_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Loanscheme::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Loanscheme'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'daily')->textInput(['placeholder' => 'Daily']) ?>

    <?= $form->field($model, 'term')->textInput(['placeholder' => 'Term']) ?>

    <?= $form->field($model, 'gross_amt')->textInput(['placeholder' => 'Gross Amt']) ?>

    <?= $form->field($model, 'interest')->textInput(['placeholder' => 'Interest']) ?>

    <?= $form->field($model, 'vat')->textInput(['placeholder' => 'Vat']) ?>

    <?= $form->field($model, 'admin_fee')->textInput(['placeholder' => 'Admin Fee']) ?>

    <?= $form->field($model, 'notary_fee')->textInput(['placeholder' => 'Notary Fee']) ?>

    <?= $form->field($model, 'misc')->textInput(['placeholder' => 'Misc']) ?>

    <?= $form->field($model, 'doc_stamp')->textInput(['placeholder' => 'Doc Stamp']) ?>

    <?= $form->field($model, 'gas')->textInput(['placeholder' => 'Gas']) ?>

    <?= $form->field($model, 'total_deductions')->textInput(['placeholder' => 'Total Deductions']) ?>

    <?= $form->field($model, 'add_days')->textInput(['placeholder' => 'Add Days']) ?>

    <?= $form->field($model, 'add_coll')->textInput(['placeholder' => 'Add Coll']) ?>

    <?= $form->field($model, 'net_proceeds')->textInput(['placeholder' => 'Net Proceeds']) ?>

    <?= $form->field($model, 'penalty')->textInput(['placeholder' => 'Penalty']) ?>

    <?= $form->field($model, 'pen_days')->textInput(['placeholder' => 'Pen Days']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
