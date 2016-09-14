<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LoanschemeAssignment */

$this->title = 'Create Loanscheme Assignment';
$this->params['breadcrumbs'][] = ['label' => 'Loanscheme Assignment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loanscheme-assignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
