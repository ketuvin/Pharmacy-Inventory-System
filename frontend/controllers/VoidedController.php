<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Voided;
use frontend\models\Records;
use yii\data\Pagination;
use yii\helpers\Json;

class VoidedController extends Controller
{
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['void','viewvoid','voidproduct'],
                'rules' => [
                    [
                        'actions' => ['void','viewvoid','voidproduct'],
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

    public function actionVoid() {

    	$this->layout = 'loggedin';
        $model = new Voided();
        $dataProvider = $model->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 5;

        return $this->render('void', [
           'dataProvider' => $dataProvider,
       ]);
    }

    public function actionViewvoid($voidno) {
        $model = Voided::findOne($voidno);

        return $this->renderAjax('viewvoid', ['model' => $model]);
    }

    public function actionGetProductDetails($id)
    {
       $record = Records::findOne(['id' => $id]);
       return Json::encode($record);
    }

    public function actionVoidproduct() {
        $record = new Records();
        $record1 = new Voided();
        $formData = Yii::$app->request->post();
        if($record->load($formData) && $record1->load($formData)){

            $postGetValue = Yii::$app->request->post('Records')['category'];
            $postGetValue1 = Yii::$app->request->post('Records')['unit'];
            $postGetValue2 = Yii::$app->request->post('Records')['unit_price'];
            $postGetValue3 = Yii::$app->request->post('Records')['manufacturer'];
            $postGetValue4 = Yii::$app->request->post('Records')['generic_name'];
            $postGetValue5 = Yii::$app->request->post('Records')['quantity'];
            $postGetValue6 = Yii::$app->request->post('Records')['strength'];
            $postGetValue7 = Yii::$app->request->post('Records')['brand'];

            $record = Records::findOne(['id' => $postGetValue4]);
            
            $record1->product_name = $record->generic_name;
            $record1->category = $postGetValue;
            $record1->unit = $postGetValue1;
            $record1->unit_price = $postGetValue2;
            $record1->manufacturer = $postGetValue3;
            $record1->stock = $postGetValue5;
            $record1->strength = $postGetValue6;
            $record1->brand = $postGetValue7;
            date_default_timezone_set("Asia/Manila");
            $record1->created_date = date('M d, Y h:i:s A');

            $void = Voided::find()->orderBy(['voidno' => SORT_DESC])->one();

            if($void == null){
                $record1->voidno = 'VN.00001';
            } else {
                $id = $void->voidno;
                $record1->voidno = ++$id;
            }
            
            if($record1->save(false) && $record->delete()){
                Yii::$app->getSession()->setFlash('message','Product has been voided Successfully');
                return $this->redirect(['void']);
            }
            else{
                Yii::$app->getSession()->setFlash('error','Failed to void product.');
                return $this->redirect(['void']);
            }
        }
        return $this->renderAjax('voidproduct', [
            'record' => $record,
            'record1' => $record1,
        ]);
    }
}
?>