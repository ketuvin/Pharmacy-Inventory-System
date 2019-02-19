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
use common\models\Withdrawals;
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
        $this->layout = 'loggedin';
        $query = Records::find();
        $query2 = Category::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 5]);
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
        $this->layout = 'loggedin';
        return $this->render('dashboard');
    }

    public function actionAddproduct() {
        $this->layout = 'loggedin';
        $record = new Records();
        $record1 = new Category();
        $record2 = new Units();
        $formData = Yii::$app->request->post();
        if($record->load($formData) && $record1->load($formData) && $record2->load($formData)){

            $postGetValue = Yii::$app->request->post('Category')['Category'];
            $postGetValue1 = Yii::$app->request->post('Units')['Unit_name'];
            $query = Category::findOne(['categID' => $postGetValue]);
            $query1 = Units::findOne(['unitID' => $postGetValue1]);
            $record->Category = $query->Category;
            $record->Unit = $query1->Unit_name;

            if($record->save(false)){
                Yii::$app->getSession()->setFlash('message','Product has been added Successfully');
                return $this->redirect(['home']);
            }
            else{
                Yii::$app->getSession()->setFlash('message','Failed to add product.');
                return $this->redirect(['home']);
            }
        }
        return $this->renderAjax('addproduct', [
            'record' => $record,
            'record1' => $record1,
            'record2' => $record2,
        ]);
    }

    public function actionView($ID, $Category) {
        $this->layout = 'loggedin';
        $record = Records::findOne($ID);
        $record1 = Category::findOne(['Category' => $Category]);
        return $this->renderAjax('view', [
            'record' => $record,
            'record1' => $record1,
        ]);
    }

    public function actionUpdate($ID) {
        $this->layout = 'loggedin';
        $record = Records::findOne($ID);
        $formData = Yii::$app->request->post();
        if(($record->load($formData) && $record->save())) {
            Yii::$app->getSession()->setFlash('message','Product Updated Successfully');
            return $this->redirect(['home']);
        }
         else{
            return $this->renderAjax('update', [
                'record' => $record,
            ]);
        }
    }

    public function actionAddstock($ID) {
        $this->layout = 'loggedin';
        $record = Records::findOne($ID);
        if($record->load(Yii::$app->request->post())){
            $restock = Yii::$app->request->post('Records')['Re_stock'];
            $stock = $record->Quantity;
            $record->Quantity = $stock + $restock;
            $record->removeRestock();
            if ($record -> save()) {
                Yii::$app->getSession()->setFlash('message','Added Stock Successfully');
                return $this->redirect(['home']);
            }
            else{
                Yii::$app->getSession()->setFlash('message','Failed to add stock.');
            }
        }
        return $this->renderAjax('addstock',['record' => $record]);
    }

    public function actionAddunit() {
        $this->layout = 'loggedin';
        $unit = new Units();
        $formData = Yii::$app->request->post();
        if($unit->load($formData)){
            if($unit->save()){
                Yii::$app->getSession()->setFlash('message','Unit has been added Successfully');
                return $this->redirect(['unit']);
            }
            else{
                Yii::$app->getSession()->setFlash('message','Failed to add unit.');
                return $this->redirect(['unit']);
            }
        }
        return $this->renderAjax('addunit', [
            'unit' => $unit,
        ]);
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

    public function actionEdit($categID) {
        $this->layout = 'loggedin';
        $category = Category::findOne($categID);
        $formData = Yii::$app->request->post();
        if(($category->load($formData) && $category->save())) {
            Yii::$app->getSession()->setFlash('message','Category Updated Successfully');
            return $this->redirect(['category']);
        }
         else{
            return $this->renderAjax('edit', [
                'category' => $category,
            ]);
        }
    }

    public function actionCategory() {
        $this->layout = 'loggedin';
        $query = Category::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 5]);
        $category = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();

        return $this->render('category', [
           'category' => $category,
           'pages' => $pages,
       ]);
    }

    public function actionWithdrawals() {
        $this->layout = 'loggedin';
        $query = Withdrawals::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 10]);
        $withdrawals = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();

        return $this->render('withdrawals', [
           'withdrawals' => $withdrawals,
           'pages' => $pages,
       ]);
    }

    public function actionWithdrawproduct() {
        $this->layout = 'loggedin';
        $record = new Records();
        $record1 = new Withdrawals();
        $formData = Yii::$app->request->post();
        if($record->load($formData) && $record1->load($formData)){
            $postGetValue = Yii::$app->request->post('Records')['Name'];
            $restock = Yii::$app->request->post('Records')['Re_stock'];

            $record = Records::findOne(['ID' => $postGetValue]);

            $record1->Product_name = $record->Name;
            date_default_timezone_set("Asia/Singapore");
            $record1->Created_Date = date('M d, Y h:i:s A');
            $record1->withdrawby_user = Yii::$app->user->identity->fullname . '(' . Yii::$app->user->identity->username . ')';

            if($record->Quantity >= $restock) {
                $stock = $record->Quantity;
                $record->Quantity = $stock - $restock;
                $record->removeRestock();

                if($record->save() && $record1->save()){
                    Yii::$app->getSession()->setFlash('message','Withdraw Stock Successfully');
                    return $this->redirect(['withdrawals']);
                }
                else{
                    Yii::$app->getSession()->setFlash('message','Failed to withdraw stock.');
                    return $this->redirect(['withdrawals']);
                }
            } else {
                Yii::$app->getSession()->setFlash('message','Cannot withdraw stock. Withdraw exceeded the available stock.');
                return $this->redirect(['withdrawals']);
            }
            
        }
        return $this->renderAjax('withdrawproduct', [
            'record' => $record,
            'record1' => $record1
        ]);
    }

    public function actionDeposit() {
        $this->layout = 'loggedin';
        return $this->render('deposit');
    }
   
}
