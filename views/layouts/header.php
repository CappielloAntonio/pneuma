<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">
    <?= Html::a('<span class="logo-mini">T</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <?= Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right', 'style' => ['padding-right' => '10px']],
            'items' => [
                Yii::$app->session->has(\dektrium\user\controllers\AdminController::ORIGINAL_USER_SESSION_KEY) ?
                    ['label' => Yii::t('layout', 'Switch back'),
                        'url' => ['/user/admin/switch'],
                        'linkOptions' => ['data-method' => 'post']
                    ] :
                    '',
                ]
            ]
        ) ?>
    </nav>
</header>
