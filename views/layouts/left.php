<?php

use lajax\translatemanager\helpers\Language as Lx;
use yii\helpers\Html;

$username = !Yii::$app->user->isGuest ? Yii::$app->user->identity->username : ''

?>

<aside class="main-sidebar">

    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">

            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>

            <div class="pull-left info">
                <p><?= $username ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Toogle per la traduzione con l'estensione di lajax -->
        <?= \lajax\translatemanager\widgets\ToggleTranslate::widget() ?>

        <?php
        if(Yii::$app->user->identity->isAdmin) {
            $item = [
                ['label' => 'Main Menu', 'options' => ['class' => 'header']],
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

                ['label' => 'Admin Menu', 'options' => ['class' => 'header']],
                ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                ['label' => Yii::t('layout', 'Language'), 'items' => [
                    ['label' => Yii::t('layout', 'List of languages'), 'url' => ['/translatemanager/language/list']],
                    ['label' => Yii::t('layout', 'Create'), 'url' => ['/translatemanager/language/create']],
                    ['label' => Yii::t('layout', 'Scan'), 'url' => ['/translatemanager/language/scan']],
                    ['label' => Yii::t('layout', 'Optimize'), 'url' => ['/translatemanager/language/optimizer']],
                    ['label' => Yii::t('layout', 'Im-/Export'), 'items' => [
                        ['label' => Yii::t('layout', 'Import'), 'url' => ['/translatemanager/language/import']],
                        ['label' => Yii::t('layout', 'Export'), 'url' => ['/translatemanager/language/export']],
                    ]]
                ]],
                ['label' => Yii::t('layout', 'RBAC'), 'url' => ['/user/admin/index']],

                ['label' => 'User', 'options' => ['class' => 'header']],
                ['label' => 'Profile', 'icon' => 'user', 'url' => ['/user/profile']],
                ['label' => 'Settings', 'icon' => 'user', 'url' => ['/user/settings']],
                ['label' => 'Sign out (' . Yii::$app->user->identity->username . ')', 'icon' => 'file-code-o', 'url' => ['/user/security/logout'], 'option' => ['method' => 'post']]
            ];
        } else {
            $item = [
                ['label' => 'Main Menu', 'options' => ['class' => 'header']],
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

                ['label' => 'User', 'options' => ['class' => 'header']],
                ['label' => 'Profile', 'icon' => 'user', 'url' => ['/user/profile']],
                ['label' => 'Settings', 'icon' => 'user', 'url' => ['/user/settings']],
                ['label' => 'Sign out (' . $username . ')', 'icon' => 'file-code-o', 'url' => ['/user/security/logout'], 'option' => ['method' => 'post']]
            ];
        } ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => $item
            ]
        ) ?>
    </section>
</aside>
