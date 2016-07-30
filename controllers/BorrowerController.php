<?php

namespace app\controllers;

use Yii;
use app\models\Borrower;
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
            throw new \yii\web\UnauthorizedHttpException("You are not allowed to do this action!");
        }
    }

    /**
     * Displays a single Borrower model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        if (Yii::$app->user->can('organizer')) {
            $model = $this->findModel($id);
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new \yii\web\UnauthorizedHttpException("You are not allowed to do this action!");
        }
    }

    /**
     * Creates a new Borrower model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->can('organizer')) {
            $model = new Borrower();

            // if user branch is main the value of branch will be based on the form values
            if (!(Yii::$app->user->identity->branch_id == 9)) {
                $model->branch = Yii::$app->user->identity->branch_id;
            }

            if ($model->loadAll(Yii::$app->request->post())) {

                // get the instances of the two profile pic
                $model->principal_pic = UploadedFile::getInstance($model, 'principal_pic');
                $model->second_signatory_pic = UploadedFile::getInstance($model, 'second_signatory_pic');

                //get the instances of the attachfile
                $model->attachfiles = UploadedFile::getInstances($model, 'attachfiles');
                $attachnames = "";

                $attachcount = count($model->attachfiles);
                if ($attachcount > 0) {
                    for ($i = 0; $i < $attachcount; $i++) {
                        $attachmentobject = $model->attachfiles[$i];
                        $tpname = $model->principal_last_name . '-' . $model->principal_first_name . $model->borrower_id . '-attachment' . $i . '.' . $attachmentobject->extension;
                        $attachnames = $attachnames . ' ' . 'fileupload/' . $tpname;
                    }
                    $model->attachments = trim($attachnames);
                }

                //get the instances of the attachfile
                $model->attachfiles = UploadedFile::getInstances($model, 'attachfiles');

                //$model->attachments = $model->attachfiles->name; // temp lang ni.. for testing
                //check if principal_pic is not empty and save photo url
                if (!empty($model->principal_pic)) {
                    $principal_name = $model->principal_first_name . $model->principal_last_name; // get the first and last name of principal applicant
                    $model->principal_profile_pic = 'fileupload/' . $principal_name . '.' . $model->principal_pic->extension;
                }

                //check if second_signatory_pic is not empty and save photo url
                if (!empty($model->second_signatory_pic)) {
                    $secondsig_name = $model->comaker_name; // get name of the second signatory
                    $model->comaker_profile_pic = 'fileupload/' . $secondsig_name . '.' . $model->second_signatory_pic->extension;
                }

                if ($model->saveAll()) {
                    //upload pic if principal photo is not empty
                    if (!empty($model->principal_pic)) {
                        $model->principal_pic->saveAs('fileupload/' . $principal_name . '.' . $model->principal_pic->extension);
                    }
                    //upload pic if second signatory photo is not empty
                    if (!empty($model->second_signatory_pic)) {
                        $model->second_signatory_pic->saveAs('fileupload/' . $secondsig_name . '.' . $model->second_signatory_pic->extension);
                    }

                    // upload attachments if not empty
                    if ($attachcount > 0) {
                        for ($i = 0; $i < $attachcount; $i++) {
                            $attachmentobject = $model->attachfiles[$i];
                            $tpname = 'fileupload/' . $model->principal_last_name . '-' . $model->principal_first_name . $model->borrower_id . '-attachment' . $i . '.' . $attachmentobject->extension;
                            $attachmentobject->saveAs($tpname);
                        }
                    }

                    return $this->redirect(['view', 'id' => $model->borrower_id]);
                } else {
                    return $this->render('create', [
                                'model' => $model,
                    ]);
                }
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            throw new \yii\web\UnauthorizedHttpException("You are not allowed to do this action!");
        }
    }

    /**
     * Updates an existing Borrower model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        if (Yii::$app->user->can('admin')) {
            $model = $this->findModel($id);

            if ($model->loadAll(Yii::$app->request->post())) {

                // get the instances of the two profile pic
                $model->principal_pic = UploadedFile::getInstance($model, 'principal_pic');
                $model->second_signatory_pic = UploadedFile::getInstance($model, 'second_signatory_pic');

                //get the instances of the attachfile
                $model->attachfiles = UploadedFile::getInstances($model, 'attachfiles');
                $attachnames = "";

                $attachcount = count($model->attachfiles);
                if ($attachcount > 0) {
                    for ($i = 0; $i < $attachcount; $i++) {
                        $attachmentobject = $model->attachfiles[$i];
                        $tpname = $model->principal_last_name . '-' . $model->principal_first_name . $model->borrower_id . '-attachment' . $i . '.' . $attachmentobject->extension;
                        $attachnames = $attachnames . ' ' . 'fileupload/' . $tpname;
                    }
                    $model->attachments = trim($attachnames);
                }

                //check if principal_pic is not empty and save photo url
                if (!empty($model->principal_pic)) {
                    $principal_name = $model->principal_first_name . $model->principal_last_name; // get the first and last name of principal applicant
                    $model->principal_profile_pic = 'fileupload/' . $principal_name . '.' . $model->principal_pic->extension;
                }

                //check if second_signatory_pic is not empty and save photo url
                if (!empty($model->second_signatory_pic)) {
                    $secondsig_name = $model->comaker_name; // get name of the second signatory
                    $model->comaker_profile_pic = 'fileupload/' . $secondsig_name . '.' . $model->second_signatory_pic->extension;
                }

                if ($model->saveAll()) {
                    //upload pic if principal photo is not empty
                    if (!empty($model->principal_pic)) {
                        $model->principal_pic->saveAs('fileupload/' . $principal_name . '.' . $model->principal_pic->extension);
                    }
                    //upload pic if second signatory photo is not empty
                    if (!empty($model->second_signatory_pic)) {
                        $model->second_signatory_pic->saveAs('fileupload/' . $secondsig_name . '.' . $model->second_signatory_pic->extension);
                    }
                    // upload attachments if not empty
                    if ($attachcount > 0) {
                        for ($i = 0; $i < $attachcount; $i++) {
                            $attachmentobject = $model->attachfiles[$i];
                            $tpname = 'fileupload/' . $model->principal_last_name . '-' . $model->principal_first_name . $model->borrower_id . '-attachment' . $i . '.' . $attachmentobject->extension;
                            $attachmentobject->saveAs($tpname);
                        }
                    }

                    return $this->redirect(['view', 'id' => $model->borrower_id]);
                } else {
                    return $this->render('update', [
                                'model' => $model,
                    ]);
                }
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } else {
            throw new \yii\web\UnauthorizedHttpException("You are not allowed to this action!");
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

            return $this->redirect(['index']);
        } else {
            throw new \yii\web\UnauthorizedHttpException("You are not allowed to do this action!");
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
            throw new UnauthorizedHttpException('The requested page does not exist.');
        }
    }

}
