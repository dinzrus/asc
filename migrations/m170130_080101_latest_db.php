<?php

use yii\db\Schema;

class m170130_080101_latest_db extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('auth_rule', [
            'name' => $this->string(64)->notNull(),
            'data' => $this->text(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'PRIMARY KEY ([[name]])',
        ], $tableOptions);
        
        $this->createTable('auth_item', [
            'name' => $this->string(64)->notNull(),
            'type' => $this->integer(11)->notNull(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->text(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'PRIMARY KEY ([[name]])',
            'FOREIGN KEY ([[rule_name]]) REFERENCES auth_rule ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        
        $this->createTable('auth_assignment', [
            'item_name' => $this->string(64)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'created_at' => $this->integer(11),
            'PRIMARY KEY ([[item_name]], [[user_id]])',
            'FOREIGN KEY ([[item_name]]) REFERENCES auth_item ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        
        $this->createTable('auth_item_child', [
            'parent' => $this->string(64)->notNull(),
            'child' => $this->string(64)->notNull(),
            'PRIMARY KEY ([[parent]], [[child]])',
            'FOREIGN KEY ([[child]]) REFERENCES auth_item ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        
        $this->createTable('province', [
            'id' => $this->primaryKey(),
            'province' => $this->string(255)->notNull(),
        ], $tableOptions);
        
        $this->createTable('municipality_city', [
            'id' => $this->primaryKey(),
            'municipality_city' => $this->string(255)->notNull(),
            'province_id' => $this->integer(11)->notNull(),
            'FOREIGN KEY ([[province_id]]) REFERENCES province ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        
        $this->createTable('barangay', [
            'id' => $this->primaryKey(),
            'barangay' => $this->string(255)->notNull(),
            'municipality_city_id' => $this->integer(11)->notNull(),
            'FOREIGN KEY ([[municipality_city_id]]) REFERENCES municipality_city ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        
        $this->createTable('borrower', [
            'id' => $this->primaryKey(),
            'profile_pic' => $this->string(255),
            'first_name' => $this->string(255)->notNull(),
            'last_name' => $this->string(255)->notNull(),
            'middle_name' => $this->string(255)->notNull(),
            'suffix' => $this->string(255),
            'birthdate' => $this->date()->notNull(),
            'age' => $this->integer(11)->notNull(),
            'birthplace' => $this->string(255)->notNull(),
            'address_province_id' => $this->integer(11)->notNull(),
            'address_city_municipality_id' => $this->integer(11)->notNull(),
            'address_barangay_id' => $this->integer(11)->notNull(),
            'address_street_house_no' => $this->string(255)->notNull(),
            'civil_status' => $this->string(255)->notNull(),
            'contact_no' => $this->string(255)->notNull(),
            'canvass_date' => $this->date(),
            'tin_no' => $this->string(255),
            'sss_no' => $this->string(255),
            'ctc_no' => $this->string(255),
            'license_no' => $this->string(255),
            'spouse_name' => $this->string(255),
            'spouse_occupation' => $this->string(255),
            'spouse_age' => $this->integer(11),
            'spouse_birthdate' => $this->date(),
            'no_dependent' => $this->integer(11),
            'status' => $this->string(255),
            'branch_id' => $this->integer(11),
            'attachment' => $this->text(),
            'acount_type' => $this->string(255),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'gender' => $this->string(255)->notNull(),
            'mother_name' => $this->string(255),
            'mother_age' => $this->integer(11),
            'mother_birthdate' => $this->date(),
            'father_name' => $this->string(255),
            'father_age' => $this->integer(11),
            'father_birthdate' => $this->date(),
            'canvass_by' => $this->integer(11),
        ], $tableOptions);
        
        $this->createTable('borrower_comaker', [
            'id' => $this->primaryKey(),
            'borrower_id' => $this->integer(11)->notNull(),
            'comaker_id' => $this->integer(11)->notNull(),
            'relationship' => $this->string(255)->notNull(),
        ], $tableOptions);
        
        $this->createTable('borrower_status', [
            'id' => $this->integer(11)->notNull(),
            'status' => $this->string(255),
            'PRIMARY KEY ([[id]])',
        ], $tableOptions);
        
        $this->createTable('branch', [
            'branch_id' => $this->primaryKey(),
            'branch_description' => $this->string(255)->notNull(),
            'address' => $this->string(255)->notNull(),
            'telephone_no' => $this->string(255)->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
        ], $tableOptions);
        
        $this->createTable('business_type', [
            'id' => $this->primaryKey(),
            'business_description' => $this->string(255),
        ], $tableOptions);
        
        $this->createTable('business', [
            'id' => $this->primaryKey(),
            'business_name' => $this->string(255)->notNull(),
            'business_type_id' => $this->integer(11)->notNull(),
            'address_province_id' => $this->integer(11)->notNull(),
            'address_city_municipality_id' => $this->integer(11)->notNull(),
            'address_barangay_id' => $this->integer(11)->notNull(),
            'address_st_bldng_no' => $this->string(255)->notNull(),
            'business_years' => $this->integer(11)->notNull(),
            'permit_no' => $this->string(255)->notNull(),
            'average_weekly_income' => $this->double(255,0)->notNull(),
            'average_gross_daily_income' => $this->double(255,0)->notNull(),
            'ownership' => $this->string(255)->notNull(),
            'borrower_id' => $this->integer(11)->notNull(),
            'FOREIGN KEY ([[business_type_id]]) REFERENCES business_type ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        
        $this->createTable('employee', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(255)->notNull(),
            'last_name' => $this->string(255)->notNull(),
            'middle_name' => $this->string(255),
            'date_birth' => $this->date()->notNull()->defaultValue('0000-00-00'),
            'age' => $this->integer(11),
            'gender' => $this->string(255)->notNull(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ], $tableOptions);
        
        $this->createTable('position', [
            'id' => $this->primaryKey(),
            'position' => $this->string(255)->notNull(),
        ], $tableOptions);
        
        $this->createTable('emposition', [
            'id' => $this->primaryKey(),
            'employee_id' => $this->integer(11)->notNull(),
            'branch_id' => $this->integer(11)->notNull(),
            'position_id' => $this->integer(11),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
            'FOREIGN KEY ([[employee_id]]) REFERENCES employee ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[position_id]]) REFERENCES position ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[branch_id]]) REFERENCES branch ([[branch_id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        
        $this->createTable('unit', [
            'unit_id' => $this->primaryKey(),
            'unit_description' => $this->string(255)->notNull(),
            'branch_id' => $this->integer(11)->notNull(),
            'FOREIGN KEY ([[branch_id]]) REFERENCES branch ([[branch_id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        
        $this->createTable('collectorunit', [
            'id' => $this->primaryKey(),
            'collector_id' => $this->integer(11)->notNull(),
            'unit_id' => $this->integer(11)->notNull(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
            'FOREIGN KEY ([[collector_id]]) REFERENCES emposition ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[unit_id]]) REFERENCES unit ([[unit_id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        
        $this->createTable('comaker', [
            'id' => $this->primaryKey(),
            'profile_pic' => $this->string(255),
            'first_name' => $this->string(255)->notNull(),
            'last_name' => $this->string(255)->notNull(),
            'middle_name' => $this->string(255)->notNull(),
            'suffix' => $this->string(255),
            'birthdate' => $this->date()->notNull(),
            'age' => $this->integer(11)->notNull(),
            'birthplace' => $this->string(255)->notNull(),
            'address_province_id' => $this->integer(11)->notNull(),
            'address_city_municipality_id' => $this->integer(11)->notNull(),
            'address_barangay_id' => $this->integer(11)->notNull(),
            'address_street_house_no' => $this->string(255)->notNull(),
            'civil_status' => $this->string(255)->notNull(),
            'contact_no' => $this->string(255)->notNull(),
            'status' => $this->string(255),
            'branch_id' => $this->integer(11),
            'attachment' => $this->text(),
            'gender' => $this->string(255)->notNull(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->string(255),
            'updated_by' => $this->string(255)->defaultValue(''),
        ], $tableOptions);
        
        $this->createTable('dependent', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'age' => $this->integer(11),
            'birthdate' => $this->date(),
            'borrower_id' => $this->integer(11),
        ], $tableOptions);
        
        $this->createTable('exceltest', [
            'id' => $this->primaryKey(),
            'daily' => $this->float(),
            'term' => $this->integer(11),
            'gross_amt' => $this->float(),
            'interest' => $this->float(),
            'vat' => $this->float(),
            'notarial' => $this->float(),
            'processing_fee' => $this->float(),
            'total_deductions' => $this->float(),
            'add_days' => $this->integer(11),
            'add_coll' => $this->float(),
            'net_proceeds' => $this->float(),
            'penalty' => $this->float(),
            'pen_days' => $this->integer(11),
        ], $tableOptions);
        
        $this->createTable('jumpdate', [
            'jump_id' => $this->primaryKey(),
            'jump_date' => $this->date()->notNull(),
            'jump_description' => $this->string(255)->notNull(),
        ], $tableOptions);
        
        $this->createTable('loan_type', [
            'loan_id' => $this->primaryKey(),
            'loan_description' => $this->string(255)->notNull(),
        ], $tableOptions);
        
        $this->createTable('loan', [
            'id' => $this->primaryKey(),
            'loan_no' => $this->string(50)->notNull(),
            'loan_type' => $this->integer(11)->notNull(),
            'borrower' => $this->integer(11)->notNull(),
            'unit' => $this->integer(11)->notNull(),
            'release_date' => $this->date()->notNull(),
            'maturity_date' => $this->date()->notNull(),
            'daily' => $this->integer(11)->notNull(),
            'term' => $this->integer(11)->notNull(),
            'gross_amount' => $this->float()->notNull(),
            'interest_bdays' => $this->float()->notNull(),
            'gas' => $this->float()->notNull(),
            'doc_stamp' => $this->float()->notNull(),
            'misc' => $this->float()->notNull(),
            'admin_fee' => $this->float()->notNull(),
            'notarial_fee' => $this->float()->notNull(),
            'additional_fee' => $this->float()->notNull(),
            'total_deductions' => $this->float()->notNull(),
            'add_days' => $this->integer(11)->notNull(),
            'add_coll' => $this->float()->notNull(),
            'net_proceeds' => $this->float()->notNull(),
            'penalty' => $this->float()->notNull(),
            'penalty_days' => $this->integer(11),
            'collaterals' => $this->string(255)->notNull(),
            'ci_officer' => $this->integer(11)->notNull(),
            'ci_date' => $this->date()->notNull(),
            'status' => $this->string(255),
            'date_waive' => $this->date(),
            'date_po' => $this->date(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->string(255),
            'updated_by' => $this->string(255),
            'FOREIGN KEY ([[loan_type]]) REFERENCES loan_type ([[loan_id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[unit]]) REFERENCES unit ([[unit_id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        
        $this->createTable('loan_comaker', [
            'id' => $this->primaryKey(),
            'loan_id' => $this->integer(11)->notNull(),
            'comaker_id' => $this->integer(11)->notNull(),
        ], $tableOptions);
        
        $this->createTable('loanscheme', [
            'id' => $this->primaryKey(),
            'loanscheme_name' => $this->string(100)->notNull(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->string(255),
            'updated_by' => $this->string(255),
        ], $tableOptions);
        
        $this->createTable('loanscheme_assignment', [
            'id' => $this->primaryKey(),
            'loanscheme_id' => $this->integer(11)->notNull(),
            'branch_id' => $this->integer(11)->notNull(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->string(255),
            'updated_by' => $this->string(255),
            'FOREIGN KEY ([[branch_id]]) REFERENCES branch ([[branch_id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[loanscheme_id]]) REFERENCES loanscheme ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        
        $this->createTable('loanscheme_values', [
            'id' => $this->primaryKey(),
            'loanscheme_id' => $this->integer(11)->notNull(),
            'daily' => $this->float()->notNull(),
            'term' => $this->integer(11)->notNull(),
            'gross_amt' => $this->float()->notNull(),
            'interest' => $this->float()->notNull(),
            'vat' => $this->float()->notNull(),
            'admin_fee' => $this->float()->notNull(),
            'notary_fee' => $this->float()->notNull(),
            'misc' => $this->float()->notNull(),
            'doc_stamp' => $this->float()->notNull(),
            'gas' => $this->float()->notNull(),
            'total_deductions' => $this->float()->notNull(),
            'add_days' => $this->integer(11)->notNull(),
            'add_coll' => $this->float()->notNull(),
            'net_proceeds' => $this->float()->notNull(),
            'penalty' => $this->float()->notNull(),
            'pen_days' => $this->integer(11)->notNull(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->string(255),
            'updated_by' => $this->string(255),
            'FOREIGN KEY ([[loanscheme_id]]) REFERENCES loanscheme ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
        
        $this->createTable('log', [
            'id' => $this->primaryKey(),
            'log_type' => $this->string(255),
            'log_description' => $this->string(255),
            'log_date' => $this->datetime(),
            'user_id' => $this->integer(11),
            'branch_id' => $this->integer(11),
        ], $tableOptions);
        
        $this->createTable('migration', [
            'version' => $this->string(180)->notNull(),
            'apply_time' => $this->integer(11),
            'PRIMARY KEY ([[version]])',
        ], $tableOptions);
        
        $this->createTable('money', [
            'id' => $this->primaryKey(),
            'branch_id' => $this->integer(11)->notNull(),
            'unit_id' => $this->integer(11)->notNull(),
            'money_1000' => $this->float(20,2)->notNull(),
            'total_1000' => $this->float(20,2)->notNull(),
            'money_500' => $this->float(20,2)->notNull(),
            'total_500' => $this->float(20,2)->notNull(),
            'money_200' => $this->float(20,2)->notNull(),
            'total_200' => $this->float(20,2)->notNull(),
            'money_100' => $this->float(20,2)->notNull(),
            'total_100' => $this->float(20,2)->notNull(),
            'money_50' => $this->float(20,2)->notNull(),
            'total_50' => $this->float(20,2)->notNull(),
            'money_20' => $this->float(20,2)->notNull(),
            'total_20' => $this->float(20,2)->notNull(),
            'money_coin' => $this->float(20,2)->notNull(),
            'money_bill' => $this->float(20,2),
            'money_total_amount' => $this->float(20,2)->notNull(),
            'collection_date' => $this->date()->notNull(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->string(255),
            'updated_by' => $this->string(255),
        ], $tableOptions);
        
        $this->createTable('payment', [
            'id' => $this->primaryKey(),
            'loan_id' => $this->integer(11)->notNull(),
            'pay_amount' => $this->float(255,2)->notNull(),
            'pay_date' => $this->date()->notNull(),
            'money_id' => $this->integer(11)->notNull(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->string(255),
            'updated_by' => $this->string(255),
        ], $tableOptions);
        
        $this->createTable('status', [
            'code' => $this->string(255)->notNull(),
            'status' => $this->string(255)->notNull(),
            'PRIMARY KEY ([[code]])',
        ], $tableOptions);
        
        $this->createTable('tag', [
            'tag_id' => $this->primaryKey(),
            'borrower' => $this->integer(11),
            'tag_description' => $this->string(255),
        ], $tableOptions);
        
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'password_reset_token' => $this->string(255),
            'email' => $this->string(255)->notNull(),
            'status' => $this->smallInteger(6)->defaultValue(10),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'branch_id' => $this->integer(11)->notNull(),
            'firstname' => $this->string(255)->notNull(),
            'lastname' => $this->string(255)->notNull(),
            'middlename' => $this->string(255)->notNull(),
            'birthdate' => $this->date()->notNull(),
            'age' => $this->integer(11)->notNull(),
            'civil_status' => $this->string(255)->notNull(),
            'gender' => $this->string(255)->notNull(),
            'home_address' => $this->string(255)->notNull(),
            'sss_no' => $this->string(255),
            'philhealth_no' => $this->string(255),
            'tin_no' => $this->string(255),
            'contact_no' => $this->string(255)->notNull(),
            'picture' => $this->string(255),
            'temp_pass' => $this->string(255),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('user');
        $this->dropTable('tag');
        $this->dropTable('status');
        $this->dropTable('payment');
        $this->dropTable('money');
        $this->dropTable('migration');
        $this->dropTable('log');
        $this->dropTable('loanscheme_values');
        $this->dropTable('loanscheme_assignment');
        $this->dropTable('loanscheme');
        $this->dropTable('loan_comaker');
        $this->dropTable('loan');
        $this->dropTable('loan_type');
        $this->dropTable('jumpdate');
        $this->dropTable('exceltest');
        $this->dropTable('dependent');
        $this->dropTable('comaker');
        $this->dropTable('collectorunit');
        $this->dropTable('unit');
        $this->dropTable('emposition');
        $this->dropTable('position');
        $this->dropTable('employee');
        $this->dropTable('business');
        $this->dropTable('business_type');
        $this->dropTable('branch');
        $this->dropTable('borrower_status');
        $this->dropTable('borrower_comaker');
        $this->dropTable('borrower');
        $this->dropTable('barangay');
        $this->dropTable('municipality_city');
        $this->dropTable('province');
        $this->dropTable('auth_item_child');
        $this->dropTable('auth_assignment');
        $this->dropTable('auth_item');
        $this->dropTable('auth_rule');
    }
}
