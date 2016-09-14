<?php

namespace app\controllers;

use Yii;
use app\models\Loanscheme;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LoanschemeController implements the CRUD actions for Loanscheme model.
 */
class LoanschemeController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'add-loanscheme-assignment', 'add-loanscheme-values'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Loanscheme models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Loanscheme::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Loanscheme model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $providerLoanschemeAssignment = new \yii\data\ArrayDataProvider([
            'allModels' => $model->loanschemeAssignments,
        ]);
        $providerLoanschemeValues = new \yii\data\ArrayDataProvider([
            'allModels' => $model->loanschemeValues,
        ]);
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'providerLoanschemeAssignment' => $providerLoanschemeAssignment,
                    'providerLoanschemeValues' => $providerLoanschemeValues,
        ]);
    }

    /**
     * Creates a new Loanscheme model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Loanscheme();
        $loandata = new \app\models\LoanschemeValues();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            $loandata->excelfile = UploadedFile::getInstance($model, 'excelfile');
            if ($loandata->upload()) {
                // file is uploaded successfully
                $inputFile = $loandata->pathname;
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

                    $loan = New \app\models\LoanschemeValues();

                    $$loan->loanscheme_id = $model->id;
                    $$loan->daily = $rowData[0][0];
                    $$loan->term = $rowData[0][1];
                    $$loan->gross_amt = $rowData[0][2];
                    $$loan->interest = $rowData[0][3];
                    $$loan->vat = $rowData[0][4];
                    $$loan->admin_fee = $rowData[0][5];
                    $$loan->notary_fee = $rowData[0][6];
                    $$loan->misc = $rowData[0][7];
                    $$loan->doc_stamp = $rowData[0][8];
                    $$loan->gas = $rowData[0][9];
                    $$loan->total_deductions = $rowData[0][10];
                    $$loan->add_days = $rowData[0][11];
                    $$loan->add_coll = $rowData[0][12];
                    $$loan->net_proceeds = $rowData[0][13];
                    $$loan->penalty = $rowData[0][14];
                    $$loan->pen_days = $rowData[0][15];

                    if (!($$loan->save())) { // use to skip empty rows
                        continue;
                    }

                    print_r($$loan->getErrors());
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'loandata' => $loandata,
            ]);
        }
    }

    /**
     * Updates an existing Loanscheme model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Loanscheme model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Loanscheme model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Loanscheme the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Loanscheme::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Action to load a tabular form grid
     * for LoanschemeAssignment
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddLoanschemeAssignment() {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('LoanschemeAssignment');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formLoanschemeAssignment', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Action to load a tabular form grid
     * for LoanschemeValues
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddLoanschemeValues() {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('LoanschemeValues');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formLoanschemeValues', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
