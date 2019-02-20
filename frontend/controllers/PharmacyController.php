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
        $model = new Records();
        $dataProvider = $model->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 5;

        return $this->render('home', [
           'dataProvider' => $dataProvider,
       ]);

    }

    public function actionViewwithdraw($Pull_outNo) {
        $model = Withdrawals::findOne($Pull_outNo);

        return $this->renderAjax('viewwithdraw', ['model' => $model]);
    }

    public function actionDashboard() {
        $this->layout = 'loggedin';
        return $this->render('dashboard');
    }

    public function actionAddproduct() {
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
                Yii::$app->getSession()->setFlash('error','Failed to add product.');
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
        $record = Records::findOne($ID);
        $record1 = Category::findOne(['Category' => $Category]);
        return $this->renderAjax('view', [
            'record' => $record,
            'record1' => $record1,
        ]);
    }

    public function actionUpdate($ID) {
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
        $record = Records::findOne($ID);
        if($record->load(Yii::$app->request->post())){
            $restock = Yii::$app->request->post('Records')['Re_stock'];
            $stock = $record->Quantity;
            $record->Quantity = $stock + $restock;
            $record->removeRestock();
            if ($record -> save()) {
                Yii::$app->getSession()->setFlash('success','Added Stock Successfully');
                return $this->redirect(['home']);
            }
            else{
                Yii::$app->getSession()->setFlash('error','Failed to add stock.');
            }
        }
        return $this->renderAjax('addstock',['record' => $record]);
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
                Yii::$app->getSession()->setFlash('error','Failed to add unit.');
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
        $model = new Withdrawals();
        $dataProvider = $model->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 5;

        return $this->render('withdrawals', [
           'dataProvider' => $dataProvider,
       ]);
    }

    public function actionWithdrawproduct() {
        $record = new Records();
        $record1 = new Withdrawals();
        $formData = Yii::$app->request->post();
        if($record->load($formData) && $record1->load($formData)){
            $postGetValue = Yii::$app->request->post('Records')['Name'];
            $restock = Yii::$app->request->post('Records')['Re_stock'];

            $record = Records::findOne(['ID' => $postGetValue]);

            $record1->Product_name = $record->Name;
            date_default_timezone_set("Asia/Manila");
            $record1->Created_Date = date('M d, Y h:i:s A');
            $record1->withdrawby_user = Yii::$app->user->identity->fullname . ' (' . Yii::$app->user->identity->username . ')';

            $withdraw = Withdrawals::find()->orderBy(['Pull_outNo' => SORT_DESC])->one();

            if($withdraw == null){
                $record1->Pull_outNo = 'PN.00001';
            } else {
                // for ($n=0; $n<1; $n++) {
                    $ID = $withdraw->Pull_outNo;
                    $record1->Pull_outNo = ++$ID;
                // }
            }

            if($record->Quantity >= $restock) {
                $stock = $record->Quantity;
                $record->Quantity = $stock - $restock;
                $record1->stock_withdrawn = $restock;
                $record->removeRestock();

                if($record->save() && $record1->save()){
                    Yii::$app->getSession()->setFlash('success','Withdraw Stock Successfully');
                    return $this->redirect(['withdrawals']);
                }
                else{
                    Yii::$app->getSession()->setFlash('error','Failed to withdraw stock.');
                    return $this->redirect(['withdrawals']);
                }
            } else {
                Yii::$app->getSession()->setFlash('error','Cannot withdraw stock. Withdraw exceeded the available stock.');
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
