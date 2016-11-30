<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Loan;
use app\models\SignupForm;
use app\models\BorrowerSfrSearch;
use app\models\Borrower;
use app\models\Log;
use yii\web\UploadedFile;
use yii\data\Pagination;
use yii\helpers\Json;

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
        $borrowersearch = new BorrowerSfrSearch();
        $borrower = $borrowersearch->search(Yii::$app->request->queryParams);

        $borrowers = $borrower->getModels();

        $loantype = \app\models\LoanType::find()->all();

        return $this->render('scheduleforreleasing', [
                    'borrowers' => $borrowers,
                    'borrowersearch' => $borrowersearch,
                    'loantype' => $loantype,
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
    public function actionSchedulerelease($id, $loantype, $daily, $unit) {

        if (Yii::$app->user->can('ORGANIZER')) {

            $borrower = Borrower::findOne(['id' => $id]);
            $business = \app\models\base\Business::findOne(['borrower_id' => $id]);
            $unt = \app\models\Unit::findOne(['unit_id' => $unit]);
            $ltype = \app\models\LoanType::findOne(['loan_id' => $loantype]);
            $loanscheme = \app\models\LoanschemeValues::findOne(['id' => $daily]);

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

                // todo: calculate age 
                $comaker->age = \app\models\Comaker::calculateAge($comaker->birthdate);
                // todo: set release and maturity date 
                $loan->release_date = date('m/d/y'); // get the date of the day
                $loan->maturity_date = \app\models\Loan::getMaturityDate($loan->release_date);

                // todo: generate account no.
                $loan->loan_no = Loan::generateLoanNumber($borrower->id, $borrower->branch_id); // todo: temp only
                $loan->status = $loan::NEEDAPPROVAL;

                if ($comaker->validate() && $loan->validate()) {
                    $comaker->save();
                    $loan->save();

                    $loan_comaker = new \app\models\Loancomaker();
                    $loan_comaker->loan_id = $loan->id;
                    $loan_comaker->comaker_id = $comaker->id;
                    $loan_comaker->save();

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
                ]);
            }
        } else {
            throw new \yii\web\UnauthorizedHttpException();
        }
    }

    public function actionReleasingapproval($id = null) {

        if (Yii::$app->user->can('IT')) {

            if (!(is_null($id))) {
                $loan = \app\models\Loan::findOne($id);
                $loan->status = \app\models\Loan::INITIALAPPROVED;
                $loan->save();
                Yii::$app->session->setFlash('loan_approved', "Loan approval success!");
            }

            $loan_for_approval = Yii::$app->db->createCommand("SELECT\n" .
                            "borrower.id,\n" .
                            "borrower.first_name,\n" .
                            "borrower.last_name,\n" .
                            "borrower.middle_name,\n" .
                            "borrower.suffix,\n" .
                            "loan.id AS loan_id,\n" .
                            "loan.loan_no,\n" .
                            "loan.loan_type,\n" .
                            "loan.release_date,\n" .
                            "loan.maturity_date,\n" .
                            "loan.daily,\n" .
                            "unit.unit_description,\n" .
                            "loan_type.loan_description,\n" .
                            "branch.branch_description,\n" .
                            "ci.fname AS ci_fname,\n" .
                            "ci.lname AS ci_lname,\n" .
                            "ci.middlename AS ci_middlename,\n" .
                            "loan.ci_date\n" .
                            "FROM\n" .
                            "borrower\n" .
                            "INNER JOIN loan ON loan.borrower = borrower.id\n" .
                            "INNER JOIN unit ON loan.unit = unit.unit_id\n" .
                            "INNER JOIN loan_type ON loan.loan_type = loan_type.loan_id\n" .
                            "INNER JOIN branch ON unit.branch_id = branch.branch_id\n" .
                            "INNER JOIN ci ON loan.ci_officer = ci.id\n" .
                            "WHERE loan.status = 'NA'")->queryAll();

            return $this->render('releasingapproval', ['loan_for_approval' => $loan_for_approval]);
        } else {
            throw new \yii\web\UnauthorizedHttpException();
        }
    }

    // Borrowers account ledger
    public function actionAccountledger() {
        $borrowersearch = new BorrowerSfrSearch();
        $borrower = $borrowersearch->search(Yii::$app->request->queryParams);

        $borrowers = $borrower->getModels();

        return $this->render('accountledger', [
                    'borrowers' => $borrowers,
                    'borrowersearch' => $borrowersearch,
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

        $data = Borrower::findOne($id); // retrieve borrowers info

        $la = \app\models\LoanschemeAssignment::find()->where(['branch_id' => $data->branch_id])->one(); // retrieve loanscheme through borrowers branch id

        $dailys = \app\models\LoanschemeValues::find()->where(['loanscheme_id' => $la['loanscheme_id']])->all(); // get loanscheme values

        $units = \app\models\Unit::find()->where(['branch_id' => $branch])->all(); // retrieve units

        echo Json::encode(array($dailys, $units));

        die();
    }

    /**
     *  ajax function to get loan details
     */
    public function actionLoandetails($id) {

        $loan = Loan::find()->where(['borrower' => $id])->all(); // retrieve loan details

        echo Json::encode($loan);
    }

    public function actionApprovedreleased($loan_id = null) {
        if (Yii::$app->user->can('IT')) {
            $loans = Yii::$app->db->createCommand("SELECT\n" .
                            "borrower.id AS borrower_id,\n" .
                            "CONCAT(borrower.last_name,', ', borrower.first_name,' ',borrower.middle_name) AS fullname,\n" .
                            "borrower.suffix,\n" .
                            "loan.id as loan_id,\n" .
                            "loan.loan_no,\n" .
                            "unit.unit_description,\n" .
                            "branch.branch_description,\n" .
                            "loan.daily,\n" .
                            "loan_type.loan_description\n" .
                            "FROM\n" .
                            "loan\n" .
                            "INNER JOIN borrower ON loan.borrower = borrower.id\n" .
                            "INNER JOIN unit ON loan.unit = unit.unit_id\n" .
                            "INNER JOIN branch ON unit.branch_id = branch.branch_id\n" .
                            "INNER JOIN loan_type ON loan.loan_type = loan_type.loan_id\n" .
                            "WHERE\n" .
                            "loan.status = 'IA'")->queryAll();
            return $this->render('approvedreleased',[
                                    'loans' => $loans,
            ]);
        } else {
            throw new \yii\web\UnauthorizedHttpException();
        }
    }

    public function actionLedger($id) {

        $borrower = Borrower::findOne(['id' => $id]);
        $loans = Loan::find()->where(['borrower' => $id, 'status' => 'A'])->all();

        return $this->render('accountinfo', [
                    'loans' => $loans,
                    'borrower' => $borrower
        ]);
    }

    // for testing only
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

}
