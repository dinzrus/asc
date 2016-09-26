<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\Borrower;
use app\models\Log;
use yii\web\UploadedFile;
use yii\data\Pagination;

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
        $model = new \app\models\LoanschemeValues();

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

                    $test = New \app\models\LoanschemeValues();

                    $test->loanscheme_id = 8;
                    $test->daily = $rowData[0][0];
                    $test->term = $rowData[0][1];
                    $test->gross_amt = $rowData[0][2];
                    $test->interest = $rowData[0][3];
                    $test->vat = $rowData[0][4];
                    $test->admin_fee = $rowData[0][5];
                    $test->notary_fee = $rowData[0][6];
                    $test->misc = $rowData[0][7];
                    $test->doc_stamp = $rowData[0][8];
                    $test->gas = $rowData[0][9];
                    $test->total_deductions = $rowData[0][10];
                    $test->add_days = $rowData[0][11];
                    $test->add_coll = $rowData[0][12];
                    $test->net_proceeds = $rowData[0][13];
                    $test->penalty = $rowData[0][14];
                    $test->pen_days = $rowData[0][15];

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

    public function actionCicanvassapproval() {
        $list = (strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN') ? Yii::$app->db->createCommand(
                        "SELECT\n" .
                        "borrower.id,\n" .
                        "borrower.profile_pic,\n" .
                        "borrower.first_name,\n" .
                        "borrower.last_name,\n" .
                        "borrower.middle_name,\n" .
                        "borrower.suffix,\n" .
                        "borrower.contact_no,\n" .
                        "borrower.canvass_date,\n" .
                        "borrower.`status`,\n" .
                        "borrower.branch_id,\n" .
                        "borrower.canvass_by,\n" .
                        "branch.branch_description,\n" .
                        "canvasser.fname,\n" .
                        "canvasser.lname,\n" .
                        "canvasser.middlename\n" .
                        "FROM\n" .
                        "borrower\n" .
                        "INNER JOIN branch ON borrower.branch_id = branch.branch_id\n" .
                        "INNER JOIN canvasser ON borrower.canvass_by = canvasser.id\n" .
                        "WHERE borrower.status = 'C'"
                )->queryAll() :
                Yii::$app->db->createCommand(
                        "SELECT\n" .
                        "borrower.id,\n" .
                        "borrower.profile_pic,\n" .
                        "borrower.first_name,\n" .
                        "borrower.last_name,\n" .
                        "borrower.middle_name,\n" .
                        "borrower.suffix,\n" .
                        "borrower.contact_no,\n" .
                        "borrower.canvass_date,\n" .
                        "borrower.`status`,\n" .
                        "borrower.branch_id,\n" .
                        "borrower.canvass_by,\n" .
                        "branch.branch_description,\n" .
                        "canvasser.fname,\n" .
                        "canvasser.lname,\n" .
                        "canvasser.middlename\n" .
                        "FROM\n" .
                        "borrower\n" .
                        "INNER JOIN branch ON borrower.branch_id = branch.branch_id\n" .
                        "INNER JOIN canvasser ON borrower.canvass_by = canvasser.id\n" .
                        "WHERE borrower.status = 'C' AND borrower.branch_id = " . Yii::$app->user->identity->branch_id
                )->queryAll();
        return $this->render('cicanvassapproval', [
                    'list' => $list,
        ]);
    }

    public function actionSfr() {
        $query = (strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN') ?
                \app\models\Borrower::find():
                 \app\models\Borrower::find()
                ->where(['borrower.branch_id' => Yii::$app->user->identity->branch_id]);

        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);

        $clnts = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        return $this->render('scheduleforreleasing', [
                    'list' => $clnts,
                    'pagination' => $pagination,
        ]);
    }

    public function actionHoldforsfr() {
        $list = (strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN') ? Yii::$app->db->createCommand(
                        "SELECT\n" .
                        "borrower.id,\n" .
                        "borrower.profile_pic,\n" .
                        "borrower.first_name,\n" .
                        "borrower.last_name,\n" .
                        "borrower.middle_name,\n" .
                        "borrower.suffix,\n" .
                        "borrower.contact_no,\n" .
                        "borrower.canvass_date,\n" .
                        "borrower.`status`,\n" .
                        "borrower.branch_id,\n" .
                        "borrower.canvass_by,\n" .
                        "branch.branch_description,\n" .
                        "canvasser.fname,\n" .
                        "canvasser.lname,\n" .
                        "canvasser.middlename\n" .
                        "FROM\n" .
                        "borrower\n" .
                        "INNER JOIN branch ON borrower.branch_id = branch.branch_id\n" .
                        "INNER JOIN canvasser ON borrower.canvass_by = canvasser.id\n" .
                        "WHERE borrower.status = 'CD'"
                )->queryAll() :
                Yii::$app->db->createCommand(
                        "SELECT\n" .
                        "borrower.id,\n" .
                        "borrower.profile_pic,\n" .
                        "borrower.first_name,\n" .
                        "borrower.last_name,\n" .
                        "borrower.middle_name,\n" .
                        "borrower.suffix,\n" .
                        "borrower.contact_no,\n" .
                        "borrower.canvass_date,\n" .
                        "borrower.`status`,\n" .
                        "borrower.branch_id,\n" .
                        "borrower.canvass_by,\n" .
                        "branch.branch_description,\n" .
                        "canvasser.fname,\n" .
                        "canvasser.lname,\n" .
                        "canvasser.middlename\n" .
                        "FROM\n" .
                        "borrower\n" .
                        "INNER JOIN branch ON borrower.branch_id = branch.branch_id\n" .
                        "INNER JOIN canvasser ON borrower.canvass_by = canvasser.id\n" .
                        "WHERE borrower.status = 'CD' AND borrower.branch_id = " . Yii::$app->user->identity->branch_id
                )->queryAll();
        return $this->render('sfrholdlist', [
                    'list' => $list,
        ]);
    }
    
    /**
     * 
     * @return type
     */
    public function actionSchedulerelease($id){
        $borrower = Borrower::findOne(['id' => $id]);
        $business = \app\models\base\Business::findOne(['borrower_id' => $id]);
        return $this->render('schedulerelease',[
                'borrower' => $borrower,
                'business' => $business,
        ]);
    }

    /**
     * Displays about page.
     *
     * 
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

}
