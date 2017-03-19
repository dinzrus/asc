<?php

namespace app\controllers;

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
        
        Url::remember();
        

        return $this->render('viewloan', [
                    'borrower' => $borrower,
                    'loan' => $loan,
                    'business' => $business,
                    'dependent' => $dependent,
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
        
        Url::remember();

        return $this->render('viewloan', [
                    'borrower' => $borrower,
                    'loan' => $loan,
                    'business' => $business,
                    'dependent' => $dependent,
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
