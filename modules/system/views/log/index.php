<?php

use trntv\yii\datetime\DateTimeWidget;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\JsExpression;

/**
 * @var $this         yii\web\View
 * @var $searchModel  app\modules\system\models\search\SystemLogSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('layout', 'System Logs');

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="box">
    <div class="box-body">
        <p>
            <?php echo Html::a(Yii::t('layout', 'Clear'), false, ['class' => 'btn btn-danger', 'data-method' => 'delete']) ?>
        </p>

        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => '',
            'options' => [
                'class' => 'grid-view table-responsive',
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'level',
                    'value' => function ($model) {
                        return \yii\log\Logger::getLevelName($model->level);
                    },
                    'filter' => [
                        \yii\log\Logger::LEVEL_ERROR => 'error',
                        \yii\log\Logger::LEVEL_WARNING => 'warning',
                        \yii\log\Logger::LEVEL_INFO => 'info',
                        \yii\log\Logger::LEVEL_TRACE => 'trace',
                        \yii\log\Logger::LEVEL_PROFILE_BEGIN => 'profile begin',
                        \yii\log\Logger::LEVEL_PROFILE_END => 'profile end',
                    ],
                ],
                'category',
                'prefix',
                [
                    'attribute' => 'log_time',
                    'format' => 'datetime',
                    'value' => function ($model) {
                        return (int)$model->log_time;
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                ],
            ],
        ]); ?>
    </div>
</div>
