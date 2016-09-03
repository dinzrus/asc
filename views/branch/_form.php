<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Branch */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'BranchLoanscheme',
        'relID' => 'branch-loanscheme',
        'value' => \yii\helpers\Json::encode($model->branchLoanschemes),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'Unit',
        'relID' => 'unit',
        'value' => \yii\helpers\Json::encode($model->units),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>
<div class="box box-solid">
    <div class="box-body">
        <div class="branch-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->errorSummary($model); ?>

            <?= $form->field($model, 'branch_description')->textInput(['maxlength' => true, 'placeholder' => 'Branch Description']) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder' => 'Address']) ?>

            <?= $form->field($model, 'telephone_no')->textInput(['maxlength' => true, 'placeholder' => 'Telephone No']) ?>

            <?php
            $forms = [
                [
                    'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('Unit'),
                    'content' => $this->render('_formUnit', [
                        'row' => \yii\helpers\ArrayHelper::toArray($model->units),
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
    </div>
</div>