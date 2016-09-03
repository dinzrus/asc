<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ci */

$this->title = 'Create Ci';
$this->params['breadcrumbs'][] = ['label' => 'Ci', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ci-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
