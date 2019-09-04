<?php

namespace app\controllers\translatemanager;

use dektrium\user\filters\AccessRule;
use lajax\translatemanager\controllers\LanguageController as BaseLanguageController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use lajax\translatemanager\models\Language;

class LanguageController extends BaseLanguageController
{

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }
}