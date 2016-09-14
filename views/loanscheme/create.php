<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Loanscheme */

$this->title = 'Create Loanscheme';
$this->params['breadcrumbs'][] = ['label' => 'Loanscheme', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loanscheme-create">

    <?= $this->render('_form', [
        'model' => $model,
        'loandata' => $loandata,
    ]) ?>

</div>
