<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\Log;
use yii\web\UploadedFile;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index'],
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
     * @inheritdoc
     */
    public function actions() {
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
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionCanvassedapproval() {
        return;
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // log action
            $log = new Log();
            $description = "user login: " . Yii::$app->user->identity->username;
            $log->logMe(Log::LOGIN, $description);
            return $this->goBack();
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {

        // log action
        $log = new Log();
        $description = "user logout: " . Yii::$app->user->identity->username;
        $log->logMe(Log::LOGOUT, $description);

        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * 
     * @return type
     */
    public function actionUploadexcel() {
        $model = new \app\models\Exceltest();

        if (Yii::$app->request->isPost) {
            $model->excelfile = UploadedFile::getInstance($model, 'excelfile');
            if ($model->upload()) {
                // file is uploaded successfully
                $inputFile = 'fileupload/LOANSCHEME.xlsx';
                try {
                    $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
                    $objectReader = \PHPExcel_IOFactory::createReader($inputFileType);
                    $objectPhpFile = $objectReader->load($inputFile);
                } catch (Exception $ex) {
                    die('Error');
                }

                $sheet = $objectPhpFile->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                $maxCell = $sheet->getHighestRowAndColumn();
                //$data = $sheet->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row']);

                for ($row = 1; $row <= $highestRow; $row++) {
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $maxCell['column'] . $maxCell['row']);

                    if ($row == 1) {
                        continue;
                    }

                    $test = New \app\models\Exceltest();

                    $test->daily = $rowData[0][0];
                    $test->term = $rowData[0][1];
                    $test->gross_amt = $rowData[0][2];
                    $test->interest = $rowData[0][3];
                    $test->vat = $rowData[0][4];
                    $test->notarial = $rowData[0][5];
                    $test->processing_fee = $rowData[0][6];
                    $test->total_deductions = $rowData[0][7];
                    $test->add_days = $rowData[0][8];
                    $test->add_coll = $rowData[0][9];
                    $test->net_proceeds = $rowData[0][10];
                    $test->penalty = $rowData[0][11];
                    $test->pen_days = $rowData[0][12];

                    if (!($test->save())) { // use to skip empty rows
                        continue;
                    }

                    print_r($test->getErrors());
                }

                return;
            }
        }
        return $this->render('uploadexcel', [
                    'model' => $model
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

}
