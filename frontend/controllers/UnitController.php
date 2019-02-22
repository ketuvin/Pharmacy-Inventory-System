<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Units;
use yii\data\Pagination;

class UnitController extends Controller
{
	/**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['unit','addunit'],
                'rules' => [
                    [
                        'actions' => ['unit','addunit'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionUnit() {
        $this->layout = 'loggedin';
        $query = Units::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 10]);
        $units = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();

        return $this->render('unit', [
           'units' => $units,
           'pages' => $pages,
       ]);
    }

    public function actionAddunit() {
        $unit = new Units();
        $formData = Yii::$app->request->post();
        if($unit->load($formData)){
            $postGetValue = strtolower(Yii::$app->request->post('Units')['unit_name']);

            if(Units::findOne(['unit_name' => $postGetValue])) {
                Yii::$app->getSession()->setFlash('error','Unit already exist.');
                return $this->redirect(['unit']);
            }else {
                if($unit->save()){
                    Yii::$app->getSession()->setFlash('message','Unit has been added Successfully');
                    return $this->redirect(['unit']);
                }
                else{
                    Yii::$app->getSession()->setFlash('error','Failed to add unit.');
                    return $this->redirect(['unit']);
                }
            }
        }
        return $this->renderAjax('addunit', [
            'unit' => $unit,
        ]);
    }
}
?>