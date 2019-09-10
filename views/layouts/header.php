<?php

use app\modules\system\models\SystemLog;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\log\Logger;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">
    <?= Html::a('<span class="logo-mini">T</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only"><?php echo Yii::t('layout', 'Toggle navigation') ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Notifications: style can be found in dropdown.less -->
                <?php if(Yii::$app->user->identity->isAdmin) : ?>
                <li id="log-dropdown" class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-warning"></i>
                        <span class="label label-danger">
                                <?php echo SystemLog::find()->count() ?>
                            </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"><?php echo Yii::t('layout', 'You have {num} log items', ['num' => SystemLog::find()->count()]) ?></li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <?php foreach (SystemLog::find()->orderBy(['log_time' => SORT_DESC])->limit(5)->all() as $logEntry): ?>
                                    <li>
                                        <a href="<?php echo Yii::$app->urlManager->createUrl(['/system/log/view', 'id' => $logEntry->id]) ?>">
                                            <i class="fa fa-warning <?php echo $logEntry->level === Logger::LEVEL_ERROR ? 'text-red' : 'text-yellow' ?>"></i>
                                            <?php echo $logEntry->category ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li class="footer">
                            <?php echo Html::a(Yii::t('layout', 'View all'), ['/system/log/index']) ?>
                        </li>
                    </ul>
                </li>
                <?php endif?>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo Yii::$app->user->identity->profile->getAvatarUrl(160) ?>"
                             class="user-image">
                        <span><?php echo Yii::$app->user->identity->username ?> <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header light-blue">
                            <img src="<?php echo Yii::$app->user->identity->profile->getAvatarUrl(160) ?>"
                                 class="img-circle" alt="User Image"/>
                            <p>
                                <?php echo Yii::$app->user->identity->username ?>
                                <small>
                                    <?php echo Yii::t('layout', 'Member since {0, date, short}', Yii::$app->user->identity->created_at) ?>
                                </small>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?php echo Html::a(Yii::t('layout', 'Profile'), ['/user/profile'], ['class' => 'btn btn-default btn-flat']) ?>
                            </div>
                            <div class="pull-left">
                                <?php echo Html::a(Yii::t('layout', 'Account'), ['/user/settings'], ['class' => 'btn btn-default btn-flat']) ?>
                            </div>
                            <div class="pull-right">
                                <?php echo Html::a(Yii::t('layout', 'Logout'), ['/user/logout'], ['class' => 'btn btn-default btn-flat', 'data-method' => 'post']) ?>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    <?php if (Yii::$app->session->has(\dektrium\user\controllers\AdminController::ORIGINAL_USER_SESSION_KEY))
                        echo Html::a(Yii::t('layout', 'Switch back'), ['/user/admin/switch'], ['data-method' => 'POST']);
                    ?>
                </li>
                <li>
                    <?php echo Html::a('<i class="fa fa-cogs"></i>', ['/user/settings']) ?>
                </li>
            </ul>
        </div>
    </nav>

</header>
