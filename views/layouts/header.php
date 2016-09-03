<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">ASC</span><span class="logo-lg">' . Yii::$app->user->identity->branch->branch_description . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?= Html::img((isset(Yii::$app->user->identity->picture)) ? Yii::$app->user->identity->picture : 'fileupload/default.jpg', ['class' => 'user-image']) ?>
                        <span class="hidden-xs">
                            <?php
                            if (isset(Yii::$app->user->identity->username)) {
                                echo Yii::$app->user->identity->lastname . ', ' . Yii::$app->user->identity->firstname;
                            }
                            ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?= Html::img((isset(Yii::$app->user->identity->picture)) ? Yii::$app->user->identity->picture : 'fileupload/default.jpg', ['class' => 'img-circle']) ?>
                            <p>
                                <?php
                                if (isset(Yii::$app->user->identity->username)) {
                                    echo Yii::$app->user->identity->lastname . ', ' . Yii::$app->user->identity->firstname;
                                }
                                ?>
                                <small><?= Yii::$app->user->identity->email ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">

                            </div>
                            <div class="pull-right">
                                <?=
                                Html::a(
                                        'Sign out', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                )
                                ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
