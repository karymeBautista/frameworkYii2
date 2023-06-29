<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\ProjectUser $model */

$this->title = $model->project_id;
$this->params['breadcrumbs'][] = ['label' => 'Project Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'project_id' => $model->project_id, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'project_id' => $model->project_id, 'user_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Desea eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'project_id',
            [
                'attribute' => 'project_id', 
                'value' => function($model)
                            {
                                $estado= Project::findOne($model->project_id); //select * from status where
                                return $estado->description;
                            },
                'filter' => ArrayHelper::map(Project::find()->all(), 'id', 'name'),   
            ],
            // 'user_id',
            [
                'attribute' => 'user_id', 
                'value' => function($model)
                            {
                                $nombreRol= User::findOne($model->user_id); //select * from role where
                                return $nombreRol->username;
                            },
                'filter' => ArrayHelper::map(User::find()->all(), 'id', 'username'),   
            ],
            // 'role_id',
            [
                'attribute' => 'role_id', 
                'value' => function($model)
                            {
                                $nombreRol= Role::findOne($model->role_id); //select * from role where
                                return $nombreRol->nombre;
                            },
                'filter' => ArrayHelper::map(Role::find()->all(), 'id', 'nombre'),   
            ],
            
            // //Por defecto
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, ProjectUser $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'project_id' => $model->project_id, 'user_id' => $model->user_id]);
            //      }
            // ],
        ],
    ]) ?>

</div>
