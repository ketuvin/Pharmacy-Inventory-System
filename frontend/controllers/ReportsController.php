<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Reports;
use frontend\models\Withdrawalsreport;
use frontend\models\Records;
use frontend\models\Withdrawals;
use yii\data\Pagination;
use kartik\mpdf\Pdf;

class ReportsController extends Controller
{
	/**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['reports','statusreport','withdrawalsreport'],
                'rules' => [
                    [
                        'actions' => ['reports','statusreport','withdrawalsreport'],
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

    public function actionReports() {
        $this->layout = 'loggedin';
        $model = new Reports();
        $model1 = new Withdrawalsreport();

        $dataProvider = $model->search(Yii::$app->request->queryParams);
        $dataProvider1 = $model1->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 5;
        $dataProvider1->pagination->pageSize = 5;

        return $this->render('reports', [
           'dataProvider' => $dataProvider,
           'dataProvider1' => $dataProvider1
       ]);
    }

    public function actionStatusreport() {
        $model = new Reports();
        $records = new Records();
        $multiProducts = [];
        $formData = Yii::$app->request->post();

        if($model->load($formData)) {

            $postGetNames = Yii::$app->request->post('Reports')['generic_name'];

            if(sizeof($postGetNames) > 0) {
                for($counter = 0; $counter < sizeof($postGetNames); $counter++) {
                    $records = Records::findOne(['id' => $postGetNames[$counter]]);
                    $multiProducts[] = $records->generic_name;
                }
            }

            // print_r($multiProducts);
            // die();

            date_default_timezone_set("Asia/Manila");
            $model->created_date = date('M d, Y h:i:s A');
            $name = date('F d, Y h-i-s A');
            $filename = $name . ' (Product-Status)';

            $report = Reports::find()->orderBy(['report_no' => SORT_DESC])->one();

            $postGetValue = Yii::$app->request->post('Reports')['remarks'];

            $model->remarks = $postGetValue;
            $model->generic_name = $multiProducts;

            if($report == null){
                $model->report_no = 'RN.00001';
            } else {
                $id = $report->report_no;
                $model->report_no = ++$id;
            }
            $this->actionGenerateReport($multiProducts, $filename);
            // print_r($postGetNames);
            // die();
            $model->filename = $filename;
            if($model->save(false)) {
                Yii::$app->getSession()->setFlash('success','Report Created Successfully');
                return $this->redirect(['reports']);
            } else {
                Yii::$app->getSession()->setFlash('error','Failed to Create Report');
                return $this->redirect(['reports']);
            }
        } else {
            return $this->renderAjax('statusreport', [
               'model' => $model
           ]);
        }
    }

    public function actionGenerateReport(array $generic_name, $filename) {
        $models = [];
        if (sizeof($generic_name) > 0)
        {
            foreach ($generic_name as $key => $value) {
                # code...
                $model = Records::find()->where(['like', 'generic_name', $value])->all();
                array_push($models, $model);
            }
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;  
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_status-report-format', [
                     'model' => $models]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_FILE,
            'filename' => '/opt/lappstack/apache2/htdocs/Yii/advanced/frontend/web/StatusReport/'.$filename.'.pdf', 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // call mPDF methods on the fly
            'methods' => [
                'SetTitle' => 'Farmako Inventus Report',
                'SetHeader' => ['Farmako Inventus Report||Generated On: ' . date("r")], 
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);
        
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

    public function actionWithdrawalsreport() {
        $model = new Withdrawalsreport();
        $formData = Yii::$app->request->post();

        if($model->load($formData)) {

            $postGetStart = Yii::$app->request->post('Withdrawalsreport')['start_date'];
            $postGetEnd = Yii::$app->request->post('Withdrawalsreport')['end_date'];
            $postGetValue = Yii::$app->request->post('Withdrawalsreport')['remarks'];

            date_default_timezone_set("Asia/Manila");
            $model->created_date = date('M d, Y h:i:s A');
            $name = date('F d, Y h-i-s A');
            $filename = $name . ' (Withdrawal-Report)';

            $model->start_date = $postGetStart;
            $model->end_date = $postGetEnd;
            $model->remarks = $postGetValue;

            $withdrawalreport = Withdrawalsreport::find()->orderBy(['withdraw_reportno' => SORT_DESC])->one();

            if($withdrawalreport == null){
                $model->withdraw_reportno = 'RN.00001';
            } else {
                $id = $withdrawalreport->withdraw_reportno;
                $model->withdraw_reportno = ++$id;
            }
            $this->actionGenerateWithdrawalsReport($postGetStart, $postGetEnd, $filename);
            $model->filename = $filename;
            if($model->save(false)) {
                Yii::$app->getSession()->setFlash('success','Report Created Successfully');
                return $this->redirect(['reports']);
            } else {
                Yii::$app->getSession()->setFlash('error','Failed to Create Report');
                return $this->redirect(['reports']);
            }

        } else {
            return $this->renderAjax('withdrawalsreport', [
               'model' => $model
           ]);
        }
    }

    public function actionGenerateWithdrawalsReport($start_date, $end_date, $filename) {

        $data = Yii::$app->db->createCommand("select *
                 from withdrawals
                 where TO_DATE(created_date, 'Month DD, YYYY') >= TO_DATE(:start_date, 'Month DD, YYYY') and TO_DATE(created_date, 'Month DD, YYYY') <= TO_DATE(:end_date, 'Month DD, YYYY')")
        ->bindParam(':start_date', $start_date)
        ->bindParam(':end_date', $end_date)
        ->queryAll();

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;  
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_withdrawals-report-format', [
                     'model' => $data]);
        date_default_timezone_set('Asia/Manila');
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_FILE,
            'filename' => '/opt/lappstack/apache2/htdocs/Yii/advanced/frontend/web/WithdrawalReport/'.$filename.'.pdf',
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // call mPDF methods on the fly
            'methods' => [
                'SetTitle' => 'Farmako Inventus Report',
                'SetHeader' => ['Farmako Inventus Report||Generated On: ' . date("r")], 
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);
        
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

    public function actionDeletereport($report_no) {
        $report = Reports::findOne($report_no);
        unlink(Yii::getAlias('@pdfstatusreportpath').'/'.$report->filename.'.pdf');
        $report = Reports::findOne($report_no)->delete();
        if($report) {
            Yii::$app->getSession()->setFlash('success','Report Deleted Successfully');
            return $this->redirect(['reports']);
        }else {
            Yii::$app->getSession()->setFlash('error','Failed to Delete Report');
            return $this->redirect(['reports']);
        }
    }

    public function actionDeletewithdrawreport($withdraw_reportno) {
        $report = Withdrawalsreport::findOne($withdraw_reportno);
        unlink(Yii::getAlias('@pdfwithdrawalreportpath').'/'.$report->filename.'.pdf');
        $report = Withdrawalsreport::findOne($withdraw_reportno)->delete();
        if($report) {
            Yii::$app->getSession()->setFlash('success','Report Deleted Successfully');
            return $this->redirect(['reports']);
        }else {
            Yii::$app->getSession()->setFlash('error','Failed to Delete Report');
            return $this->redirect(['reports']);
        }
    }

    /**
     * View the pdf file.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionViewStatusReportPdf($id) {
        $model = Reports::findOne($id);

        $filePath = Yii::getAlias('@pdfstatusreportpath').'/'.$model->filename.'.pdf';
        
         if(file_exists($filePath)) {

            header("Content-type: application/pdf");
            $file = readFile($filePath);

            return $file;

         } else {
            Yii::$app->getSession()->setFlash('error','Unable to open file. Unexpected Error.');
            return $this->redirect(['reports']);
        }
    }

    /**
     * View the pdf file.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionViewWithdrawalReportPdf($id) {
        $model = Withdrawalsreport::findOne($id);

        $filePath = Yii::getAlias('@pdfwithdrawalreportpath').'/'.$model->filename.'.pdf';
        
         if(file_exists($filePath)) {

            header("Content-type: application/pdf");
            $file = readFile($filePath);

            return $file;

         } else {
            Yii::$app->getSession()->setFlash('error','Unable to open file. Unexpected Error.');
            return $this->redirect(['reports']);
        }
    }
}
?>