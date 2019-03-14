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
use common\models\Withdrawals;
use common\models\Deposits;
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
                        'actions' => ['logout', 'viewadmin','adduser', 'dashboard','withdrawals','viewwithdraw','deposits','viewdeposits'],
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
        if (Yii::$app->user->isGuest) {
            return $this->render('index');
        } else {
            return $this->redirect('dashboard');
        }
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

    public function actionDashboard() {
        return $this->render('dashboard');
    }

    public function actionWithdrawals() {
        $model = new Withdrawals();
        $dataProvider = $model->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 10;

        return $this->render('withdrawals', [
           'dataProvider' => $dataProvider,
       ]);
    }

    public function actionDeposits() {
        $model = new Deposits();
        $dataProvider = $model->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 10;

        return $this->render('deposits', [
           'dataProvider' => $dataProvider,
       ]);
    }

    public function actionViewwithdraw($pull_outno) {
        $model = Withdrawals::findOne($pull_outno);

        return $this->renderAjax('viewwithdraw', ['model' => $model]);
    }

    public function actionViewdeposits($depositno) {
        $model = Deposits::findOne($depositno);

        return $this->renderAjax('viewdeposits', ['model' => $model]);
    }

    public function actionAdduser() {
        $model = new AdduserForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->signup() && $model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'User Added Successfully. Confirmation link sent via email. You only have 24 hours to activate your account.');
                return $this->redirect(['viewadmin']);
            }
            else {
                Yii::$app->session->setFlash('error', 'Failed to add user.');
            }
        }
        
        return $this->renderAjax('adduser', ['model' => $model]);
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
            return $this->redirect(['dashboard']);
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
            }
        }
        
        return $this->render('signup', ['model' => $model]);
    }
}
