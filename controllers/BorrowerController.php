<?php

namespace app\controllers;

use Yii;
use app\models\Model;
use app\models\Log;
use app\models\Borrower;
use app\models\Comaker;
use app\models\Barangay;
use app\models\Business;
use app\models\BorrowerComaker;
use app\models\Dependent;
use app\models\BorrowerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use app\models\MunicipalityCity;

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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new', 'getmunicipalitycity', 'getbarangay'],
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
        if (Yii::$app->user->can('organizer')) {
            $searchModel = new BorrowerSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            throw new \yii\web\UnauthorizedHttpException();
        }
    }

    /**
     * Displays a single Borrower model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        if (Yii::$app->user->can('organizer')) {
            $borrower = $this->findModel($id);
            $comaker_id = BorrowerComaker::findOne(['borrower_id' => $id]);
            $comaker = Comaker::findOne(['id' => $comaker_id->comaker_id]);
            $dependents = Dependent::find()->where(['borrower_id' => $id])->indexBy('id')->all();
            $business = Business::findOne(['borrower_id' => $id]);

            return $this->render('view', [
                        'borrower' => $borrower,
                        'comaker' => $comaker,
                        'dependents' => $dependents,
                        'business' => $business,
            ]);
        } else {
            throw new \yii\web\UnauthorizedHttpException();
        }
    }

    /**
     * Creates a new Borrower model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->can('organizer')) {
            $borrower = new Borrower();
            $comaker = new Comaker();
            $update = false;
            $dependent = new Dependent;
            $borrower_comaker = new BorrowerComaker();
            $business = new Business();

            // use for ajax validation
            if (Yii::$app->request->isAjax && $borrower->load(Yii::$app->request->post())) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($borrower);
            }

            if ($borrower->loadAll(Yii::$app->request->post()) && $comaker->loadAll(Yii::$app->request->post()) && $borrower_comaker->loadAll(Yii::$app->request->post()) && $business->loadAll(Yii::$app->request->post())) {

                //get the instance of borrower_pic and comaker_pic
                $borrower->borrower_pic = UploadedFile::getInstance($borrower, 'borrower_pic');
                $comaker->comaker_pic = UploadedFile::getInstance($comaker, 'comaker_pic');
                $borrower->attachfiles = UploadedFile::getInstances($borrower, 'attachfiles');

                // set the url of the picture for saving
                // set the url of the picture for saving    
                if (!empty($borrower->borrower_pic)) {
                    $borrower->setPicUrl();
                }
                if (!empty($comaker->comaker_pic)) {
                    $comaker->setPicUrl();
                }
                if (!empty($borrower->attachfiles)) {
                    $borrower->setAttachUrls();
                }

                // set the account type of borrower and comaker
                $borrower->acount_type = Borrower::ACCOUNT_TYPE1;
                $comaker->acount_type = Borrower::ACCOUNT_TYPE2;
                
                // set status
                $borrower->status = Borrower::CANVASSED;
                
                // set branch
                $borrower->branch_id = Yii::$app->user->identity->branch_id;

                if ($borrower->saveAll() && $comaker->saveAll()) {

                    // log action
                    $log = new Log();
                    $description = "borrower created: " . $borrower->id;
                    $log->logMe(Log::CREATE, $description);

                    //save the id of borrower and comaker to borrower_comaker table
                    $borrower_comaker->borrower_id = $borrower->id;
                    $borrower_comaker->comaker_id = $comaker->id;
                    $borrower_comaker->saveAll();

                    $business->borrower_id = $borrower->id;
                    $business->saveAll();

                    if (!empty($borrower->borrower_pic)) {
                        $borrower->upload();
                    }
                    if (!empty($comaker->comaker_pic)) {
                        $comaker->upload();
                    }
                    if (!empty($borrower->attachfiles)) {
                        $borrower->uploadAttachFiles();
                    }
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
                } else {
                    return $this->render('create', [
                                'borrower' => $borrower,
                                'comaker' => $comaker,
                                'dependent' => $dependent,
                                'update' => $update,
                                'borrower_comaker' => $borrower_comaker,
                                'business' => $business,
                    ]);
                }
            } else {
                return $this->render('create', [
                            'borrower' => $borrower,
                            'comaker' => $comaker,
                            'dependent' => $dependent,
                            'update' => $update,
                            'borrower_comaker' => $borrower_comaker,
                            'business' => $business,
                ]);
            }
        } else {
            throw new \yii\web\UnauthorizedHttpException();
        }
    }

    /**
     * Updates an existing Borrower model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        if (Yii::$app->user->can('IT')) {
            $update = true;
            if (Yii::$app->request->post('_asnew') == '1') {
                $borrower = new Borrower();
            } else {
                $borrower = $this->findModel($id);
                $borrower_comaker = BorrowerComaker::findOne(['borrower_id' => $id]);
                $comaker = Comaker::findOne(['id' => $borrower_comaker->comaker_id]);
                $dependents = Dependent::find()->where(['borrower_id' => $id])->indexBy('id')->all();
                $business = Business::findOne(['borrower_id' => $id]);
            }

            // use for ajax validation
            if (Yii::$app->request->isAjax && $borrower->load(Yii::$app->request->post())) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($borrower);
            }

            if ($borrower->loadAll(Yii::$app->request->post()) && $comaker->loadAll(Yii::$app->request->post()) && $borrower_comaker->loadAll(Yii::$app->request->post()) && $business->loadAll(Yii::$app->request->post())) {

                //get the instance of borrower_pic and comaker_pic
                $borrower->borrower_pic = UploadedFile::getInstance($borrower, 'borrower_pic');
                $comaker->comaker_pic = UploadedFile::getInstance($comaker, 'comaker_pic');
                $borrower->attachfiles = UploadedFile::getInstances($borrower, 'attachfiles');

                // set the url of the picture for saving
                if (!empty($borrower->borrower_pic)) {
                    $borrower->setPicUrl();
                }
                if (!empty($comaker->comaker_pic)) {
                    $comaker->setPicUrl();
                }
                if (!empty($borrower->attachfiles)) {
                    $borrower->setAttachUrls();
                }

                if ($borrower->saveAll() && $comaker->saveAll() && $borrower_comaker->saveAll()) {

                    // log action
                    $log = new Log();
                    $description = "borrower updated: " . $borrower->id;
                    $log->logMe(Log::UPDATE, $description);

                    if (!empty($borrower->borrower_pic)) {
                        $borrower->upload();
                    }
                    if (!empty($comaker->comaker_pic)) {
                        $comaker->upload();
                    }
                    if (!empty($borrower->attachfiles)) {
                        $borrower->uploadAttachFiles();
                    }

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
                return $this->render('update', [
                            'borrower' => $borrower,
                            'comaker' => $comaker,
                            'dependents' => (empty($dependents)) ? [new Dependent] : $dependents,
                            'update' => $update,
                            'borrower_comaker' => $borrower_comaker,
                            'business' => $business,
                ]);
            }
        } else {
            throw new \yii\web\UnauthorizedHttpException();
        }
    }

    /**
     * Deletes an existing Borrower model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        if (Yii::$app->user->can('IT')) {
            $this->findModel($id)->deleteWithRelated();
            
            // log action
            $log = new Log();
            $description = "borrower deleted: " . $id;
            $log->logMe(Log::DELETE, $description);

            return $this->redirect(['index']);
        } else {
            throw new \yii\web\UnauthorizedHttpException();
        }
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

    /**
     * Dedrop callback functions
     */
    public function actionGetmunicipalitycity() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $list = MunicipalityCity::find()->andWhere(['province_id' => $cat_id])->asArray()->all();
                $selected = null;
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['id'], 'name' => $account['municipality_city']];
                    if ($i == 0) {
                        $selected = $account['id'];
                    }
                }
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetbarangay() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $list = Barangay::find()->andWhere(['municipality_city_id' => $cat_id])->asArray()->all();
                $selected = null;
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['id'], 'name' => $account['barangay']];
                    if ($i == 0) {
                        $selected = $account['id'];
                    }
                }
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

}
