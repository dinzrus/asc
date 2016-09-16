<?php

namespace app\models;

use \app\models\base\LoanschemeValues as BaseLoanschemeValues;

/**
 * This is the model class for table "loanscheme_values".
 */
class LoanschemeValues extends BaseLoanschemeValues {

    public $excelfile;
    public $pathname;

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_replace_recursive(parent::rules(), [
            [['loanscheme_id', 'daily', 'term', 'gross_amt', 'interest', 'vat', 'admin_fee', 'notary_fee', 'misc', 'doc_stamp', 'gas', 'total_deductions', 'add_days', 'add_coll', 'net_proceeds', 'penalty', 'pen_days'], 'required'],
            [['loanscheme_id', 'term', 'add_days', 'pen_days'], 'integer'],
            [['daily', 'gross_amt', 'interest', 'vat', 'admin_fee', 'notary_fee', 'misc', 'doc_stamp', 'gas', 'total_deductions', 'add_coll', 'net_proceeds', 'penalty'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'pathname'], 'string', 'max' => 255],
            [['excelfile'], 'file', 'skipOnEmpty' => FALSE, 'extensions' => 'xls, xlsx'],
        ]);
    }

    public function upload() {
        if ($this->excelfile != "") {
            $this->excelfile->saveAs('fileupload/' . $this->excelfile->baseName . '.' . $this->excelfile->extension);
            $this->pathname = 'fileupload/' . $this->excelfile->baseName . '.' . $this->excelfile->extension;
            return true;
        } else {
            return false;
        }
    }

}
