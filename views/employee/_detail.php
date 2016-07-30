<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

?>
<div class="employee-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->employee_id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'employee_id',
        'firstname',
        'lastname',
        'middlename',
        'birth_date',
        'gender',
        'civil_status',
        'home_address',
        'sss_no',
        'philhealth_no',
        'tin_no',
        'profile_pic',
        'contact_no',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>