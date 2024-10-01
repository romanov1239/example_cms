<?php

namespace api\modules\v1\controllers;

use api\modules\v1\controllers\AppController;
use common\models\Post;
use Yii;
use yii\helpers\ArrayHelper;

class PostController extends AppController
{

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authentificator' => [
                'except' => ['index', 'view', 'create'],

            ]
        ]);
    }

//    public function verbs()
//    {
//        return [
//            'create' => ['POST', 'OPTIONS']
//        ]
//    }

    public function actionIndex()
    {
        return [
            'posts' => Post::find()->all(),
        ];
    }
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return [
                    'success' => true,
                    'data' => $model,
                ];
            }
        }
        return [
            'success' => false,
            'data' => $model->getErrors(),
        ];
    }


}