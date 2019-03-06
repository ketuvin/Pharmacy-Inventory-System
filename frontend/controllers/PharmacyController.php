<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Records;
use frontend\models\Category;
use frontend\models\Units;
use common\models\Deposits;
use yii\helpers\Json;
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
                'only' => ['dashboard','product','updateproduct','viewproduct','addproduct','addstock'],
                'rules' => [
                    [
                        'actions' => ['dashboard','product','updateproduct','viewproduct','addproduct','addstock'],
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

    public function actionProduct() {
        $this->layout = 'loggedin';
        $model = new Records();
        $dataProvider = $model->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 5;

        return $this->render('product', [
           'dataProvider' => $dataProvider,
       ]);

    }

    public function actionDashboard() {
        $this->layout = 'loggedin';
        // return $this->render('dashboard');

        $data = Yii::$app->db->createCommand('select 
             generic_name,quantity,category
             from records 
             order by quantity ASC LIMIT 5')->queryAll();

        $data1 = Yii::$app->db->createCommand('select 
             product_name,current_stock,category
             from deposits 
             order by depositno DESC LIMIT 5')->queryAll();

             return $this->render('dashboard', [
             'diagram' => $data,
             'diagram1' => $data1
        ]);

    }

    public function actionAddproduct() {
        $name = [];
        $brand = [];
        $manufacturer = [];
        $category = [];
        $record = new Records();
        $record1 = new Category();
        $record2 = new Units();
        $formData = Yii::$app->request->post();
        if($record->load($formData) && $record1->load($formData) && $record2->load($formData)){

            $postGetValue = Yii::$app->request->post('Category')['category'];
            $postGetValue1 = Yii::$app->request->post('Units')['unit_name'];
            $postGetValue2 = Yii::$app->request->post('Records')['generic_name'];
            $postGetValue3 = Yii::$app->request->post('Records')['brand'];
            $postGetValue4 = Yii::$app->request->post('Records')['manufacturer'];
            $postGetValue5 = Yii::$app->request->post('Records')['strength'];
            $queryCat = Category::findOne(['categ_id' => $postGetValue]);
            $query1 = Units::findOne(['unit_id' => $postGetValue1]);
            $record->category = $queryCat->category;
            $record->unit = $query1->unit_name;
            $record->brand = $postGetValue3;

            $query2 = Records::find()->orderBy(['sku' => SORT_DESC])->one();

            if($query2 == null){
                $record->sku = 'PHAR.00001';
            } else {
                $id = $query2->sku;
                $record->sku = ++$id;
            }

            if($record->save(false)) {
                Yii::$app->getSession()->setFlash('message','Product has been added Successfully');
                return $this->redirect(['product']);
            } else {
                Yii::$app->getSession()->setFlash('error','Failed to Add Product');
                return $this->redirect(['product']);
            }
        } else {
            return $this->renderAjax('addproduct', [
                'record' => $record,
                'record1' => $record1,
                'record2' => $record2,
            ]);
        }
    }

    public function actionViewproduct($id, $category) {
        $record = Records::findOne($id);
        $record1 = Category::findOne(['category' => $category]);
        
        return $this->renderAjax('viewproduct', [
            'record' => $record,
            'record1' => $record1,
        ]);
    }

    public function actionUpdateproduct($id) {
        $name = [];
        $brand = [];
        $manufacturer = [];
        $category = [];
        $record = Records::findOne($id);
        $formData = Yii::$app->request->post();
        if($record->load($formData)) {

            $postGetValue = Yii::$app->request->post('Records')['category'];
            $postGetValue1 = Yii::$app->request->post('Records')['generic_name'];
            $postGetValue2 = Yii::$app->request->post('Records')['brand'];
            $postGetValue3 = Yii::$app->request->post('Records')['manufacturer'];
            $postGetValue4 = Yii::$app->request->post('Records')['strength'];

            $record->brand = $postGetValue2;

            if($record->save(false)){
                Yii::$app->getSession()->setFlash('message','Product Updated Successfully');
                return $this->redirect(['product']);
            } else {
                Yii::$app->getSession()->setFlash('error','Failed to Update Product');
                return $this->redirect(['product']);
            }
        }
         else{
            return $this->renderAjax('updateproduct', [
                'record' => $record,
            ]);
        }
    }

    public function actionGetStockAvailable($id)
    {
       $record = Records::findOne(['id' => $id]);
       return Json::encode($record);
    }

    public function actionAddstock($id) {
        $record = Records::findOne($id);
        $record1 = new Deposits();
        $formData = Yii::$app->request->post();
        if($record->load($formData)){
            $postGetValue = Yii::$app->request->post('Records')['generic_name'];
            $restock = Yii::$app->request->post('Records')['re_stock'];

            $record = Records::findOne(['generic_name' => $postGetValue]);

            $record1->product_name = $record->generic_name;
            $record1->sku = $record->sku;
            $record1->brand = $record->brand;
            $record1->manufacturer = $record->manufacturer;
            $record1->category = $record->category;
            $record1->strength = $record->strength;
            date_default_timezone_set("Asia/Manila");
            $record1->created_date = date('M d, Y h:i:s A');
            $record1->depositedby_user = Yii::$app->user->identity->fullname . ' (' . Yii::$app->user->identity->username . ')';

            $deposit = Deposits::find()->orderBy(['depositno' => SORT_DESC])->one();

            if($deposit == null){
                $record1->depositno = 'DN.00001';
            } else {
                $id = $deposit->depositno;
                $record1->depositno = ++$id;
            }

            $stock = $record->quantity;
            $record->quantity = $stock + $restock;
            $record1->current_stock = $record->quantity;
            $record1->stock_deposited = $restock;
            $record->removeRestock();

            if($record->save() && $record1->save()) {
                Yii::$app->getSession()->setFlash('success','Added Stock Successfully');
                return $this->redirect(['product']);
            }
            else{
                Yii::$app->getSession()->setFlash('error','Failed to add stock.');
                return $this->redirect(['product']);
            }
        } else {
            return $this->renderAjax('addstock',['record' => $record]);
        }
    }

    public function actionDeposit() {
        $this->layout = 'loggedin';
        return $this->render('deposit');
    }
   
}
