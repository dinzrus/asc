<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Barangay */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'Borrower',
        'relID' => 'borrower',
        'value' => \yii\helpers\Json::encode($model->borrowers),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'Business',
        'relID' => 'business',
        'value' => \yii\helpers\Json::encode($model->businesses),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>
<div class="box box-solid">
    <div class="box-body">
        <div class="barangay-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->errorSummary($model); ?>

            <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <?= $form->field($model, 'barangay')->textInput(['maxlength' => true, 'placeholder' => 'Barangay']) ?>

            <?=
            $form->field($model, 'municipality_city_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\MunicipalityCity::find()->orderBy('id')->asArray()->all(), 'id', 'municipality_city'),
                'options' => ['placeholder' => 'Choose Municipality city'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

            <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

<?php ActiveForm::end(); ?>

        </div>
    </div>
</div>