<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LoanschemeType */

$this->title = 'Create Loanscheme Type';
$this->params['breadcrumbs'][] = ['label' => 'Loanscheme Type', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loanscheme-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
