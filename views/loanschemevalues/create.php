<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LoanschemeValues */

$this->title = 'Create Loanscheme Values';
$this->params['breadcrumbs'][] = ['label' => 'Loanscheme Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loanscheme-values-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
