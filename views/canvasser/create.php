<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Canvasser */

$this->title = 'Create Canvasser';
$this->params['breadcrumbs'][] = ['label' => 'Canvasser', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="canvasser-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
