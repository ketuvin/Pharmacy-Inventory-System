<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\SignupForm;
use backend\models\AdduserForm;
use common\models\User;
use yii\data\Pagination;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','signup'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'viewadmin','adduser'],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionViewadmin() {

        $user = User::find()->where(['role' => 10]);

        $pages = new Pagination(['totalCount' => $user->count(), 'defaultPageSize' => 5]);
        $users = $user->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
    
        return $this->render('viewadmin', [
           'users' => $users,
           'pages' => $pages,
       ]);

    }

    public function actionAdduser() {
        $model = new AdduserForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup() && $model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'User Added Successfully. Confirmation link sent via email.');
                return $this->redirect(['viewadmin']);
            }
            else {
                Yii::$app->session->setFlash('error', 'Failed to add user.');
                return $this->redirect(['adduser']);
            }
        }
        
        return $this->render('adduser', ['model' => $model]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
            return $this->redirect(['viewadmin']);
        } else {
            return $this->render('login', ['model' => $model]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup() {

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->session->setFlash('success', 'Sign Up Successfully');
                return $this->redirect(['login']);
            }
            else {
                Yii::$app->session->setFlash('error', 'Sign Up Failed.');
                return $this->redirect(['signup']);
            }
        }
        
        return $this->render('signup', ['model' => $model]);
    }
}
