<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

//AGREGAMOS LOS MODELOS NECESARIOS
use common\models\Status;

/** @var yii\web\View $this */
/** @var common\models\Task $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
       // 'filterModel' => $searchModel,
        'attributes' => [
            //'id',
            'name',
            'description:ntext',
            'project_id',
            //'status_id',
            [
                'attribute'=>'Estado',
                'value'=>Status::findOne($model->status_id)->description  
            ],
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

<?= Html::a('Regresar al  Proyecto', ['project/view', 'id' => $model->project_id], ['class' => 'Project','class'=>'btn btn-warning']) ?>
</div>



