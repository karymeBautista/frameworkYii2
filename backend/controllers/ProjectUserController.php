<?php

namespace backend\controllers;

use common\models\ProjectUser;
use common\models\search\ProjectUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectUserController implements the CRUD actions for ProjectUser model.
 */
class ProjectUserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ProjectUser models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProjectUserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectUser model.
     * @param int $project_id Project ID
     * @param int $user_id User ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($project_id, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($project_id, $user_id),
        ]);
    }

    /**
     * Creates a new ProjectUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ProjectUser();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'project_id' => $model->project_id, 'user_id' => $model->user_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProjectUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $project_id Project ID
     * @param int $user_id User ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($project_id, $user_id)
    {
        $model = $this->findModel($project_id, $user_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'project_id' => $model->project_id, 'user_id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProjectUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $project_id Project ID
     * @param int $user_id User ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($project_id, $user_id)
    {
        $this->findModel($project_id, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProjectUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $project_id Project ID
     * @param int $user_id User ID
     * @return ProjectUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($project_id, $user_id)
    {
        if (($model = ProjectUser::findOne(['project_id' => $project_id, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
