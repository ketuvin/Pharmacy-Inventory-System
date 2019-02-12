<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Pharmacy controller
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['changepassword'],
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['changepassword'],
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
     /**
     *
     * @return mixed
     */
    public function actionChangepassword() {
        //set up user and load post data
        $user = Yii::$app->user->identity;
        $loadPost = $user->load(Yii::$app->request->post());
        //Validate for normal request
        if($loadPost && $user->validate()){

            $user->password = $user->newPassword;
            //save, set flash, and refresh page
            $user->save(false);
            //var dump user errors
            Yii::$app->session->setFlash('success','You have successfully changed your password.');
            return $this->refresh();

        }
        return $this->render('changepassword',['user' => $user]);
    }
}
