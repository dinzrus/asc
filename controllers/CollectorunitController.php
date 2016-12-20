<?php

namespace app\controllers;

use Yii;
use app\models\Collectorunit;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * CollectorunitController implements the CRUD actions for Collectorunit model.
 */
class CollectorunitController extends Controller {

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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'getunits'],
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
     * Lists all Collectorunit models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Collectorunit::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Collectorunit model.
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
     * Creates a new Collectorunit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Collectorunit();

        $collectors = Yii::$app->db->createCommand("SELECT\n" .
                        "emposition.id AS emp_id,\n" .
                        "employee.id,\n" .
                        "CONCAT(employee.last_name,', ',employee.last_name,employee.middle_name) AS fullname, \n" .
                        "position.position\n" .
                        "FROM\n" .
                        "employee\n" .
                        "INNER JOIN emposition ON emposition.employee_id = employee.id\n" .
                        "INNER JOIN position ON emposition.position_id = position.id\n" .
                        "WHERE\n" .
                        "position.position = 'collector'")->queryAll();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'collectors' => $collectors,
            ]);
        }
    }
    
    // for dependent dropdown in assigning of collector to unit
    public function actionGetunits() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $collector_id = $parents[0];
                $collector = \app\models\Emposition::findOne(['id' => $collector_id]);
                $list = \app\models\Unit::find()->andWhere(['branch_id' => $collector->branch_id])->asArray()->all();
                $selected = null;
                foreach ($list as $i => $value) {
                    $out[] = ['id' => $value['unit_id'], 'name' => $value['unit_description']];
                    if ($i == 0) {
                        $selected = $value['unit_id'];
                    }
                }
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }
    

    /**
     * Updates an existing Collectorunit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $collectors = Yii::$app->db->createCommand("SELECT\n" .
                        "emposition.id AS emp_id,\n" .
                        "employee.id,\n" .
                        "CONCAT(employee.last_name,', ',employee.last_name,employee.middle_name) AS fullname, \n" .
                        "position.position\n" .
                        "FROM\n" .
                        "employee\n" .
                        "INNER JOIN emposition ON emposition.employee_id = employee.id\n" .
                        "INNER JOIN position ON emposition.position_id = position.id\n" .
                        "WHERE\n" .
                        "position.position = 'collector' AND emposition.id = :id")->bindValue(':id', $model->collector_id)->queryOne();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['collectorunit/index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'collectors' => $collectors,
            ]);
        }
    }

    /**
     * Deletes an existing Collectorunit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Collectorunit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Collectorunit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Collectorunit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
