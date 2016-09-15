<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Exceltest */
/* @var $form ActiveForm */

$this->title = 'Upload Loanscheme';
$this->params['breadcrumbs'][] = ['label' => 'Loanscheme', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-excelupload">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($loanscheme, 'loanscheme_name')->textInput() ?>
    
        <?= $form->field($loandata, 'excelfile')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-excelupload -->
