<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Loan;
use app\models\Unit;
use app\models\Money;
use app\models\BorrowerSfrSearch;
use app\models\Borrower;
use app\models\Log;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\data\SqlDataProvider;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

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

    /**
     * Encoding of collection 
     * @return type
     */
    public function actionBorrowerscollection() {

        if (strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN') {
            $unitquery = Unit::find();
        } else {
            $unitquery = Unit::find()->where(['branch_id' => Yii::$app->user->identity->branch->branch_id]);
        }

        $unitProvider = new ActiveDataProvider([
            'query' => $unitquery,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'unit_description' => SORT_ASC,
                ]
            ],
        ]);

        return $this->render('borrowerscollection', [
                    'unitProvider' => $unitProvider,
        ]);
    }

    /**
     * 
     * @param int $id unit_id
     */
    public function actionEncodecollection($id) {
        // ACTIVE 
        $loan_count_active = Yii::$app->db->createCommand("SELECT\n" .
                        "COUNT(*)\n" .
                        "FROM\n" .
                        "borrower\n" .
                        "INNER JOIN loan ON loan.borrower = borrower.id\n" .
                        "LEFT JOIN payment ON payment.loan_id = loan.id")->queryScalar();

        $loan_provider_active = new SqlDataProvider([
            'sql' => "SELECT\n" .
            "CONCAT(borrower.last_name,', ',borrower.first_name,' ',borrower.middle_name,' ', borrower.suffix) as name,\n" .
            "loan.id AS loan_id,\n" .
            "loan.loan_no,\n" .
            "loan.daily,\n" .
            "loan.release_date,\n" .
            "payment.id AS pay_id,\n" .
            "payment.pay_amount\n" .
            "FROM\n" .
            "borrower\n" .
            "INNER JOIN loan ON loan.borrower = borrower.id\n" .
            "LEFT JOIN payment ON payment.loan_id = loan.id",
            'totalCount' => $loan_count_active,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);


        $unit = Unit::findOne(['unit_id' => $id]);
        $money = new Money();
        $money->unit_id = $unit->unit_id;
        $money->collection_date = date('m/d/Y');

        return $this->render('unitcollection', [
                    'money' => $money,
                    'unit' => $unit,
                    'loan_provider_active' => $loan_provider_active,
        ]);
    }

    public function actionCanvassedapproval() {
        
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
        $new_sql = (strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN') ?
                "SELECT\n" .
                "borrower.id,\n" .
                "borrower.first_name,\n" .
                "borrower.last_name,\n" .
                "borrower.middle_name,\n" .
                "borrower.suffix,\n" .
                "borrower.contact_no,\n" .
                "borrower.canvass_date,\n" .
                "borrower.`status`,\n" .
                "borrower.branch_id,\n" .
                "branch.branch_description,\n" .
                "CONCAT(employee.last_name, ',  ', employee.first_name, ' ', employee.middle_name) AS canvasser_fullname\n" .
                "FROM\n" .
                "borrower\n" .
                "INNER JOIN branch ON borrower.branch_id = branch.branch_id\n" .
                "INNER JOIN employee ON borrower.canvass_by = employee.id\n" .
                "WHERE\n" .
                "borrower.`status` = 'C'" :
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
                "branch.branch_description,\n" .
                "CONCAT(employee.last_name, ',  ', employee.first_name, ' ', employee.middle_name) AS canvasser_fullname\n" .
                "FROM\n" .
                "borrower\n" .
                "INNER JOIN branch ON borrower.branch_id = branch.branch_id\n" .
                "INNER JOIN employee ON borrower.canvass_by = employee.id\n" .
                "WHERE\n" .
                "borrower.`status` = 'C' AND borrower.branch_id = :branch_id";

        $renewal_sql = (strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN') ?
                "SELECT\n" .
                "borrower.id,\n" .
                "borrower.first_name,\n" .
                "borrower.last_name,\n" .
                "borrower.middle_name,\n" .
                "borrower.suffix,\n" .
                "borrower.contact_no,\n" .
                "borrower.canvass_date,\n" .
                "borrower.`status`,\n" .
                "borrower.branch_id,\n" .
                "branch.branch_description,\n" .
                "CONCAT(employee.last_name, ',  ', employee.first_name, ' ', employee.middle_name) AS canvasser_fullname\n" .
                "FROM\n" .
                "borrower\n" .
                "INNER JOIN branch ON borrower.branch_id = branch.branch_id\n" .
                "INNER JOIN employee ON borrower.canvass_by = employee.id\n" .
                "WHERE\n" .
                "borrower.`status` = 'RN'" :
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
                "branch.branch_description,\n" .
                "CONCAT(employee.last_name, ',  ', employee.first_name, ' ', employee.middle_name) AS canvasser_fullname\n" .
                "FROM\n" .
                "borrower\n" .
                "INNER JOIN branch ON borrower.branch_id = branch.branch_id\n" .
                "INNER JOIN employee ON borrower.canvass_by = employee.id\n" .
                "WHERE\n" .
                "borrower.`status` = 'RN' AND borrower.branch_id = :branch_id";


        $new_count = Yii::$app->db->createCommand((strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN') ? 'SELECT COUNT(*) FROM borrower WHERE status = "C"' : 'SELECT COUNT(*) FROM borrower WHERE status = "C" AND branch_id = :branch_id')->bindValue(':branch_id', Yii::$app->user->identity->branch_id)->queryScalar();
        $renewal_count = Yii::$app->db->createCommand((strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN') ? 'SELECT COUNT(*) FROM borrower WHERE status = "C"' : 'SELECT COUNT(*) FROM borrower WHERE status = "C" AND branch_id = :branch_id')->bindValue(':branch_id', Yii::$app->user->identity->branch_id)->queryScalar();

        $newborrowerProvider = new SqlDataProvider([
            'sql' => $new_sql,
            'params' => [
                ':branch_id' => Yii::$app->user->identity->branch_id
            ],
            'totalCount' => $new_count,
            'key' => 'id',
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        $renewalborrowerProvider = new SqlDataProvider([
            'sql' => $renewal_sql,
            'params' => [
                ':branch_id' => Yii::$app->user->identity->branch_id
            ],
            'totalCount' => $renewal_count,
            'key' => 'id',
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('cicanvassapproval', [
                    'newborrowerProvider' => $newborrowerProvider,
                    'renewalborrowerProvider' => $renewalborrowerProvider,
        ]);
    }

    public function actionCanvass() {
        $borrower = new Borrower();
        //get canvasser
        if (Yii::$app->user->identity->branch->branch_description === 'MAIN') {
            $canvassers = Yii::$app->db->createCommand("SELECT\n" .
                            "employee.id,\n" .
                            "CONCAT(employee.last_name,', ',employee.first_name,' ',employee.middle_name) as fullname,\n" .
                            "position.position\n" .
                            "FROM\n" .
                            "employee\n" .
                            "INNER JOIN emposition ON emposition.employee_id = employee.id\n" .
                            "INNER JOIN position ON emposition.position_id = position.id\n" .
                            "WHERE\n" .
                            "emposition.branch_id = :branch_id AND\n" .
                            "position.position = 'canvasser'")->bindValue(':branch_id', Yii::$app->user->identity->branch_id)->queryAll();
        } else {
            $canvassers = Yii::$app->db->createCommand("SELECT\n" .
                            "employee.id,\n" .
                            "CONCAT(employee.last_name,', ',employee.first_name,' ',employee.middle_name) as fullname,\n" .
                            "position.position\n" .
                            "FROM\n" .
                            "employee\n" .
                            "INNER JOIN emposition ON emposition.employee_id = employee.id\n" .
                            "INNER JOIN position ON emposition.position_id = position.id\n" .
                            "WHERE\n" .
                            "position.position = 'canvasser'")->queryAll();
        }
        return $this->render('canvass', ['borrower' => $borrower, 'canvassers' => $canvassers]);
    }

    public function actionSaveborrower() {
        $borrower = new Borrower();
        if (Yii::$app->user->identity->branch->branch_description === 'MAIN') {
            $canvassers = Yii::$app->db->createCommand("SELECT\n" .
                            "employee.id,\n" .
                            "CONCAT(employee.last_name,', ',employee.first_name,' ',employee.middle_name) as fullname,\n" .
                            "position.position\n" .
                            "FROM\n" .
                            "employee\n" .
                            "INNER JOIN emposition ON emposition.employee_id = employee.id\n" .
                            "INNER JOIN position ON emposition.position_id = position.id\n" .
                            "WHERE\n" .
                            "emposition.branch_id = :branch_id AND\n" .
                            "position.position = 'canvasser'")->bindValue(':branch_id', Yii::$app->user->identity->branch_id)->queryAll();
        } else {
            $canvassers = Yii::$app->db->createCommand("SELECT\n" .
                            "employee.id,\n" .
                            "CONCAT(employee.last_name,', ',employee.first_name,' ',employee.middle_name) as fullname,\n" .
                            "position.position\n" .
                            "FROM\n" .
                            "employee\n" .
                            "INNER JOIN emposition ON emposition.employee_id = employee.id\n" .
                            "INNER JOIN position ON emposition.position_id = position.id\n" .
                            "WHERE\n" .
                            "position.position = 'canvasser'")->queryAll();
        }
        if ($borrower->loadAll(Yii::$app->request->post())) {
            $borrower->status = 'C';
            $borrower->branch_id = Yii::$app->user->identity->branch_id;
            if ($borrower->save()) {
                Yii::$app->session->setFlash('borrower_save', "Added Successfully!");
                return $this->redirect(['newapplicants']);
            } else {
                return $this->render('canvass', ['borrower' => $borrower, 'canvassers' => $canvassers]);
            }
        }
    }

    public function actionNewapplicants() {

        $new_sql = (strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN') ?
                "SELECT\n" .
                "borrower.id,\n" .
                "borrower.first_name,\n" .
                "borrower.last_name,\n" .
                "borrower.middle_name,\n" .
                "borrower.suffix,\n" .
                "borrower.contact_no,\n" .
                "borrower.canvass_date,\n" .
                "borrower.`status`,\n" .
                "borrower.branch_id,\n" .
                "branch.branch_description,\n" .
                "CONCAT(employee.last_name, ',  ', employee.first_name, ' ', employee.middle_name) AS canvasser\n" .
                "FROM\n" .
                "borrower\n" .
                "INNER JOIN branch ON borrower.branch_id = branch.branch_id\n" .
                "INNER JOIN employee ON borrower.canvass_by = employee.id\n" .
                "WHERE\n" .
                "borrower.`status` = 'C'" :
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
                "branch.branch_description,\n" .
                "CONCAT(employee.last_name, ',  ', employee.first_name, ' ', employee.middle_name) AS canvasser\n" .
                "FROM\n" .
                "borrower\n" .
                "INNER JOIN branch ON borrower.branch_id = branch.branch_id\n" .
                "INNER JOIN employee ON borrower.canvass_by = employee.id\n" .
                "WHERE\n" .
                "borrower.`status` = 'C' AND borrower.branch_id = :branch_id";

        $renewal_sql = (strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN') ?
                "SELECT\n" .
                "borrower.id,\n" .
                "borrower.first_name,\n" .
                "borrower.last_name,\n" .
                "borrower.middle_name,\n" .
                "borrower.suffix,\n" .
                "borrower.contact_no,\n" .
                "borrower.canvass_date,\n" .
                "borrower.`status`,\n" .
                "borrower.branch_id,\n" .
                "branch.branch_description,\n" .
                "CONCAT(employee.last_name, ',  ', employee.first_name, ' ', employee.middle_name) AS canvasser\n" .
                "FROM\n" .
                "borrower\n" .
                "INNER JOIN branch ON borrower.branch_id = branch.branch_id\n" .
                "INNER JOIN employee ON borrower.canvass_by = employee.id\n" .
                "WHERE\n" .
                "borrower.`status` = 'RN'" :
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
                "branch.branch_description,\n" .
                "CONCAT(employee.last_name, ',  ', employee.first_name, ' ', employee.middle_name) AS canvasser\n" .
                "FROM\n" .
                "borrower\n" .
                "INNER JOIN branch ON borrower.branch_id = branch.branch_id\n" .
                "INNER JOIN employee ON borrower.canvass_by = employee.id\n" .
                "WHERE\n" .
                "borrower.`status` = 'RN' AND borrower.branch_id = :branch_id";



        $new_count = Yii::$app->db->createCommand((strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN') ? 'SELECT COUNT(*) FROM borrower WHERE status = "C"' : 'SELECT COUNT(*) FROM borrower WHERE status = "C" AND branch_id = :branch_id')->bindValue(':branch_id', Yii::$app->user->identity->branch_id)->queryScalar();
        $renewal_count = Yii::$app->db->createCommand((strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN') ? 'SELECT COUNT(*) FROM borrower WHERE status = "RN"' : 'SELECT COUNT(*) FROM borrower WHERE status = "RN" AND branch_id = :branch_id')->bindValue(':branch_id', Yii::$app->user->identity->branch_id)->queryScalar();

        $newborrowers = new SqlDataProvider([
            'sql' => $new_sql,
            'params' => [
                ':branch_id' => Yii::$app->user->identity->branch_id
            ],
            'totalCount' => $new_count,
            'key' => 'id',
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $renewalborrowers = new SqlDataProvider([
            'sql' => $renewal_sql,
            'params' => [
                ':branch_id' => Yii::$app->user->identity->branch_id
            ],
            'totalCount' => $renewal_count,
            'key' => 'id',
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if (strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN') {
            $borrowers = Yii::$app->db->createCommand("SELECT\n" .
                            "borrower.id,\n" .
                            "CONCAT(borrower.last_name, ', ',borrower.first_name, ' ', borrower.middle_name) as fullname,\n" .
                            "borrower.canvass_date,\n" .
                            "CONCAT(employee.last_name,', ',employee.first_name) AS canvasser\n" .
                            "FROM\n" .
                            "borrower\n" .
                            "INNER JOIN emposition ON emposition.employee_id = borrower.canvass_by\n" .
                            "LEFT JOIN employee ON emposition.employee_id = employee.id\n" .
                            "WHERE borrower.status = 'AR' GROUP BY borrower.id")->queryAll();
        } else {
            $borrowers = Yii::$app->db->createCommand("SELECT\n" .
                            "borrower.id,\n" .
                            "CONCAT(borrower.last_name, ', ',borrower.first_name, ' ', borrower.middle_name) as fullname,\n" .
                            "borrower.canvass_date,\n" .
                            "CONCAT(employee.last_name,', ',employee.first_name) AS canvasser\n" .
                            "FROM\n" .
                            "borrower\n" .
                            "INNER JOIN emposition ON emposition.employee_id = borrower.canvass_by\n" .
                            "LEFT JOIN employee ON emposition.employee_id = employee.id\n" .
                            "WHERE borrower.status = 'AR' AND borrower.branch_id = :branch_id GROUP BY borrower.id")->bindValue(':branch_id', Yii::$app->user->identity->branch_id)->queryAll();
        }

        return $this->render('loanapplicants', [
                    'newborrowers' => $newborrowers,
                    'renewalborrowers' => $renewalborrowers,
                    'borrowers' => $borrowers
        ]);
    }

    public function actionSfr() {
        $borrowersearch = new BorrowerSfrSearch();
        $borrower = $borrowersearch->search(Yii::$app->request->queryParams);

        return $this->render('scheduleforreleasing', [
                    'borrowers' => $borrower->getModels(),
                    'borrowersearch' => $borrowersearch,
                    'loantype' => \app\models\LoanType::find()->all(),
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
                        "branch.branch_description,\n" .
                        "employee.first_name AS canvasser_fname,\n" .
                        "employee.last_name AS canvasser_lname,\n" .
                        "employee.middle_name AS canvasser_middlename\n" .
                        "FROM\n" .
                        "borrower\n" .
                        "INNER JOIN branch ON borrower.branch_id = branch.branch_id\n" .
                        "INNER JOIN employee ON borrower.canvass_by = employee.id\n" .
                        "WHERE\n" .
                        "borrower.`status` = 'CD'"
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
                        "branch.branch_description,\n" .
                        "employee.first_name AS canvasser_fname,\n" .
                        "employee.last_name AS canvasser_lname,\n" .
                        "employee.middle_name AS canvasser_middlename\n" .
                        "FROM\n" .
                        "borrower\n" .
                        "INNER JOIN branch ON borrower.branch_id = branch.branch_id\n" .
                        "INNER JOIN employee ON borrower.canvass_by = employee.id\n" .
                        "WHERE\n" .
                        "borrower.`status` = 'CD' AND borrower.branch_id = :branch_id"
                )->bindValue(':branch_id', Yii::$app->user->identity->branch_id)->queryAll();
        return $this->render('sfrholdlist', [
                    'list' => $list,
        ]);
    }

    /**
     * 
     * @return type
     */
    public function actionSchedulerelease($id, $loantype, $daily, $unit) {

        if (Yii::$app->user->can('ORGANIZER')) {

            $borrower = Borrower::findOne(['id' => $id]);
            $business = \app\models\base\Business::findOne(['borrower_id' => $id]);
            $unt = \app\models\Unit::findOne(['unit_id' => $unit]);
            $ltype = \app\models\LoanType::findOne(['loan_id' => $loantype]);
            $loanscheme = \app\models\LoanschemeValues::findOne(['id' => $daily]);

            // get the ci officer
            $ci = Yii::$app->db->createCommand("SELECT\n" .
                            "employee.id,\n" .
                            "CONCAT(employee.last_name,', ',employee.first_name,' ',employee.middle_name) as fullname,\n" .
                            "position.position\n" .
                            "FROM\n" .
                            "employee\n" .
                            "INNER JOIN emposition ON emposition.employee_id = employee.id\n" .
                            "INNER JOIN position ON emposition.position_id = position.id\n" .
                            "WHERE\n" .
                            "position.position = 'credit investigator' AND\n" .
                            "emposition.branch_id =:branch_id")->bindValue(':branch_id', $borrower->branch_id)->queryAll();

            $loan = new \app\models\Loan();
            $comaker = new \app\models\Comaker();

            if ($comaker->load(Yii::$app->request->post()) && $loan->load(Yii::$app->request->post())) {

                $loan->daily = $loanscheme->daily;
                $loan->term = $loanscheme->term;
                $loan->gross_amount = $loanscheme->gross_amt;
                $loan->total_deductions = $loanscheme->total_deductions;
                $loan->net_proceeds = $loanscheme->net_proceeds;
                $loan->doc_stamp = $loanscheme->doc_stamp;
                $loan->gas = $loanscheme->gas;
                $loan->admin_fee = $loanscheme->admin_fee;
                $loan->notarial_fee = $loanscheme->notary_fee;
                $loan->additional_fee = 0; //temp only
                $loan->misc = $loanscheme->misc;
                $loan->add_coll = $loanscheme->add_coll;
                $loan->interest_bdays = $loanscheme->interest;
                $loan->add_days = $loanscheme->add_days;
                $loan->loan_type = $ltype->loan_id;
                $loan->borrower = $borrower->id;
                $loan->unit = $unt->unit_id;
                $loan->penalty = $loanscheme->penalty;
                $loan->penalty_days = $loanscheme->pen_days;

                // calculate age 
                $comaker->age = \app\models\Comaker::calculateAge($comaker->birthdate);
                // set release and maturity date 
                $loan->release_date = date('Y-m-d'); // get the date of the day
                $loan->maturity_date = \app\models\Loan::getMaturityDate($loan->release_date, $loan->term);

                // generate account no.
                $loan->loan_no = Loan::generateLoanNumber($borrower->id, $loan);
                $loan->status = $loan::NEEDAPPROVAL;

                if ($comaker->validate() && $loan->validate()) {
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        $comaker->save();
                        $loan->save();
                        $loan_comaker = new \app\models\Loancomaker();
                        $loan_comaker->loan_id = $loan->id;
                        $loan_comaker->comaker_id = $comaker->id;
                        $loan_comaker->save();
                        $transaction->commit();
                    } catch (Exception $ex) {
                        $transaction->rollBack();
                        throw $ex;
                    }
                    $session = Yii::$app->session;
                    $message = $borrower->fullname . ' has been scheduled!';
                    $session->setFlash('loanReleased', $message);

                    return $this->redirect(['site/sfr']);
                } else {
                    return $this->render('schedulerelease', [
                                'borrower' => $borrower,
                                'business' => $business,
                                'unt' => $unt,
                                'ltype' => $ltype,
                                'loanscheme' => $loanscheme,
                                'comaker' => $comaker,
                                'loan' => $loan,
                                'ci' => $ci,
                    ]);
                }
            } else {
                return $this->render('schedulerelease', [
                            'borrower' => $borrower,
                            'business' => $business,
                            'unt' => $unt,
                            'ltype' => $ltype,
                            'loanscheme' => $loanscheme,
                            'comaker' => $comaker,
                            'loan' => $loan,
                            'ci' => $ci,
                ]);
            }
        } else {
            throw new \yii\web\UnauthorizedHttpException();
        }
    }

    public function actionReleasingapproval($id = null) {

        if (Yii::$app->user->can('IT')) {
            // sqldataprovider for new
            // if user is admin
            $newcount = Yii::$app->db->createCommand("SELECT\n" .
                            "COUNT(*)\n" .
                            "FROM\n" .
                            "borrower\n" .
                            "INNER JOIN loan ON loan.borrower = borrower.id\n" .
                            "INNER JOIN unit ON loan.unit = unit.unit_id\n" .
                            "INNER JOIN loan_type ON loan.loan_type = loan_type.loan_id\n" .
                            "INNER JOIN branch ON unit.branch_id = branch.branch_id\n" .
                            "WHERE loan_type.loan_description = 'N-CELP' AND loan.status = 'NA'")->queryScalar();

            $newProvider = new SqlDataProvider([
                'sql' => "SELECT\n" .
                "borrower.id AS borrower_id, \n" .
                "borrower.profile_pic, \n" .
                "CONCAT(borrower.last_name, ', ',borrower.first_name,' ',borrower.middle_name,' ', borrower.suffix) as fullname,\n" .
                "loan.id AS loan_id, \n" .
                "loan.loan_no, \n" .
                "loan_type.loan_description, \n" .
                "unit.unit_description, \n" .
                "branch.branch_description, \n" .
                "loan.daily, \n" .
                "loan.ci_date, \n" .
                "unit.unit_description AS unit \n" .
                "FROM\n" .
                "borrower\n" .
                "INNER JOIN loan ON loan.borrower = borrower.id\n" .
                "INNER JOIN unit ON loan.unit = unit.unit_id\n" .
                "INNER JOIN loan_type ON loan.loan_type = loan_type.loan_id\n" .
                "INNER JOIN branch ON unit.branch_id = branch.branch_id\n" .
                "WHERE loan_type.loan_description = 'N-CELP' AND loan.status = 'NA'",
                'totalCount' => $newcount,
                'pagination' => [
                    'pageSize' => 10
                ]
            ]);

            // renewal provider 
            $renewalCount = Yii::$app->db->createCommand("SELECT\n" .
                            "COUNT(*)\n" .
                            "FROM\n" .
                            "borrower\n" .
                            "INNER JOIN loan ON loan.borrower = borrower.id\n" .
                            "INNER JOIN unit ON loan.unit = unit.unit_id\n" .
                            "INNER JOIN loan_type ON loan.loan_type = loan_type.loan_id\n" .
                            "INNER JOIN branch ON unit.branch_id = branch.branch_id\n" .
                            "WHERE loan_type.loan_description != 'N-CELP' AND loan.status = 'NA'")->queryScalar();

            $renewalProvider = new SqlDataProvider([
                'sql' => "SELECT\n" .
                "borrower.id AS borrower_id, \n" .
                "borrower.profile_pic, \n" .
                "CONCAT(borrower.last_name, ', ',borrower.first_name,' ',borrower.middle_name,' ', borrower.suffix) as fullname,\n" .
                "loan.id AS loan_id, \n" .
                "loan.loan_no, \n" .
                "loan_type.loan_description, \n" .
                "unit.unit_description, \n" .
                "branch.branch_description, \n" .
                "loan.daily, \n" .
                "loan.ci_date, \n" .
                "unit.unit_description AS unit \n" .
                "FROM\n" .
                "borrower\n" .
                "INNER JOIN loan ON loan.borrower = borrower.id\n" .
                "INNER JOIN unit ON loan.unit = unit.unit_id\n" .
                "INNER JOIN loan_type ON loan.loan_type = loan_type.loan_id\n" .
                "INNER JOIN branch ON unit.branch_id = branch.branch_id\n" .
                "WHERE loan_type.loan_description != 'N-CELP' AND loan.status = 'NA'",
                'totalCount' => $renewalCount,
                'pagination' => [
                    'pageSize' => 10
                ]
            ]);

            return $this->render('releasingapproval', [
                        'newProvider' => $newProvider,
                        'renewalProvider' => $renewalProvider,
            ]);
        } else {
            throw new \yii\web\UnauthorizedHttpException();
        }
    }

    // Borrowers account ledger
    public function actionAccountledger() {
        $borrowerSearch = new BorrowerSfrSearch();
        $borrower = $borrowerSearch->search(Yii::$app->request->queryParams);

        //$borrowers = $borrower->getModels();

        return $this->render('accountledger', [
                    'borrowers' => $borrower,
                    'borrowerSearch' => $borrowerSearch,
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

    public function actionDailyunits($id, $branch) {

        // check if has active account
        $active = Yii::$app->db->createCommand("SELECT\n" .
                        "loan.id\n" .
                        "FROM\n" .
                        "loan\n" .
                        "WHERE loan.borrower = :bor_id AND loan.status = 'A'")->bindValue(':bor_id', $id)->queryOne();
        if (!$active) {

            $data = Borrower::findOne($id); // retrieve borrowers info

            $la = \app\models\LoanschemeAssignment::find()->where(['branch_id' => $data->branch_id])->one(); // retrieve loanscheme through borrowers branch id

            $dailys = \app\models\LoanschemeValues::find()->where(['loanscheme_id' => $la['loanscheme_id']])->all(); // get loanscheme values

            $units = \app\models\Unit::find()->where(['branch_id' => $branch])->all(); // retrieve units

            return Json::encode(array($dailys, $units));
        } else {
            return Json::encode(['active' => true]);
        }
    }

    /**
     *  ajax action to get loan details
     */
    public function actionLoandetails($id) {

        $loan = Loan::find()->where(['borrower' => $id])->all(); // retrieve loan details

        echo Json::encode($loan);
    }

    public function actionApprovedrelease($loan_id = null, $action = null) {
        if (Yii::$app->user->can('ORGANIZER')) {

            Url::remember();

            if (!(is_null($loan_id))) {
                if ($action === 'approved') {
                    $loan = \app\models\Loan::findOne($loan_id);
                    $loan->status = \app\models\Loan::APPROVED;
                    $loan->release_date = date('Y-m-d');
                    $loan->maturity_date = \app\models\Loan::getMaturityDate($loan->release_date, $loan->term);
                    $loan->save();
                    Yii::$app->session->setFlash('loan_approved', "Loan approval success!");
                }
                if ($action === 'hold') {
                    $loan = \app\models\Loan::findOne($loan_id);
                    $loan->status = \app\models\Loan::NEEDAPPROVAL;
                    $loan->save();
                    Yii::$app->session->setFlash('hold_success', "Loan is hold!");
                }
                if ($action === 'cancel') {
                    $loan = \app\models\Loan::findOne($loan_id);
                    $loan->delete(); // todo:: you need to delete also the comaker and etc.. pls note this one
                    Yii::$app->session->setFlash('cancel_success', "Loan is cancelled!");
                }
            }

            //check if admin or branch
            if (strtoupper(Yii::$app->user->identity->branch->branch_description) == 'MAIN') {
                $newcount = Yii::$app->db->createCommand("SELECT\n" .
                                "COUNT(*)\n" .
                                "FROM\n" .
                                "borrower\n" .
                                "INNER JOIN loan ON loan.borrower = borrower.id\n" .
                                "INNER JOIN unit ON loan.unit = unit.unit_id\n" .
                                "INNER JOIN loan_type ON loan.loan_type = loan_type.loan_id\n" .
                                "INNER JOIN branch ON unit.branch_id = branch.branch_id\n" .
                                "WHERE loan_type.loan_description = 'N-CELP' AND loan.status = 'IA'")->queryScalar();

                $newProvider = new SqlDataProvider([
                    'sql' => "SELECT\n" .
                    "borrower.id AS borrower_id, \n" .
                    "borrower.profile_pic, \n" .
                    "CONCAT(borrower.last_name, ', ',borrower.first_name,' ',borrower.middle_name,' ', borrower.suffix) as fullname,\n" .
                    "loan.id AS loan_id, \n" .
                    "loan.loan_no, \n" .
                    "loan_type.loan_description, \n" .
                    "unit.unit_description, \n" .
                    "branch.branch_description, \n" .
                    "loan.daily, \n" .
                    "loan.ci_date, \n" .
                    "unit.unit_description AS unit \n" .
                    "FROM\n" .
                    "borrower\n" .
                    "INNER JOIN loan ON loan.borrower = borrower.id\n" .
                    "INNER JOIN unit ON loan.unit = unit.unit_id\n" .
                    "INNER JOIN loan_type ON loan.loan_type = loan_type.loan_id\n" .
                    "INNER JOIN branch ON unit.branch_id = branch.branch_id\n" .
                    "WHERE loan_type.loan_description = 'N-CELP' AND loan.status = 'IA'",
                    'totalCount' => $newcount,
                    'pagination' => [
                        'pageSize' => 10
                    ]
                ]);

                // renewal provider 
                $renewalCount = Yii::$app->db->createCommand("SELECT\n" .
                                "COUNT(*)\n" .
                                "FROM\n" .
                                "borrower\n" .
                                "INNER JOIN loan ON loan.borrower = borrower.id\n" .
                                "INNER JOIN unit ON loan.unit = unit.unit_id\n" .
                                "INNER JOIN loan_type ON loan.loan_type = loan_type.loan_id\n" .
                                "INNER JOIN branch ON unit.branch_id = branch.branch_id\n" .
                                "WHERE loan_type.loan_description != 'N-CELP' AND loan.status = 'IA'")->queryScalar();

                $renewalProvider = new SqlDataProvider([
                    'sql' => "SELECT\n" .
                    "borrower.id AS borrower_id, \n" .
                    "borrower.profile_pic, \n" .
                    "CONCAT(borrower.last_name, ', ',borrower.first_name,' ',borrower.middle_name,' ', borrower.suffix) as fullname,\n" .
                    "loan.id AS loan_id, \n" .
                    "loan.loan_no, \n" .
                    "loan_type.loan_description, \n" .
                    "unit.unit_description, \n" .
                    "branch.branch_description, \n" .
                    "loan.daily, \n" .
                    "loan.ci_date, \n" .
                    "unit.unit_description AS unit \n" .
                    "FROM\n" .
                    "borrower\n" .
                    "INNER JOIN loan ON loan.borrower = borrower.id\n" .
                    "INNER JOIN unit ON loan.unit = unit.unit_id\n" .
                    "INNER JOIN loan_type ON loan.loan_type = loan_type.loan_id\n" .
                    "INNER JOIN branch ON unit.branch_id = branch.branch_id\n" .
                    "WHERE loan_type.loan_description != 'N-CELP' AND loan.status = 'IA'",
                    'totalCount' => $renewalCount,
                    'pagination' => [
                        'pageSize' => 10
                    ]
                ]);
            } else {
                $newcount = Yii::$app->db->createCommand("SELECT\n" .
                                "COUNT(*)\n" .
                                "FROM\n" .
                                "borrower\n" .
                                "INNER JOIN loan ON loan.borrower = borrower.id\n" .
                                "INNER JOIN unit ON loan.unit = unit.unit_id\n" .
                                "INNER JOIN loan_type ON loan.loan_type = loan_type.loan_id\n" .
                                "INNER JOIN branch ON unit.branch_id = branch.branch_id\n" .
                                "WHERE borrower.branch_id=:branch_id AND loan_type.loan_description='N-CELP' AND loan.status='IA'", [':branch_id' => Yii::$app->user->identity->branch->branch_id])->queryScalar();

                $newProvider = new SqlDataProvider([
                    'sql' => "SELECT\n" .
                    "borrower.id AS borrower_id, \n" .
                    "borrower.profile_pic, \n" .
                    "CONCAT(borrower.last_name, ', ',borrower.first_name,' ',borrower.middle_name,' ', borrower.suffix) as fullname,\n" .
                    "loan.id AS loan_id, \n" .
                    "loan.loan_no, \n" .
                    "loan_type.loan_description, \n" .
                    "unit.unit_description, \n" .
                    "branch.branch_description, \n" .
                    "loan.daily, \n" .
                    "loan.ci_date, \n" .
                    "unit.unit_description AS unit \n" .
                    "FROM\n" .
                    "borrower\n" .
                    "INNER JOIN loan ON loan.borrower = borrower.id\n" .
                    "INNER JOIN unit ON loan.unit = unit.unit_id\n" .
                    "INNER JOIN loan_type ON loan.loan_type = loan_type.loan_id\n" .
                    "INNER JOIN branch ON unit.branch_id = branch.branch_id\n" .
                    "WHERE borrower.branch_id = :branch_id AND  loan_type.loan_description = 'N-CELP' AND loan.status = 'IA'",
                    'totalCount' => $newcount,
                    'params' => [':branch_id' => Yii::$app->user->identity->branch->branch_id],
                    'pagination' => [
                        'pageSize' => 10
                    ]
                ]);

                // renewal provider 
                $renewalCount = Yii::$app->db->createCommand("SELECT\n" .
                                "COUNT(*)\n" .
                                "FROM\n" .
                                "borrower\n" .
                                "INNER JOIN loan ON loan.borrower = borrower.id\n" .
                                "INNER JOIN unit ON loan.unit = unit.unit_id\n" .
                                "INNER JOIN loan_type ON loan.loan_type = loan_type.loan_id\n" .
                                "INNER JOIN branch ON unit.branch_id = branch.branch_id\n" .
                                "WHERE borrower.branch_id = :branch_id AND  loan_type.loan_description != 'N-CELP' AND loan.status = 'IA'", [':branch_id' => Yii::$app->user->identity->branch->branch_id])->queryScalar();

                $renewalProvider = new SqlDataProvider([
                    'sql' => "SELECT\n" .
                    "borrower.id AS borrower_id, \n" .
                    "borrower.profile_pic, \n" .
                    "CONCAT(borrower.last_name, ', ',borrower.first_name,' ',borrower.middle_name,' ', borrower.suffix) as fullname,\n" .
                    "loan.id AS loan_id, \n" .
                    "loan.loan_no, \n" .
                    "loan_type.loan_description, \n" .
                    "unit.unit_description, \n" .
                    "branch.branch_description, \n" .
                    "loan.daily, \n" .
                    "loan.ci_date, \n" .
                    "unit.unit_description AS unit \n" .
                    "FROM\n" .
                    "borrower\n" .
                    "INNER JOIN loan ON loan.borrower = borrower.id\n" .
                    "INNER JOIN unit ON loan.unit = unit.unit_id\n" .
                    "INNER JOIN loan_type ON loan.loan_type = loan_type.loan_id\n" .
                    "INNER JOIN branch ON unit.branch_id = branch.branch_id\n" .
                    "WHERE borrower.branch_id = :branch_id AND loan_type.loan_description != 'N-CELP' AND loan.status = 'IA'",
                    'params' => [':branch_id' => Yii::$app->user->identity->branch->branch_id],
                    'totalCount' => $renewalCount,
                    'pagination' => [
                        'pageSize' => 10
                    ]
                ]);
            }

            return $this->render('approvedrelease', [
                        'newProvider' => $newProvider,
                        'renewalProvider' => $renewalProvider,
            ]);
        } else {
            throw new \yii\web\UnauthorizedHttpException();
        }
    }

    public function actionLedger($id) {

        $borrower = Borrower::findOne(['id' => $id]);

        $loanquery = Loan::find()->where(['borrower' => $id])->andWhere(['or', "status='A'", "status='PD'", "status='WA'", "status='PO'"]);
        $loanprovider = new ActiveDataProvider([
            'query' => $loanquery,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ]
        ]);

        return $this->render('accountinfo', [
                    'loanprovider' => $loanprovider,
                    'borrower' => $borrower
        ]);
    }

    // ajax action for getting the loan info
    public function actionLoaninfo($loanid) {
        $loaninfo = Yii::$app->db->createCommand("SELECT\n" .
                        "CONCAT(borrower.last_name,', ',borrower.first_name,' ',borrower.middle_name) AS fullname,\n" .
                        "borrower.suffix,\n" .
                        "borrower.id as borrowerid,\n" .
                        "borrower.canvass_by,\n" .
                        "loan.id as loanid,\n" .
                        "loan.loan_no,\n" .
                        "loan.unit,\n" .
                        "loan.release_date,\n" .
                        "loan.maturity_date,\n" .
                        "loan.daily,\n" .
                        "loan.term,\n" .
                        "loan.status,\n" .
                        "loan.interest_bdays,\n" .
                        "loan_type.loan_description,\n" .
                        "borrower.contact_no,\n" .
                        "loan.penalty,\n" .
                        "loan.penalty_days,\n" .
                        "loan.net_proceeds,\n" .
                        "IFNULL((SELECT SUM(pay_amount) FROM payment WHERE loan_id = loan.id),0) as total_payments\n" .
                        "FROM\n" .
                        "borrower\n" .
                        "INNER JOIN loan ON loan.borrower = borrower.id\n" .
                        "INNER JOIN loan_type ON loan.loan_type = loan_type.loan_id\n" .
                        "LEFT JOIN payment ON payment.loan_id = loan.id\n" .
                        "WHERE loan.id = :loanid GROUP BY loanid")->bindValue(':loanid', $loanid)->queryAll();

        $canvasser = Yii::$app->db->createCommand("SELECT\n" .
                        "CONCAT(employee.last_name,', ',employee.first_name,' ',employee.middle_name) as fullname,\n" .
                        "position.position\n" .
                        "FROM\n" .
                        "employee\n" .
                        "INNER JOIN emposition ON emposition.employee_id = employee.id\n" .
                        "INNER JOIN position ON emposition.position_id = position.id\n" .
                        "WHERE employee.id = :id")->bindValue(':id', $loaninfo[0]['canvass_by'])->queryAll();

        $business = Yii::$app->db->createCommand("SELECT\n" .
                        "business_type.business_description\n" .
                        "FROM\n" .
                        "business\n" .
                        "INNER JOIN business_type ON business.business_type_id = business_type.id\n" .
                        "WHERE business.borrower_id = :id")->bindValue(':id', $loaninfo[0]['borrowerid'])->queryScalar();

        // get the penalty and delinquent //==================================================
        $jumpdates = Yii::$app->db->createCommand("SELECT jump_date FROM jumpdate")->queryAll();
        $jumps = [];

        foreach ($jumpdates as $jump) {
            array_push($jumps, $jump['jump_date']);
        }

        $days_counter = 0;
        $date_now = date('Y-m-d');

        // get the numbers of days from date realesing until the current date
        $rel_date = date_create($loaninfo[0]['release_date']);
        $current_date = date_create(date('Y-m-d'));
        $days = $current_date->diff($rel_date)->format("%a");
        $no_days = $days - 1;

        $test_date = $rel_date->modify('+1 day');

        // get total payments
        $total_amount_paid = Yii::$app->db->createCommand("SELECT SUM(pay_amount) as total_payment\n" .
                        "FROM\n" .
                        "payment\n" .
                        "WHERE loan_id = :id")->bindValue(':id', $loanid)->queryScalar();
        //initialized 
        $delamt = 0;
        $paid_amt = 0;

        $total_penalty = 0;
        $pen_days = 0;

        $payments = [];
        $totalpayasdate = 0;
        $jump = false;
        $sunday = false;

        // get the beggining balance
        $totalbalance = $loaninfo[0]['daily'] * $loaninfo[0]['term'];

        // looping to do calculations
        while ($days_counter < $no_days) {
            $paid_amt = \app\models\Loan::getPaidAmount($loanid, $test_date->format('Y-m-d'));
            if (($test_date->format('N') == 7) || in_array($test_date->format('Y-m-d'), $jumps)) {
                //holiday or Sunday
                if ($test_date->format('N') == 7) {
                    $sunday = true;
                    $jump = false;
                } else {
                    $sunday = false;
                    $jump = true;
                }
            } else {
                if ($delamt >= 0) {
                    $delamt = $delamt + $paid_amt - $loaninfo[0]['daily']; // delqnt calculation 
                } else {
                    $delamt = $paid_amt - ($loaninfo[0]['daily'] - $delamt); // delqnt calculation
                }
                if ($delamt > 0) {
                    $delamt = $delamt - $total_penalty;
                    if ($delamt < 0) {
                        $total_penalty = $delamt * -1;
                        $delamt = 0;
                    } else {
                        $total_penalty = 0;
                    }
                } else {
                    // add penalty if delqnt amt is equal to 3 or greater
                    $pen_days = abs(($delamt * -1) / $loaninfo[0]['daily']);
                    if ($pen_days >= $loaninfo[0]['penalty_days']) {
                        $total_penalty = $total_penalty + $loaninfo[0]['penalty'];
                        $totalbalance = $totalbalance + $loaninfo[0]['penalty'];
                    }
                }
            }
            if ($total_penalty == 0 && $totalbalance == 0) {
                $delamt = 0;
            }
            // get the amount paid to date
            $payAmountThisDate = Yii::$app->db->createCommand("SELECT IFNULL(pay_amount, 0) as pay_amount\n" .
                            "FROM\n" .
                            "payment\n" .
                            "WHERE loan_id = :id AND pay_date = :paydate")->bindValues([':id' => $loanid, ':paydate' => $test_date->format('Y-m-d')])->queryScalar();
            if ($payAmountThisDate == false) {
                $payAmountThisDate = 0; // set payment to zero if no payment
            }
            $totalpayasdate = $totalpayasdate + $payAmountThisDate; // get total amount paid from releasing up to present date
            $totalbalance = $totalbalance - $payAmountThisDate;
            // put values to array
            $payments[] = ['paydate' => $test_date->format('Y-m-d'), 'payamount' => $payAmountThisDate, 'delamt' => $delamt, 'penalty' => $total_penalty, 'balance' => $totalbalance, 'sunday' => $sunday, 'jump' => $jump];
            // increment counters and date
            $days_counter++;
            $test_date = $test_date->modify('+1 day');
            $jump = false;
            $sunday = false;
        } // end of the looping


        if (($loaninfo[0]['status'] == 'PO') || ($loaninfo[0]['status'] == 'WA')) {
            $delamt = 0;
            $totalbalance = 0;
            $total_penalty = 0;
        }

        // get the last pay date
        $last_pay_date = Yii::$app->db->createCommand("SELECT\n" .
                        "payment.pay_date\n" .
                        "FROM\n" .
                        "payment\n" .
                        "WHERE loan_id = :loanid \n" .
                        "ORDER BY payment.id DESC\n" .
                        "LIMIT 1")->bindValue(':loanid', $loanid)->queryScalar();
        if ($last_pay_date == false) {
            $last_pay_date = "";
        }

        $calculations = array($total_penalty, $delamt, $totalbalance, $total_amount_paid, $last_pay_date);
        // end of calculation // =================================================================
        // return values as json 
        return Json::encode(array($loaninfo, $canvasser, $business, $calculations, $payments));
    }

    // ================================================================================================================
    // ajax action use in borrowers collection 
    public function actionGetunits() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $branch_id = $parents[0];
                $list = \app\models\Unit::find()->andWhere(['branch_id' => $branch_id])->asArray()->all();
                $selected = null;
                foreach ($list as $i => $value) {
                    $out[] = ['id' => $value['unit_id'], 'name' => $value['unit_description']];
                    if ($i == 0) {
                        $selected = $value['unit_id'];
                    }
                }
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    // ajax action to submit remitted amount
    public function actionAjaxcall($loanid, $amtrem, $collectiondate) {

        // check if payment already in the database
        $payment = \app\models\Payment::findOne(['loan_id' => $loanid, 'pay_date' => $collectiondate]);

        // if already in the database 
        // do update
        if ($payment != null) {
            $payment->pay_amount = $amtrem;
            $payment->pay_date = $collectiondate;
            $payment->loan_id = $loanid;
            $payment->money_id = 1; //  temporay only
            $payment->save();
        } else {
            // else 
            // do insert  
            $payment = new \app\models\Payment;
            $payment->pay_amount = $amtrem;
            $payment->pay_date = $collectiondate;
            $payment->loan_id = $loanid;
            $payment->money_id = 1; //  temporay only
            $payment->save();
        }
    }

    // for testing only actions here ================================================================================

    public function actionTest2($date, $term) {

        $jumpdates = Yii::$app->db->createCommand("SELECT jump_date FROM jumpdate")->queryAll();

        $jumps = [];

        foreach ($jumpdates as $jump) {
            array_push($jumps, $jump['jump_date']);
        }

        $rel_date = new \DateTime($date);
        $dum_reldate = new \DateTime($date);
        $mat_date = $dum_reldate->modify('+' . $term . 'days');

        $i = 0;

        $date_now = $rel_date->modify('+1 day');
        $sundays = 0;

        while ($i < $term) {

            if (($date_now->format('N') == 7) || in_array($date_now->format('Y-m-d'), $jumps, true)) {
                $mat_date->modify('+1 day');
                $sundays++;
                if (in_array($date_now->format('Y-m-d'), $jumps, true)) {
                    echo '<span style="color: blue;">Jumpdate:' . $date_now->format('Y-m-d') . '</span>';
                } else {
                    echo '<span style="color: red;">Sunday:' . $date_now->format('Y-m-d') . '</span>';
                }

                echo '<br>';
            } else {
                $i++;
            }
            $date_now = $rel_date->modify('+1 day');
        }

        echo '<br>';
        echo 'Release date: ' . $date . '<br>';
        echo 'No. of Jumpdates: ' . $sundays . '<br>';
        echo 'Maturity date: ';
        echo $mat_date->format('m/d/Y');
    }

    public function actionAbsentpenalty($release_date, $daily, $loan_id, $penalty, $loan_penalty_days) {

        $jumpdates = Yii::$app->db->createCommand("SELECT jump_date FROM jumpdate")->queryAll();
        $jumps = [];

        foreach ($jumpdates as $jump) {
            array_push($jumps, $jump['jump_date']);
        }

        if ($release_date != '' && $daily != '' && $loan_id != '') {
            $days_counter = 0;
            $date_now = date('Y-m-d');

            // get the numbers of days from date realesing until the current date
            $rel_date = date_create($release_date);
            $current_date = date_create(date('Y-m-d'));
            $days = date_diff($current_date, $rel_date);
            $no_days = ($days->format('%d') - 1);

            $test_date = $rel_date->modify('+1 day');
            //initialized 
            $delamt = 0;
            $paid_amt = 0;

            $total_penalty = 0;
            $pen_days = 0;
            $cash = 0;

            while ($days_counter < $no_days) {
                $paid_amt = self::getPaidAmount($loan_id, $test_date->format('Y-m-d'));
                if (($test_date->format('N') == 7) || in_array($test_date->format('Y-m-d'), $jumps)) {
                    //printing
                    echo '-------------------------------------<br>';
                    echo '| Transaction Date: ' . $test_date->format('Y-m-d') . '<br>';
                    echo '| <span style="color: red">JUMPDATE OR SUNDAY</span><br>';
                    echo '-------------------------------------<br>';
                } else {
                    if ($delamt >= 0) {
                        $delamt = $delamt + $paid_amt - $daily; // delqnt calculation 
                    } else {

                        $delamt = $paid_amt - ($daily - $delamt); // delqnt calculation
                    }

                    if ($delamt >= 0) {
                        if (($total_penalty > 0) && ($delamt > 0)) {
                            $delamt = $delamt - $total_penalty;
                            if ($delamt < 0) {
                                $total_penalty = $delamt * -1;
                                $delamt = 0;
                            }
                            $total_penalty = 0;
                        }
                    } else {
                        $pen_days = abs(($delamt * -1) / $daily);
                        if ($pen_days >= $loan_penalty_days) {
                            $total_penalty = $total_penalty + $penalty;
                        }
                    }

                    //printing
                    echo '-------------------------------------<br>';
                    echo '| Transaction Date: ' . $test_date->format('Y-m-d') . '<br>';
                    echo '| Payment: ' . $paid_amt . '<br>';
                    echo '| Delqnt/Advance Amt: ' . $delamt . '<br>';
                    echo '| Penalty Amt: ' . $total_penalty . '<br>';
                    echo '-------------------------------------<br>';
                }

                // increment counters and date
                $days_counter++;
                $test_date = $test_date->modify('+1 day');
            }
            echo "Opps something isn't right!!";
        } else {
            throw new \yii\base\InvalidParamException;
        }
    }

    private function getPaidAmount($loan_id, $pay_date) {
        $payment_count = \app\models\Payment::findOne(['loan_id' => $loan_id, 'pay_date' => $pay_date]);
        if (count($payment_count) == 1) {
            return $payment_count->pay_amount;
        }
        return 0;
    }

    public function actionTestdate() {

        $date = date_create('2017-1-17');
        $rel_date = date_create('2016-12-17');

        echo $rel_date->diff($date)->format('%a');
    }

    public function actionTestsumpayment($id) {
        echo \app\models\loan::getTotalPayments($id);
    }

}
