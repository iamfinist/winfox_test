<?php

namespace app\controllers;

use app\models\User;
use Yii;

class UserController extends \yii\rest\Controller
{
    public $modelClass = \app\models\User::class;
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        $behaviours = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => [
                    'http://localhost:5173',

                ],
                'Access-Control-Request-Method' => ['POST'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Max-Age' => 3600 * 5,

            ],
        ];

        return $behaviors;
    }

    public function actionCreate() {
        $model = new User();
        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return [
                'success' => true
            ];
        }
        Yii::$app->response->setStatusCode(409);
        return [
            'success' => false,
            'errors' => $model->getFirstErrors()
        ];
    }

}