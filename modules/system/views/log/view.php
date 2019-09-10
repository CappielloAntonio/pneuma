<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this  yii\web\View
 * @var $model app\modules\system\models\SystemLog
 */

$this->title = Yii::t('layout', 'Error #{id}', ['id' => $model->id]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('layout', 'System Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="box">
    <div class="box-body">
        <?php echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'level',
                'category',
                [
                    'attribute' => 'log_time',
                    'format' => 'datetime',
                    'value' => (int)$model->log_time,
                ],
                'prefix:ntext',
                [
                    'attribute' => 'message',
                    'format' => 'raw',
                    'value' => Html::tag('pre', $model->message, ['style' => 'white-space: pre-wrap']),
                ],
            ],
        ]) ?>
    </div>
</div>


