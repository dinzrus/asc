<?php

namespace app\controllers;

use Yii;
use app\models\Borrower;
use app\models\Loan;
use app\models\Business;
use app\models\Dependent;
use yii\helpers\Url;

class LoanController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Functions for new loan   
     */

    /**
     * 
     * @param int $id - loan id
     */
    public function actionViewnew($borrowerid, $loanid) {
        $borrower = Borrower::findOne(['id' => $borrowerid]);
        $business = Business::findOne(['borrower_id' => $borrowerid]);
        $dependent = Dependent::findAll(['borrower_id' => $borrowerid]);
        $loan = Loan::findOne(['id' => $loanid]);

        $comaker = Yii::$app->db->createCommand("SELECT\n" .
                        "comaker.id,\n" .
                        "comaker.profile_pic,\n" .
                        "comaker.first_name,\n" .
                        "comaker.last_name,\n" .
                        "comaker.middle_name,\n" .
                        "comaker.suffix,\n" .
                        "comaker.birthdate,\n" .
                        "comaker.age,\n" .
                        "comaker.birthplace,\n" .
                        "comaker.civil_status,\n" .
                        "comaker.contact_no,\n" .
                        "comaker.`status`,\n" .
                        "comaker.gender,\n" .
                        "CONCAT(comaker.address_street_house_no, ', ',barangay.barangay, ', ',municipality_city.municipality_city, ', ', province.province)as full_address\n" .
                        "FROM\n" .
                        "comaker\n" .
                        "INNER JOIN loan_comaker ON loan_comaker.comaker_id = comaker.id\n" .
                        "INNER JOIN province ON province.id = comaker.address_province_id\n" .
                        "INNER JOIN municipality_city ON municipality_city.id = comaker.address_city_municipality_id\n" .
                        "INNER JOIN barangay ON barangay.id = comaker.address_barangay_id WHERE loan_comaker.loan_id = :loan_id")->bindValue(':loan_id', $loanid)->queryOne();

        Url::remember();


        return $this->render('viewloan', [
                    'borrower' => $borrower,
                    'loan' => $loan,
                    'business' => $business,
                    'dependent' => $dependent,
                    'comaker' => $comaker,
        ]);
    }

    /**
     * 
     * @param int $id - loan id
     */
    public function actionNewmainapprove($id) {
        
    }

    /**
     * 
     * @param int $id - loan id
     */
    public function actionNewmainhold($id) {
        
    }

    /**
     * 
     * @param int $id - loan id
     */
    public function actionNewmaindenied($id) {
        
    }

    // ===============================================================================================

    /**
     * Functions for renewal loan
     */

    /**
     * 
     * @param int $id - loan id
     */
    public function actionViewrenewal($borrowerid, $loanid) {
        $borrower = Borrower::findOne(['id' => $borrowerid]);
        $business = Business::findOne(['borrower_id' => $borrowerid]);
        $dependent = Dependent::findAll(['borrower_id' => $borrowerid]);
        $loan = Loan::findOne(['id' => $loanid]);

         $comaker = Yii::$app->db->createCommand("SELECT\n" .
                        "comaker.id,\n" .
                        "comaker.profile_pic,\n" .
                        "comaker.first_name,\n" .
                        "comaker.last_name,\n" .
                        "comaker.middle_name,\n" .
                        "comaker.suffix,\n" .
                        "comaker.birthdate,\n" .
                        "comaker.age,\n" .
                        "comaker.birthplace,\n" .
                        "comaker.civil_status,\n" .
                        "comaker.contact_no,\n" .
                        "comaker.`status`,\n" .
                        "comaker.gender,\n" .
                        "CONCAT(comaker.address_street_house_no, ', ',barangay.barangay, ', ',municipality_city.municipality_city, ', ', province.province) as full_address\n" .
                        "FROM\n" .
                        "comaker\n" .
                        "INNER JOIN loan_comaker ON loan_comaker.comaker_id = comaker.id\n" .
                        "INNER JOIN province ON province.id = comaker.address_province_id\n" .
                        "INNER JOIN municipality_city ON municipality_city.id = comaker.address_city_municipality_id\n" .
                        "INNER JOIN barangay ON barangay.id = comaker.address_barangay_id WHERE loan_comaker.loan_id = :loan_id")->bindValue(':loan_id', $loanid)->queryOne();

        Url::remember(); // i'm not sure with this one

        return $this->render('viewloan', [
                    'borrower' => $borrower,
                    'loan' => $loan,
                    'business' => $business,
                    'dependent' => $dependent,
                    'comaker' => $comaker,
        ]);
    }

    /**
     * 
     * @param int $id - loan id
     */
    public function actionRenewalmainapprove($id) {
        
    }

    /**
     * 
     * @param int $id - loan id
     */
    public function actionRenewalmainhold($id) {
        
    }

    /**
     * 
     * @param int $id - loan id
     */
    public function actionRenewalmaindenied($id) {
        
    }

}
