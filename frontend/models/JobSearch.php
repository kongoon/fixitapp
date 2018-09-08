<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Job;

/**
 * JobSearch represents the model behind the search form of `common\models\Job`.
 */
class JobSearch extends Job
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'request_by', 'request_at', 'receive_by', 'receive_at', 'repair_by', 'repair_at', 'feedback', 'job_status_id'], 'integer'],
            [['content', 'location', 'request_tel', 'repair_detail', 'remark'], 'safe'],
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
    public function search($params)
    {
        $query = Job::find()->where(['request_by' => Yii::$app->user->getId()]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
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
            'request_by' => $this->request_by,
            'request_at' => $this->request_at,
            'receive_by' => $this->receive_by,
            'receive_at' => $this->receive_at,
            'repair_by' => $this->repair_by,
            'repair_at' => $this->repair_at,
            'feedback' => $this->feedback,
            'job_status_id' => $this->job_status_id,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'request_tel', $this->request_tel])
            ->andFilterWhere(['like', 'repair_detail', $this->repair_detail])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
