<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

//PASO 2 AGREGAMOS TODAS LAS LIBRERÍAS NECESARIAS EN EL DETALLE QUE SON LAS QUE ESTABAN EN EL INDEX DE TAREA   *******************
use common\models\Task;
use common\models\Project;
use common\models\ProjectUser;
use common\models\User;
use common\models\Role;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\Status;
use yii\helpers\ArrayHelper;


/** @var yii\web\View $this */
/** @var common\models\Project $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'description:ntext',
            'created_at',
            'updated_at',
            // 'created_by',
            // 'updated_by',
            [
                'attribute'=>'created_by',
                'value'=>User::findOne($model->created_by)->username
            ],
            [
                'attribute'=>'updated_by',
                'value'=>User::findOne($model->updated_by)->username
            ],
        ],
    ]) ?>

<p>   
  
        <?= Html::a('CREAR TAREAS VINCULADAS',
         ['task/create', 'project_id' => $model->id], ['class' => 'btn btn-success btn-small']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'project_id',
           [
            'attribute' => 'Nombre', 
            'value' => function($model)
                        {
                            $estado= Task::findOne($model); //select * from status where
                            return $estado->name;
                        },
            'filter' => ArrayHelper::map(Task::find()->all(), 'id', 'name'),   
        ],
        // 'project_id',
        [
            'attribute' => 'Descripción', 
            'value' => function($model)
                        {
                            $estado= Task::findOne($model); //select * from status where
                            return $estado->description;
                        },
            'filter' => ArrayHelper::map(Task::find()->all(), 'id', 'name'),   
        ],
        // 'user_id',
        [
            'attribute' => 'Usuario', 
            'value' => function($model)
                        {
                            $nombreRol= User::findOne($model); //select * from role where
                            return $nombreRol->username;
                        },
           'filter' => ArrayHelper::map(User::find()->all(), 'id', 'username'),   
        ],
        // 'role_id',
        [
            'attribute' => 'Rol', 
            'value' => function($model)
                        {
                            $nombreRol= Role::findOne($model); //select * from role where
                            return $nombreRol->nombre;
                        },
            'filter' => ArrayHelper::map(Role::find()->all(), 'id', 'nombre'),   
        ],
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn','controller' => 'task','template' => '{view} {update} {delete}'],
        ],
    ]); ?>



</div>


