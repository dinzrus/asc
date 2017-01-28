<?php

namespace app\models;

use \app\models\base\Loan as BaseLoan;
use Yii;

/**
 * This is the model class for table "loan".
 */
class Loan extends BaseLoan {

    const NEEDAPPROVAL = 'NA';
    const INITIALAPPROVED = 'IA';
    const APPROVED = 'A';
    const WAIVEDACCOUNT = 'WA';
    const PASTDUE = 'PD';
    const POUT = 'PO';

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_replace_recursive(parent::rules(), [
            [['loan_no', 'loan_type', 'borrower', 'unit', 'release_date', 'maturity_date', 'daily', 'term', 'gross_amount', 'interest_bdays', 'gas', 'doc_stamp', 'misc', 'admin_fee', 'notarial_fee', 'additional_fee', 'total_deductions', 'add_days', 'add_coll', 'net_proceeds', 'penalty', 'collaterals', 'ci_date', 'ci_officer'], 'required'],
            [['loan_type', 'borrower', 'unit', 'daily', 'term', 'add_days', 'ci_officer'], 'integer'],
            [['release_date', 'maturity_date', 'created_at', 'updated_at', 'ci_date'], 'safe'],
            [['gross_amount', 'interest_bdays', 'gas', 'doc_stamp', 'misc', 'admin_fee', 'notarial_fee', 'additional_fee', 'total_deductions', 'add_coll', 'net_proceeds', 'penalty'], 'number'],
            [['loan_no'], 'string', 'max' => 50],
            [['collaterals', 'created_by', 'updated_by'], 'string', 'max' => 255]
        ]);
    }

    /**
     * This will return the maturity date of the loan
     * @param type $date
     * @param type $term
     * @return type string
     */
    public static function getMaturityDate($date, $term) {

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
            } else {
                $i++;
            }
            $date_now = $rel_date->modify('+1 day');
        }

        return $mat_date->format('Y-m-d');
    }

    /**
     * 
     * @param type $borrower_id
     * @param type $branch_id
     * @return type string
     */
    public static function generateLoanNumber($borrower_id, $loan) {
        $digits = 3;
        return str_pad($borrower_id, 3, '0', STR_PAD_LEFT) . '-' . date('mdY') . rand(pow(10, $digits - 1), pow(10, $digits) - 1) . '-' . $loan->unit0->unit_description;
    }

    public static function loanCalculation($release_date, $gross_amt, $daily, $loan_id, $penalty_days, $penalty_amt) {

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
            $days = $current_date->diff($rel_date)->format("%a");
            $no_days = $days - 1; // minus 1 day so that current date will not be included in checking

            $test_date = $rel_date->modify('+1 day');
            //initialized 
            $delamt = 0;
            $paid_amt = 0;

            $total_penalty = 0;
            $pen_days = 0;
            $cash = 0;
            $totalbalance = $gross_amt;
            while ($days_counter < $no_days) {
                $paid_amt = self::getPaidAmount($loan_id, $test_date->format('Y-m-d'));
                if (($test_date->format('N') == 7) || in_array($test_date->format('Y-m-d'), $jumps)) {
                    
                } else {

                    if ($delamt >= 0) {
                        $delamt = $delamt + $paid_amt - $daily; // delqnt calculation 
                    } else {
                        $delamt = $paid_amt - ($daily - $delamt); // delqnt calculation
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
                        $pen_days = abs(($delamt * -1) / $daily);
                        if ($pen_days >= $penalty_days) {
                            $total_penalty = $total_penalty + $penalty_amt;
                            $totalbalance = $totalbalance + $penalty_amt;
                        }
                    }
                }
                $days_counter++;
                $test_date = $test_date->modify('+1 day');
            } // END OF WHILE LOOP
            
            $payments = self::getTotalPayments($loan_id);
            $totalbalance = $totalbalance - $payments;

            return [
                'delinquent_advance' => $delamt,
                'penalty' => $total_penalty,
                'balance' => $totalbalance,
            ];
        } else {
            throw new \yii\base\InvalidParamException;
        }
    }

    public static function getPaidAmount($loan_id, $pay_date) {
        $payment_count = \app\models\Payment::findOne(['loan_id' => $loan_id, 'pay_date' => $pay_date]);
        if (count($payment_count) == 1) {
            return $payment_count->pay_amount;
        }
        return 0;
    }

    public static function getTotalPayments($loan_id) {
        $total_amount = Yii::$app->db->createCommand("SELECT SUM(pay_amount) as total_payment\n" .
                        "FROM\n" .
                        "payment\n" .
                        "WHERE loan_id = :id")->bindValue(':id', $loan_id)->queryScalar();
        return $total_amount;
    }

    public function getLastPay($loan_id) {
        $last_pay = Yii::$app->db->createCommand("SELECT\n" .
                        "payment.pay_amount\n" .
                        "FROM\n" .
                        "payment\n" .
                        "WHERE loan_id = :loanid \n" .
                        "ORDER BY payment.id DESC\n" .
                        "LIMIT 1")->bindValue(':loanid', $loan_id)->queryScalar();

        if ($last_pay == false) {
            return 0;
        } else {
            return $last_pay;
        }
    }

}
