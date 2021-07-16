<?php

namespace backend\controllers;

use Yii;
use backend\models\Msg;
use backend\models\MsgSearch;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Project;
use yii\widgets\ListView;

/**
 * MsgController implements the CRUD actions for Msg model.
 */
class MsgController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],

        ];
    }

    /**
     * Lists all Msg models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new MsgSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $projectDataProvider = new ActiveDataProvider([
            'query' => Project::find(),

        ]);
        if (!Yii::$app->user->can('admin')) {

            $user_id = Yii::$app->user->getId();
            $projectDataProvider->query->where(['and', 'status=1', ['or', "project.artist_id = $user_id", "project.main_artist_id = $user_id", "project.manager_id = $user_id"]]);
        }

        $projectDataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'projectDataProvider' => $projectDataProvider,

        ]);
    }

    /**
     * Displays a single Msg model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new MsgSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where("msg.project_id = $id");
        $dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];
        $projectDataProvider = new ActiveDataProvider([
            'query' => Project::find(),

        ]);

        if (!Yii::$app->user->can('admin')) {

            $user_id = Yii::$app->user->getId();
            $projectDataProvider->query->where(['and', 'status=1', ['or', "project.artist_id = $user_id", "project.main_artist_id = $user_id", "project.manager_id = $user_id"]]);
        }
        $projectDataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];

        $this->actionCreate();

        return $this->render('view', [
            'model' => new Msg(['project_id' => $id]),

            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'projectDataProvider' => $projectDataProvider,

        ]);

    }

    /**
     * Creates a new Msg model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Msg();

        if ($model->load(Yii::$app->request->post())) {

            $model->user_id = Yii::$app->user->getId();
            $model->project_id = Yii::$app->request->get('id');

        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->project_id]);
        }

    }

    /**
     * Updates an existing Msg model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Msg model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Msg model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Msg the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Msg::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
