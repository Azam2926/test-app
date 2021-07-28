<?php
/**
 * User: azam
 * Date: 28/07/21
 * Time: 14:04
 */

namespace api\modules\v1\controllers;


use yii\filters\Cors;
use yii\rest\ActiveController;

class ApiController extends ActiveController
{
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => Cors::class,
        ];

        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;
    }
}