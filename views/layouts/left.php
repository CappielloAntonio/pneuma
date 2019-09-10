<?php

use app\modules\system\models\SystemLog;
use dektrium\user\models\Profile;
use yii\helpers\Url;
use lajax\translatemanager\helpers\Language as Lx;
use yii\helpers\Html;

$username = !Yii::$app->user->isGuest ? Yii::$app->user->identity->username : ''

?>

<aside class="main-sidebar">

    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">

            <div class="pull-left image">
                <?= Html::img(Yii::$app->user->identity->profile->getAvatarUrl(160), [
                    'class' => 'img-rounded img-responsive',
                    'alt' => Yii::$app->user->identity->username,
                ]) ?>
            </div>

            <div class="pull-left info">
                <p><?php echo Yii::t('layout', 'Hello, {username}', ['username' => $username]) ?></p>
                <a href="<?php echo Url::to(['/sign-in/profile']) ?>">
                    <i class="fa fa-circle text-success"></i>
                    <?php echo Yii::$app->formatter->asDatetime(time()) ?>
                </a>
            </div>
        </div>

        <!-- Toogle per la traduzione con l'estensione di lajax -->
        <?= \lajax\translatemanager\widgets\ToggleTranslate::widget() ?>

        <?php if(Yii::$app->user->identity->isAdmin) { // -------------------------------------------------------------- ADMIN
            $item = [
                ['label' => Yii::t('layout', 'Main Menu'), 'options' => ['class' => 'header']],
                ['label' => Yii::t('layout', 'Home'), 'icon' => 'home', 'url' => ['/site/index']],

                ['label' => Yii::t('layout', 'Admin Menu'), 'options' => ['class' => 'header']],
                ['label' => Yii::t('layout', 'Gii'), 'icon' => 'desktop', 'url' => ['/gii']],
                ['label' => Yii::t('layout', 'Debug'), 'icon' => 'bug', 'url' => ['/debug']],
                ['label' => Yii::t('layout', 'Language'), 'icon' => 'language', 'items' => [
                    ['label' => Yii::t('layout', 'List of languages'), 'icon' => 'list', 'url' => ['/translatemanager/language/list']],
                    ['label' => Yii::t('layout', 'Create'), 'icon' => 'plus', 'url' => ['/translatemanager/language/create']],
                    ['label' => Yii::t('layout', 'Scan'), 'icon' => 'filter', 'url' => ['/translatemanager/language/scan']],
                    ['label' => Yii::t('layout', 'Optimize'), 'icon' => 'rocket', 'url' => ['/translatemanager/language/optimizer']],
                    ['label' => Yii::t('layout', 'Im-/Export'), 'icon' => 'exchange', 'items' => [
                        ['label' => Yii::t('layout', 'Import'), 'icon' => 'chevron-left', 'url' => ['/translatemanager/language/import']],
                        ['label' => Yii::t('layout', 'Export'), 'icon' => 'chevron-right', 'url' => ['/translatemanager/language/export']],
                    ]]
                ]],
                ['label' => Yii::t('layout', 'RBAC'), 'icon' => 'institution',  'url' => ['/user/admin/index']],
                [
                    'label' => Yii::t('layout', 'Logs'),
                    'icon' => 'warning',
                    'url' => ['/system/log/index'],
                    'template'=>'<a href="{url}">{icon} {label}<span class="pull-right-container"><small class="label pull-right bg-red">' . SystemLog::find()->count() . '</small></span></a>'
                ],

                ['label' => Yii::t('layout', 'User'), 'options' => ['class' => 'header']],
                ['label' => Yii::t('layout', 'Profile'), 'icon' => 'user', 'url' => ['/user/profile']],
                ['label' => Yii::t('layout', 'Settings'), 'icon' => 'gears', 'url' => ['/user/settings']],
                ['label' => Yii::t('layout', 'Sign out'), 'icon' => 'sign-out', 'url' => ['/user/security/logout'], 'option' => ['method' => 'post']]
            ];
        } elseif (Yii::$app->user->isGuest) { // ----------------------------------------------------------------------- OSPITE
            $item = [
                ['label' => Yii::t('layout', 'Main Menu'), 'options' => ['class' => 'header']],
                ['label' => Yii::t('layout', 'Login'), 'url' => ['site/login']],
            ];
        } else { // ---------------------------------------------------------------------------------------------------- UTENTE
            $item = [
                ['label' => Yii::t('layout', 'Main Menu'), 'options' => ['class' => 'header']],
                ['label' => Yii::t('layout', 'Home'), 'icon' => 'home', 'url' => ['/site/index']],

                ['label' => Yii::t('layout', 'User'), 'options' => ['class' => 'header']],
                ['label' => Yii::t('layout', 'Profile'), 'icon' => 'user', 'url' => ['/user/profile']],
                ['label' => Yii::t('layout', 'Settings'), 'icon' => 'gears', 'url' => ['/user/settings']],
                ['label' => Yii::t('layout', 'Sign out'), 'icon' => 'sign-out', 'url' => ['/user/security/logout'], 'option' => ['method' => 'post']]
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
