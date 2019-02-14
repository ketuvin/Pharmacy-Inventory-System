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
use app\models\Units;
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
                'only' => ['dashboard','home','withdraw','deposit','update','view','create','addstock'],
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['dashboard','home','withdraw','deposit','update','view','create','addstock'],
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
        $record2 = new Units();
        $formData = Yii::$app->request->post();
        if($record->load($formData) && $record1->load($formData) && $record2->load($formData)){

            $postGetValue = Yii::$app->request->post('Category')['categID'];
            $postGetValue1 = Yii::$app->request->post('Units')['unitID'];
            $query = Category::findOne(['categID' => $postGetValue]);
            $query1 = Units::findOne(['unitID' => $postGetValue1]);
            $record->Category = $query->Name;
            $record->Unit = $query1->Unit_name;

            if($record->save(false)){
                Yii::$app->getSession()->setFlash('message','Product has been added Successfully');
                return $this->redirect(['home']);
            }
            else{
                Yii::$app->getSession()->setFlash('message','Failed to add product.');
                return $this->redirect(['create']);
            }
        }
        return $this->render('create', [
            'record' => $record,
            'record1' => $record1,
            'record2' => $record2,
        ]);
    }

    public function actionView($ID, $Category) {
        $record = Records::findOne($ID);
        $record1 = Category::findOne(['Name' => $Category]);
        return $this->render('view', [
            'record' => $record,
            'record1' => $record1,
        ]);
    }

    public function actionUpdate($ID,$Category) {
        $record = Records::findOne($ID);
        $formData = Yii::$app->request->post();
        if(($record->load($formData) && $record->save())) {
            Yii::$app->getSession()->setFlash('message','Product Updated Successfully');
            return $this->redirect(['home']);
        }
         else{
            return $this->render('update', [
                'record' => $record,
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

    public function actionAddunit() {
        $unit = new Units();
        $formData = Yii::$app->request->post();
        if($unit->load($formData)){
            if($unit->save()){
                Yii::$app->getSession()->setFlash('message','Unit has been added Successfully');
                return $this->redirect(['unit']);
            }
            else{
                Yii::$app->getSession()->setFlash('message','Failed to add unit.');
            }
        }
        return $this->render('addunit', [
            'unit' => $unit,
        ]);
    }

    public function actionUnit() {
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

    public function actionEdit($categID) {
        $category = Category::findOne($categID);
        $formData = Yii::$app->request->post();
        if(($category->load($formData) && $category->save())) {
            Yii::$app->getSession()->setFlash('message','Product Updated Successfully');
            return $this->redirect(['home']);
        }
         else{
            return $this->render('edit', [
                'category' => $category,
            ]);
        }
    }

    public function actionCategory() {
        $query = Category::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 10]);
        $category = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();

        return $this->render('category', [
           'category' => $category,
           'pages' => $pages,
       ]);
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
   
}
