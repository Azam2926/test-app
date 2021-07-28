<?php

namespace api\modules\v1\controllers;

use api\modules\v1\actions\CheckAnswers;
use api\modules\v1\actions\Index;
use api\modules\v1\resources\Question;
use Swagger\Annotations as SWG;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\rest\OptionsAction;
use yii\rest\ViewAction;
use yii\web\HttpException;

/**
 * @SWG\Swagger(
 *     schemes={"http","https"},
 *     basePath="/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Test API Documentation",
 *         description="API description...",
 *         termsOfService="",
 *         @SWG\License(
 *             name="BSD License",
 *             url="https://raw.githubusercontent.com/yii2-starter-kit/yii2-starter-kit/master/LICENSE.md"
 *         )
 *     ),
 * )
 * @author Eugene Terentev <eugene@terentev.net>
 */
class QuestionController extends ApiController
{
    protected function verbs(): array
    {
        return ArrayHelper::merge(parent::verbs(), [
            'check-answers' => ['POST', 'OPTIONS'],
            'index' => ['GET', 'OPTIONS'],
        ]);
    }

    /**
     * @var string
     */
    public $modelClass = 'api\modules\v1\resources\Question';

    /**
     * @SWG\Get(path="/v1/question/index",
     *     tags={"question", "index"},
     *     summary="Retrieves the collection of Articles.",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Article collection response",
     *         @SWG\Schema(ref = "#/definitions/Article")
     *     ),
     * )
     *
     * @SWG\Get(path="/v1/question/view",
     *     tags={"Article"},
     *     summary="Displays data of one question only",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Used to fetch information of a specific question.",
     *         @SWG\Schema(ref = "#/definitions/Article")
     *     ),
     * )
     *
     * @SWG\Options(path="/v1/question/options",
     *     tags={"Article"},
     *     summary="Displays the options for the question resource.",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Displays the options available for the Article resource",
     *         @SWG\Schema(ref = "#/definitions/Article")
     *     ),
     * )
     */
    public function actions(): array
    {
        return [
            'index' => [
                'class' => Index::class,
                'modelClass' => $this->modelClass,
            ],
            'view' => [
                'class' => ViewAction::class,
                'modelClass' => $this->modelClass,
                'findModel' => [$this, 'findModel']
            ],
            'options' => [
                'class' => OptionsAction::class,

            ],
            'check-answers' => [
                'class' => CheckAnswers::class,
                'modelClass' => $this->modelClass,
            ],
        ];
    }

    /**
     * @return ActiveDataProvider
     */

    /**
     * @param $id
     * @return array|null|ActiveRecord
     * @throws HttpException
     */
    public function findModel($id)
    {
        $model = Question::find()
            ->activated()
            ->where(['id' => (int)$id])
            ->with('questionAnswers')
            ->one();
        if (!$model) {
            throw new HttpException(404);
        }
        return $model;
    }
}
