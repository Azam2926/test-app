<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\db\BaseActiveRecord;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\rest\IndexAction;
use yii\rest\OptionsAction;

class TestController extends ApiController
{
    protected function verbs(): array
    {
        return ArrayHelper::merge(parent::verbs(), [
            'index' => ['GET', 'OPTIONS'],
        ]);
    }

    public $modelClass = 'api\modules\v1\resources\Test';

    public function actions(): array
    {
        return [
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => [$this, 'prepareDataProvider']
            ],
            'options' => [
                'class' => OptionsAction::class,
            ]
        ];
    }


    /**
     * @throws InvalidConfigException
     */
    public function prepareDataProvider()
    {
        $requestParams = Yii::$app->getRequest()->getBodyParams();
        if (empty($requestParams)) {
            $requestParams = Yii::$app->getRequest()->getQueryParams();
        }

        /* @var $modelClass BaseActiveRecord */
        $modelClass = $this->modelClass;

        $query = $modelClass::find()->activated();

        return Yii::createObject([
            'class' => ActiveDataProvider::class,
            'query' => $query,
            'pagination' => false,
            'sort' => [
                'params' => $requestParams,
            ],
        ]);
    }
}
