<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Task;

/**
 * TaskSearch represents the model behind the search form of `common\models\Task`.
 */
class TaskSearch extends Task
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'status_id', 'created_by', 'updated_by'], 'integer'],
            [['name', 'description', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */


     //AQUI AGREGAR EL PARÁMETRO DE LA RELACION $project_id EN LA CABECERA DEL METODO, *************************************
     //PONERLE POR DEFAULT NULL AL PARAMETRO

    public function search($params, $project_id = null)  //ACTIVAMOS EL FILTRO DEL DETALLE   *****************************
    {   
        //$query = Task::find();
        //AQUI SE ACTIVA EL FILTRO EN ESTE BLOQUE IF CON SU ELSE Y YA DEBE JALAR   **************************************

        //DESPUES DE ESO FALTA REDIRIGIR LOS ICONOS DE VER, ACTUALIZAR DEL DETALLE DE TAREAS EN EL VIEW DE PROJECT EN EL ULTIMO ATRIBUTO
        if ($project_id) 
            $query = Task::find()->where(['project_id' => $project_id]); 
        else 
            $query = Task::find();//select * from task

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'project_id' => $this->project_id,
            'status_id' => $this->status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
