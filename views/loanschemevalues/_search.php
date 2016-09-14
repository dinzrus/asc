<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoanschemevaluesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-loanscheme-values-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

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

    <?php /* echo $form->field($model, 'interest')->textInput(['placeholder' => 'Interest']) */ ?>

    <?php /* echo $form->field($model, 'vat')->textInput(['placeholder' => 'Vat']) */ ?>

    <?php /* echo $form->field($model, 'admin_fee')->textInput(['placeholder' => 'Admin Fee']) */ ?>

    <?php /* echo $form->field($model, 'notary_fee')->textInput(['placeholder' => 'Notary Fee']) */ ?>

    <?php /* echo $form->field($model, 'misc')->textInput(['placeholder' => 'Misc']) */ ?>

    <?php /* echo $form->field($model, 'doc_stamp')->textInput(['placeholder' => 'Doc Stamp']) */ ?>

    <?php /* echo $form->field($model, 'gas')->textInput(['placeholder' => 'Gas']) */ ?>

    <?php /* echo $form->field($model, 'total_deductions')->textInput(['placeholder' => 'Total Deductions']) */ ?>

    <?php /* echo $form->field($model, 'add_days')->textInput(['placeholder' => 'Add Days']) */ ?>

    <?php /* echo $form->field($model, 'add_coll')->textInput(['placeholder' => 'Add Coll']) */ ?>

    <?php /* echo $form->field($model, 'net_proceeds')->textInput(['placeholder' => 'Net Proceeds']) */ ?>

    <?php /* echo $form->field($model, 'penalty')->textInput(['placeholder' => 'Penalty']) */ ?>

    <?php /* echo $form->field($model, 'pen_days')->textInput(['placeholder' => 'Pen Days']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
