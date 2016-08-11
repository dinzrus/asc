<?php

namespace app\controllers;

use Yii;
use app\models\Model;
use app\models\Borrower;
use app\models\Comaker;
use app\models\BorrowerComaker;
use app\models\Dependent;
use app\models\BorrowerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BorrowerController implements the CRUD actions for Borrower model.
 */
class BorrowerController extends Controller {

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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new', 'addresscitymunicipality'],
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
     * Lists all Borrower models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BorrowerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Borrower model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Borrower model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $borrower = new Borrower();
        $comaker = new Comaker();
        $update = false;
        $dependent = new Dependent;
        $borrowwer_comaker_ids = new BorrowerComaker();

        if ($borrower->loadAll(Yii::$app->request->post()) && $comaker->loadAll(Yii::$app->request->post())) {

            //get the instance of borrower_pic and comaker_pic
            $borrower->borrower_pic = UploadedFile::getInstance($borrower, 'borrower_pic');
            $comaker->comaker_pic = UploadedFile::getInstance($comaker, 'comaker_pic');
            $borrower->attachfiles = UploadedFile::getInstances($borrower, 'attachfiles');

            // set the url of the picture for saving
            $borrower->setPicUrl();
            $comaker->setPicUrl();
            $borrower->setAttachUrls();

            if ($borrower->saveAll() && $comaker->saveAll() && $borrower->upload() && $comaker->upload()) {

                //save the id of borrower and comaker to borrower_comaker table
                $borrowwer_comaker_ids->borrower_id = $borrower->id;
                $borrowwer_comaker_ids->comaker_id = $comaker->id;
                $borrowwer_comaker_ids->save(false);

                $dependents = Model::createMultiple(Dependent::classname());
                if (Model::loadMultiple($dependents, Yii::$app->request->post()) && Model::validateMultiple($dependents)) {
                    foreach ($dependents as $dependent) {
                        $dependent->borrower_id = $borrower->id;
                        if (!empty($dependent->name)) {
                            $dependent->save(false);
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $borrower->id]);
            }
        } else {
            return $this->render('create', [
                        'borrower' => $borrower,
                        'comaker' => $comaker,
                        'dependent' => $dependent,
                        'update' => $update,
            ]);
        }
    }

    /**
     * Updates an existing Borrower model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $update = true;
        if (Yii::$app->request->post('_asnew') == '1') {
            $borrower = new Borrower();
        } else {
            $borrower = $this->findModel($id);
            $comaker_id = BorrowerComaker::findOne(['borrower_id' => $id]);
            $comaker = Comaker::findOne(['id' => $comaker_id->comaker_id]);
            $dependents = Dependent::find()->where(['borrower_id' => $id])->indexBy('id')->all();
        }

        if ($borrower->load(Yii::$app->request->post()) && $comaker->load(Yii::$app->request->post()) && $borrower->save() && $comaker->save()) {

            //$dependents = Model::createMultiple(Dependent::classname());
            if (Model::loadMultiple($dependents, Yii::$app->request->post()) && Model::validateMultiple($dependents)) {
                //save all
                foreach ($dependents as $dependent) {
                    $dependent->borrower_id = $borrower->id;
                    if (!empty($dependent->name)) {
                        $dependent->save(false);
                    }
                }
            }
            return $this->redirect(['view', 'id' => $borrower->id]);
        } else {
            return $this->render('update', [
                        'borrower' => $borrower,
                        'comaker' => $comaker,
                        'dependents' => (empty($dependents)) ? [new Dependent] : $dependents,
                        'update' => $update,
            ]);
        }
    }

    /**
     * Deletes an existing Borrower model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    /**
     * 
     * Export Borrower information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    /**
     * Creates a new Borrower model by another data,
     * so user don't need to input all field from scratch.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param type $id
     * @return type
     */
    public function actionSaveAsNew($id) {
        $model = new Borrower();

        if (Yii::$app->request->post('_asnew') != '1') {
            $model = $this->findModel($id);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('saveAsNew', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Borrower model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Borrower the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Borrower::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // dependent address actions
    public function actionAddresscitymunicipality() {
        $out = [];
        if (isset($_POST['Borrower'])) {
            $province = $_POST['Borrower'];
            if ($province != null) {
                $out = self::getAddresscitymunicipality($province['address_province_id']);
                echo Json::encode(['out' => $out, 'select' => '']);
                return;
            }
        }
    }

    public static function getAddresscitymunicipality($province_id) {
        $citymunicipality = \app\models\base\MunicipalityCity::find()
                ->where(['province_id' => $province_id])
                ->orderBy('id')
                ->all();
        return $citymunicipality;
    }

}
