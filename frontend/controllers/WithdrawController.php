<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Records;
use common\models\Withdrawals;
use yii\data\Pagination;
use yii\helpers\Json;
/**
 * Pharmacy controller
 */
class WithdrawController extends Controller
{
	/**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['withdraw','viewwithdraw','withdrawproduct'],
                'rules' => [
                    [
                        'actions' => ['withdraw','viewwithdraw','withdrawproduct'],
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

    public function actionViewwithdraw($pull_outno) {
        $model = Withdrawals::findOne($pull_outno);

        return $this->renderAjax('viewwithdraw', ['model' => $model]);
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
            $postGetValue = Yii::$app->request->post('Records')['generic_name'];
            $restock = Yii::$app->request->post('Records')['re_stock'];

            $record = Records::findOne(['id' => $postGetValue]);

            $record1->product_name = $record->generic_name;
            $record1->sku = $record->sku;
            $record1->brand = $record->brand;
            $record1->manufacturer = $record->manufacturer;
            $record1->strength = $record->strength;
            $record1->category = $record->category;
            date_default_timezone_set("Asia/Manila");
            $record1->created_date = date('F d, Y h:i:s A');
            $record1->withdrawby_user = Yii::$app->user->identity->fullname . ' (' . Yii::$app->user->identity->username . ')';

            $withdraw = Withdrawals::find()->orderBy(['pull_outno' => SORT_DESC])->one();

            if($withdraw == null){
                $record1->pull_outno = 'PN.00001';
            } else {
                $id = $withdraw->pull_outno;
                $record1->pull_outno = ++$id;
            }

            if($record->quantity >= $restock) {
                $stock = $record->quantity;
                $record->quantity = $stock - $restock;
                $record1->current_stock = $record->quantity;
                $record1->stock_withdrawn = $restock;
                $record->removeRestock();

                if($record->quantity < 10) {
                    $record->sendEmail(Yii::$app->user->identity->email,$record);
                }

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
}

?>