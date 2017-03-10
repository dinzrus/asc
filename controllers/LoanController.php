<?php

namespace app\controllers;

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
        return $this->render('viewloan');
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
        return $this->render('viewloan');
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
