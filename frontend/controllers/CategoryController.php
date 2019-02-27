<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Category;
use yii\data\Pagination;

class CategoryController extends Controller
{
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['category','editcategory'],
                'rules' => [
                    [
                        'actions' => ['category','editcategory'],
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

    public function actionEditcategory($category) {
        $category = Category::findOne(['category' => $category]);
        $formData = Yii::$app->request->post();
        if(($category->load($formData) && $category->save())) {
            Yii::$app->getSession()->setFlash('message','Category Updated Successfully');
            return $this->redirect(['category']);
        }
         else{
            return $this->renderAjax('editcategory', [
                'category' => $category,
            ]);
        }
    }

    public function actionCategory() {
        $this->layout = 'loggedin';
        $model = new Category();
        $dataProvider = $model->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 5;

        return $this->render('category', [
           'dataProvider' => $dataProvider,
       ]);
    }
}
?>