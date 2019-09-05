<?php

use app\assets\AppAsset;
use dmstr\widgets\Alert;
use \yii\helpers\Html;
use \yii\helpers\Inflector;

?>

<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) : ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php else : ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo Html::encode($this->title);
                } else {
                    echo Inflector::camel2words(Inflector::id2camel($this->context->module->id));
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php endif; ?>
    </section>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
</footer>