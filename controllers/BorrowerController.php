<?php

namespace app\controllers;

use Yii;
use app\models\Model;
use app\models\Log;
use app\models\Borrower;
use app\models\Barangay;
use app\models\Business;
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
                        'actions' => ['ciapprovalnew', 'renewapplicant', 'removerenewal', 'removenew', 'sfr', 'deniedcicanvass', 'approvedcicanvass', 'index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new', 'getmunicipalitycity', 'getbarangay'],
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
        if (Yii::$app->user->can('ORGANIZER')) {
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

    public function actionSfr() {
        if (Yii::$app->user->can('ORGANIZER')) {
            $searchModel = new BorrowerSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('scheduleforreleasing', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            throw new \yii\web\UnauthorizedHttpException();
        }
    }

    public function actionRemovenew($id) {
        $borrower = Borrower::findOne($id);
        $borrower->delete();
        Yii::$app->session->setFlash('borrower_new_delete', "Deleted Successfully!");
        return $this->redirect(['site/newapplicants']);
    }

    public function actionRemoverenewal($id) {
        Yii::$app->db->createCommand()->update('borrower', ['status' => 'AR'], 'id = :id')->bindValue(':id', $id)->execute();
        Yii::$app->session->setFlash('borrower_renewal_remove', "Renewal Remove Successfully!");
        return $this->redirect(['site/newapplicants']);
    }

    public function actionRenewapplicant() {
        $borrowers = Yii::$app->request->post('borrowers');
        foreach ($borrowers as $borrower) {
            Yii::$app->db->createCommand()->update('borrower', ['status' => 'RN'], 'id = :id')->bindValue(':id', $borrower)->execute();
        }
        Yii::$app->session->setFlash('borrower_renewal_added', "Renewal Added Successfully!");
        return $this->redirect(['site/newapplicants']);
    }

    /**
     * Displays a single Borrower model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        if (Yii::$app->user->can('ORGANIZER')) {
            $borrower = $this->findModel($id);
            $dependents = Dependent::find()->where(['borrower_id' => $id])->indexBy('id')->all();
            $business = Business::findOne(['borrower_id' => $id]);

            return $this->render('view', [
                        'borrower' => $borrower,
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
        if (Yii::$app->user->can('ORGANIZER')) {
            $borrower = new Borrower();
            $update = false;
            $dependent = new Dependent;
            $business = new Business();

            //get canvasser
            if (Yii::$app->user->identity->branch->branch_description === 'MAIN') {
                $canvassers = Yii::$app->db->createCommand("SELECT\n" .
                                "employee.id,\n" .
                                "CONCAT(employee.last_name,', ',employee.first_name,' ',employee.middle_name) as fullname,\n" .
                                "position.position\n" .
                                "FROM\n" .
                                "employee\n" .
                                "INNER JOIN emposition ON emposition.employee_id = employee.id\n" .
                                "INNER JOIN position ON emposition.position_id = position.id\n" .
                                "WHERE\n" .
                                "emposition.branch_id = :branch_id AND\n" .
                                "position.position = 'canvasser'")->bindValue(':branch_id', Yii::$app->user->identity->branch_id)->queryAll();
            } else {
                $canvassers = Yii::$app->db->createCommand("SELECT\n" .
                                "employee.id,\n" .
                                "CONCAT(employee.last_name,', ',employee.first_name,' ',employee.middle_name) as fullname,\n" .
                                "position.position\n" .
                                "FROM\n" .
                                "employee\n" .
                                "INNER JOIN emposition ON emposition.employee_id = employee.id\n" .
                                "INNER JOIN position ON emposition.position_id = position.id\n" .
                                "WHERE\n" .
                                "position.position = 'canvasser'")->queryAll();
            }


            // use for ajax validation
            if (Yii::$app->request->isAjax && $borrower->load(Yii::$app->request->post())) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($borrower);
            }

            if ($borrower->loadAll(Yii::$app->request->post()) && $business->loadAll(Yii::$app->request->post())) {

                //get the instance of borrower_pic and comaker_pic
                $borrower->borrower_pic = UploadedFile::getInstance($borrower, 'borrower_pic');
                $borrower->attachfiles = UploadedFile::getInstances($borrower, 'attachfiles');

                // set the url of the picture for saving    
                if (!empty($borrower->borrower_pic)) {
                    $borrower->setPicUrl();
                }

                if (!empty($borrower->attachfiles)) {
                    $borrower->setAttachUrls();
                }

                // set the account type of borrower and comaker
                $borrower->acount_type = Borrower::ACCOUNT_TYPE1;

                // set status
                $borrower->status = Borrower::CANVASSED;

                // set branch
                if (!(isset($borrower->branch_id))) {
                    $borrower->branch_id = Yii::$app->user->identity->branch_id;
                }

                //calculate age
                $borrower->age = $borrower->calculateAge($borrower->birthdate);
                $borrower->spouse_age = $borrower->calculateAge($borrower->spouse_birthdate);
                $borrower->mother_age = $borrower->calculateAge($borrower->mother_birthdate);
                $borrower->father_age = $borrower->calculateAge($borrower->father_birthdate);

                // format all string using ucwords()
                $borrower->birthplace = ucwords($borrower->birthplace);
                $borrower->spouse_name = ucwords($borrower->spouse_name);
                $borrower->spouse_occupation = ucwords($borrower->spouse_occupation);
                $borrower->address_street_house_no = ucwords($borrower->address_street_house_no);
                $borrower->first_name = ucwords($borrower->first_name);
                $borrower->last_name = ucwords($borrower->last_name);
                $borrower->middle_name = ucwords($borrower->middle_name);
                $borrower->father_name = ucwords($borrower->father_name);
                $borrower->mother_name = ucwords($borrower->mother_name);
                $business->business_name = ucwords($business->business_name);
                $business->address_st_bldng_no = ucwords($business->address_st_bldng_no);

                if ($borrower->saveAll()) {

                    // log action
                    $log = new Log();
                    $description = "borrower created: " . $borrower->id;
                    $log->logMe(Log::CREATE, $description);

                    $business->borrower_id = $borrower->id;
                    $business->save();

                    if (!empty($borrower->borrower_pic)) {
                        $borrower->upload();
                    }
                    if (!empty($borrower->attachfiles)) {
                        $borrower->uploadAttachFiles();
                    }
                    $dependents = Model::createMultiple(Dependent::classname());
                    if (Model::loadMultiple($dependents, Yii::$app->request->post()) && Model::validateMultiple($dependents)) {
                        foreach ($dependents as $dependent) {
                            $dependent->borrower_id = $borrower->id;
                            $dependent->name = ucwords($dependent->name);
                            if (!empty($dependent->name)) {
                                $dependent->age = $dependent->calculateAge($dependent->birthdate);
                                $dependent->save(false);
                            }
                        }
                    }
                    return $this->redirect(['view', 'id' => $borrower->id]);
                } else {
                    return $this->render('create', [
                                'borrower' => $borrower,
                                'dependent' => $dependent,
                                'update' => $update,
                                'business' => $business,
                                'canvassers' => $canvassers,
                    ]);
                }
            } else {
                return $this->render('create', [
                            'borrower' => $borrower,
                            'dependent' => $dependent,
                            'update' => $update,
                            'business' => $business,
                            'canvassers' => $canvassers,
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

            //get canvasser
            if (Yii::$app->user->identity->branch->branch_description === 'MAIN') {
                $canvassers = Yii::$app->db->createCommand("SELECT\n" .
                                "employee.id,\n" .
                                "CONCAT(employee.last_name,', ',employee.first_name,' ',employee.middle_name) as fullname,\n" .
                                "position.position\n" .
                                "FROM\n" .
                                "employee\n" .
                                "INNER JOIN emposition ON emposition.employee_id = employee.id\n" .
                                "INNER JOIN position ON emposition.position_id = position.id\n" .
                                "WHERE\n" .
                                "emposition.branch_id = :branch_id AND\n" .
                                "position.position = 'canvasser'")->bindValue(':branch_id', Yii::$app->user->identity->branch_id)->queryAll();
            } else {
                $canvassers = Yii::$app->db->createCommand("SELECT\n" .
                                "employee.id,\n" .
                                "CONCAT(employee.last_name,', ',employee.first_name,' ',employee.middle_name) as fullname,\n" .
                                "position.position\n" .
                                "FROM\n" .
                                "employee\n" .
                                "INNER JOIN emposition ON emposition.employee_id = employee.id\n" .
                                "INNER JOIN position ON emposition.position_id = position.id\n" .
                                "WHERE\n" .
                                "position.position = 'canvasser'")->queryAll();
            }

            $update = true;
            if (Yii::$app->request->post('_asnew') == '1') {
                $borrower = new Borrower();
            } else {
                $borrower = $this->findModel($id);
                $dependents = Dependent::find()->where(['borrower_id' => $id])->indexBy('id')->all();
                $business = Business::findOne(['borrower_id' => $id]);
            }

            // use for ajax validation
            if (Yii::$app->request->isAjax && $borrower->load(Yii::$app->request->post())) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($borrower);
            }

            if ($borrower->loadAll(Yii::$app->request->post()) && $business->loadAll(Yii::$app->request->post())) {

                //get the instance of borrower_pic and comaker_pic
                $borrower->borrower_pic = UploadedFile::getInstance($borrower, 'borrower_pic');
                $borrower->attachfiles = UploadedFile::getInstances($borrower, 'attachfiles');

                // set the url of the picture for saving
                if (!empty($borrower->borrower_pic)) {
                    $borrower->setPicUrl();
                }
                if (!empty($borrower->attachfiles)) {
                    $borrower->setAttachUrls();
                }

                // format all string using ucwords()
                $borrower->birthplace = ucwords($borrower->birthplace);
                $borrower->spouse_name = ucwords($borrower->spouse_name);
                $borrower->spouse_occupation = ucwords($borrower->spouse_occupation);
                $borrower->address_street_house_no = ucwords($borrower->address_street_house_no);
                $borrower->first_name = ucwords($borrower->first_name);
                $borrower->last_name = ucwords($borrower->last_name);
                $borrower->middle_name = ucwords($borrower->middle_name);
                $borrower->father_name = ucwords($borrower->father_name);
                $borrower->mother_name = ucwords($borrower->mother_name);
                $business->business_name = ucwords($business->business_name);
                $business->address_st_bldng_no = ucwords($business->address_st_bldng_no);


                //calculate age
                $borrower->age = $borrower->calculateAge($borrower->birthdate);
                $borrower->spouse_age = $borrower->calculateAge($borrower->spouse_birthdate);
                $borrower->mother_age = $borrower->calculateAge($borrower->mother_birthdate);
                $borrower->father_age = $borrower->calculateAge($borrower->father_birthdate);

                if ($borrower->saveAll()) {

                    // log action
                    $log = new Log();
                    $description = "borrower updated: " . $borrower->id;
                    $log->logMe(Log::UPDATE, $description);


                    // update business
                    $business->save();

                    if (!empty($borrower->borrower_pic)) {
                        $borrower->upload();
                    }
                    if (!empty($borrower->attachfiles)) {
                        $borrower->uploadAttachFiles();
                    }

                    if (Model::loadMultiple($dependents, Yii::$app->request->post()) && Model::validateMultiple($dependents)) {
                        foreach ($dependents as $dependent) {
                            $dependent->borrower_id = $borrower->id;
                            if (!empty($dependent->name)) {
                                $dependent->age = $dependent->calculateAge($dependent->birthdate);
                                $dependent->save(false);
                            }
                        }
                    }
                    return $this->redirect(['view', 'id' => $borrower->id]);
                }
            } else {
                return $this->render('update', [
                            'borrower' => $borrower,
                            'dependents' => (empty($dependents)) ? [new Dependent] : $dependents,
                            'update' => $update,
                            'business' => $business,
                            'canvassers' => $canvassers,
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

    public function actionApprovedcicanvass($id) {
        Yii::$app->db->createCommand()->update('borrower', ['status' => \app\models\Borrower::CI_APPROVED], "id = $id")->execute();
        return $this->redirect(['site/cicanvassapproval']);
    }

    public function actionCiapprovalnew($id) {
        $borrower = Borrower::findOne($id);
        $dependent = new Dependent();
        $business = new Business();
        return $this->render('ciapprovalnew', [
                    'borrower' => $borrower,
                    'dependent' => $dependent,
                    'business' => $business,
        ]);
    }

    public function actionDeniedcicanvass($id) {
        Yii::$app->db->createCommand()->update('borrower', ['status' => \app\models\Borrower::CI_DENIED], "id = $id")->execute();
        return $this->redirect(['site/cicanvassapproval']);
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
