<?php

namespace api\modules\v1\controllers;

use api\modules\v1\models\LoginForm;
use api\modules\v1\models\RegisterForm;
use common\models\User;
use Yii;
use yii\base\Exception;
use yii\filters\Cors;
use yii\rest\Controller;
use yii\rest\OptionsAction;
use yii\web\ForbiddenHttpException;
use yii\web\UnauthorizedHttpException;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class UserController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * @return array
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => Cors::class,
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'options' => [
                'class' => OptionsAction::class
            ]
        ];
    }


    /**
     * @throws ForbiddenHttpException
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->login())
            return $model->getUser();

        Yii::$app->response->statusCode = 422;
        return [
            'errors' => $model->errors,
        ];
    }

    /**
     * @throws Exception
     */
    public function actionRegister()
    {

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->register())
            return $model->user;

        Yii::$app->response->statusCode = 422;
        return [
            'errors' => $model->errors
        ];
    }

    public function actionData()
    {
        $headers = Yii::$app->request->headers;
        if (!isset($headers['Authorization']))
            throw new UnauthorizedHttpException();

        $accessToken = explode(" ", $headers['Authorization'])[1];
        $user = \api\modules\v1\resources\User::findIdentityByAccessToken($accessToken);
        if (!$user)
            throw new UnauthorizedHttpException();

        return $user;

    }

    /**
     * @return User|null|\yii\web\IdentityInterface
     */
    public function actionIndex()
    {
        $resource = new User();
        $resource->load(Yii::$app->user->getIdentity()->attributes, '');
        return $resource;
    }
}
