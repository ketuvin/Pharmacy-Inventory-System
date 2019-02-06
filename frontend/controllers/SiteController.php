<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use app\models\Records;
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
                'only' => ['login','logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['login','signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        // $records = Records::find()->all();
        // return $this->render('home', ['records' => $records]);
        return $this->render('index');
    }

    public function actionHome() {

        $query = Records::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 10]);
        $records = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();

        return $this->render('home', [
           'records' => $records,
           'pages' => $pages,
       ]);

    }

    public function actionDashboard() {

        return $this->render('dashboard');
    }

    public function actionCreate() {
        $record = new Records();
        $formData = Yii::$app->request->post();
        if($record->load($formData)){
            if($record->save()){
                Yii::$app->getSession()->setFlash('message','Product has been stored Successfully');
                return $this->redirect(['home']);
            }
            else{
                Yii::$app->getSession()->setFlash('message','Failed to post record.');
            }
        }
        return $this->render('create', ['record' => $record]);
    }

    public function actionView($ID) {
         $record = Records::findOne($ID);
        return $this->render('view', ['record' => $record]);
    }

    public function actionUpdate($ID) {
        $record = Records::findOne($ID);
        if($record->load(Yii::$app->request->post()) && $record -> save()) {
            Yii::$app->getSession()->setFlash('message','Product Updated Successfully');
            return $this->redirect(['home']);
        }
         else{
            return $this->render('update', ['record' => $record]);
        }
    }
    public function actionAddStock($ID) {
        $record = Records::findOne($ID);
        if($record->load(Yii::$app->request->post()) && $record -> save()) {
            Yii::$app->getSession()->setFlash('message','Added Stock Successfully');
            return $this->redirect(['home']);
        }
        else{
            return $this->render('addstock',['record' => $record]);
        }
    }

    // public function actionDelete($ID) {
    //     $record = Records::findOne($ID)->delete();
    //     if($record) {
    //         Yii::$app->getSession()->setFlash('message','Record Deleted Successfully');
    //         return $this->redirect(['home']);
    //     }
    // }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->render('dashboard');
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
