<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Records;
use app\models\Category;
use yii\data\Pagination;
/**
 * Pharmacy controller
 */
class PharmacyController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => [''],
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

    public function actionHome() {

        $query = Records::find();
        $query2 = Category::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 10]);
        $records = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
        $category = $query2->all();
        return $this->render('home', [
           'records' => $records,
           'pages' => $pages,
           'category' => $category,
       ]);

    }

    public function actionDashboard() {

        return $this->render('dashboard');
    }

    public function actionCreate() {
        $record = new Records();
        $record1 = new Category();
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
        return $this->render('create', [
            'record' => $record,
            'record1' => $record1,
        ]);
    }

    public function actionView($ID) {
        $record = Records::findOne($ID);
        return $this->render('view', ['record' => $record]);
    }

    public function actionUpdate($ID,$Category) {
        $record = Records::findOne($ID);
        $record1 = Category::findOne(['Name' => $Category]);
        $formData = Yii::$app->request->post();
        if(($record->load($formData) && $record->save()) && ($record1->load($formData) && $record1->save())) {
            Yii::$app->getSession()->setFlash('message','Product Updated Successfully');
            return $this->redirect(['home']);
        }
         else{
            return $this->render('update', [
                'record' => $record,
                'record1' => $record1,
            ]);
        }
    }

    public function actionAddstock($ID) {
        $record = Records::findOne($ID);
        if($record->load(Yii::$app->request->post()) && $record -> save()) {
            Yii::$app->getSession()->setFlash('message','Added Stock Successfully');
            return $this->redirect(['home']);
        }
        else{
            Yii::$app->getSession()->setFlash('message','Failed to add stock.');
            return $this->render('addstock',['record' => $record]);
        }
    }

    public function actionWithdraw() {
        $record = new Records();
        $formData = Yii::$app->request->post();
        if($record->load($formData)){
            if($record->save()){
                Yii::$app->getSession()->setFlash('message','Withdraw Stock Successfully');
                return $this->redirect(['home']);
            }
            else{
                Yii::$app->getSession()->setFlash('message','Failed to withdraw stock.');
            }
        }
        return $this->render('withdraw', ['record' => $record]);
    }

    public function actionDeposit() {
        return $this->render('deposit');
    }
     /**
     *
     * @return mixed
     */
    public function actionChangepassword() {
        return $this->render('changepassword');
    }
    // public function actionDelete($ID) {
    //     $record = Records::findOne($ID)->delete();
    //     if($record) {
    //         Yii::$app->getSession()->setFlash('message','Record Deleted Successfully');
    //         return $this->redirect(['home']);
    //     }
    // }
}
