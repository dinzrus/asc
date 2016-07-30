<?php
/* @var $this yii\web\View */

use yii\bootstrap\Modal;
?>
<h1>report/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>
<?php
Modal::begin([
    'header' => '<h2>Hello world</h2>',
    'toggleButton' => ['label' => 'click me', 'class' => 'btn btn-primary'],
]);

echo 'Say hello...';

Modal::end();
?>
