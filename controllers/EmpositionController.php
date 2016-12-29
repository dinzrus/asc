<?php

namespace app\controllers;

use Yii;
use app\models\Emposition;
use app\models\EmpositionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmpositionController implements the CRUD actions for Emposition model.
 */
class EmpositionController extends Controller {

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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'add-collectorunit'],
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
     * Lists all Emposition models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new EmpositionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $employee = Yii::$app->db->createCommand("SELECT\n" .
                        "employee.id,\n" .
                        "CONCAT(employee.last_name, ', ',employee.first_name, ' ' ,employee.middle_name) as fullname\n" .
                        "FROM\n" .
                        "employee")->queryAll();

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'employee' => $employee,
        ]);
    }

    /**
     * Displays a single Emposition model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $providerCollectorunit = new \yii\data\ArrayDataProvider([
            'allModels' => $model->collectorunits,
        ]);
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'providerCollectorunit' => $providerCollectorunit,
        ]);
    }

    /**
     * Creates a new Emposition model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Emposition();

        $employee = Yii::$app->db->createCommand("SELECT\n" .
                        "employee.id,\n" .
                        "CONCAT(employee.last_name, ', ',employee.first_name, ' ' ,employee.middle_name) as fullname\n" .
                        "FROM\n" .
                        "employee")->queryAll();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'employee' => $employee,
            ]);
        }
    }

    /**
     * Updates an existing Emposition model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $employee = Yii::$app->db->createCommand("SELECT\n" .
                        "employee.id,\n" .
                        "CONCAT(employee.last_name, ', ',employee.first_name, ' ' ,employee.middle_name) as fullname\n" .
                        "FROM\n" .
                        "employee")->queryAll();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'employee' => $employee,
            ]);
        }
    }

    /**
     * Deletes an existing Emposition model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Emposition model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Emposition the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Emposition::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Action to load a tabular form grid
     * for Collectorunit
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddCollectorunit() {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Collectorunit');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formCollectorunit', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
