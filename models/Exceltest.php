<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "exceltest".
 *
 * @property integer $id
 * @property double $daily
 * @property integer $term
 * @property double $gross_amt
 * @property double $interest
 * @property double $vat
 * @property double $notarial
 * @property double $processing_fee
 * @property double $total_deductions
 * @property integer $add_days
 * @property double $add_coll
 * @property double $net_proceeds
 * @property double $penalty
 * @property integer $pen_days
 */
class Exceltest extends \yii\db\ActiveRecord {

    public $excelfile;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'exceltest';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['daily', 'gross_amt', 'interest', 'vat', 'notarial', 'processing_fee', 'total_deductions', 'add_coll', 'net_proceeds', 'penalty'], 'number'],
            [['daily', 'gross_amt', 'interest', 'vat', 'notarial', 'processing_fee', 'total_deductions', 'add_coll', 'net_proceeds', 'penalty'], 'required'],
            [['term', 'add_days', 'pen_days'], 'integer'],
            [['excelfile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'xls, xlsx'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'daily' => 'Daily',
            'term' => 'Term',
            'gross_amt' => 'Gross Amt',
            'interest' => 'Interest',
            'vat' => 'Vat',
            'notarial' => 'Notarial',
            'processing_fee' => 'Processing Fee',
            'total_deductions' => 'Total Deductions',
            'add_days' => 'Add Days',
            'add_coll' => 'Add Coll',
            'net_proceeds' => 'Net Proceeds',
            'penalty' => 'Penalty',
            'pen_days' => 'Pen Days',
        ];
    }

    public function upload() {
        if ($this->excelfile != "") {
            $this->excelfile->saveAs('fileupload/' . $this->excelfile->baseName . '.' . $this->excelfile->extension);
            return true;
        } else {
            return false;
        }
    }

}
