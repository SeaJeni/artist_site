<?php

namespace backend\controllers;

use backend\models\User;
use Yii;
use backend\models\Project;
use backend\models\ProjectSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if(!Yii::$app->user->can('admin')) {

            $user_id=Yii::$app->user->getId();
            $dataProvider->query->where(['and','status=1',['or',"artist_id = $user_id", "main_artist_id = $user_id", "manager_id = $user_id"]]);
        }
        $dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function getUsersIdByRoles($roles){

        $usersId = Yii::$app->authManager->getUserIdsByRole($roles);// get id
        $users = User::find()->where(['id' => $usersId])->all();

        return $users;

    }

    public function actionCreate()
    {
        $model = new Project();

        $artist = $this->getUsersIdByRoles('artist');
        $main_artist = $this->getUsersIdByRoles('main_artist');
        $manager = $this->getUsersIdByRoles('manager');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'artist' => $artist,
            'mainArtists' => $main_artist,
            'manager' => $manager,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('updateProjects'))
        {
        $model = $this->findModel($id);
        $artist = $this->getUsersIdByRoles('artist');
        $main_artist = $this->getUsersIdByRoles('main_artist');
        $manager = $this->getUsersIdByRoles('manager');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'artist' => $artist,
            'mainArtists' => $main_artist,
            'manager' => $manager,
        ]);
        }

        else{
            return $this->redirect(['index']);
        }
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('admin'))
        {
        $this->findModel($id)->delete();


        }
        return $this->redirect(['index']);

    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
