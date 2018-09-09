<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `common\models\Profile`.
 */
class ProfileSearch extends Profile
{
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'department_id'], 'integer'],
            [['firstname', 'lastname', 'username', 'email'], 'safe'],
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
        $query = Profile::find()->joinWith(['user', 'department']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            /*'sort' => [
                'attributes' => [
                    'username' => [
                        'asc' => ['user.username' => SORT_ASC],
                        'desc' => ['user.username' => SORT_DESC]
                    ],
                    'email' => [
                        'asc' => ['user.email' => SORT_ASC],
                        'desc' => ['user.email' => SORT_DESC]
                    ],
                    'department_id' => [
                        'asc' => ['department.name' => SORT_ASC],
                        'desc' => ['department.name' => SORT_DESC]
                    ]
                ]
            ]*/
        ]);
        $dataProvider->sort->attributes['username'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC]
        ];
        $dataProvider->sort->attributes['email'] = [
            'asc' => ['user.email' => SORT_ASC],
            'desc' => ['user.email' => SORT_DESC]
        ];
        $dataProvider->sort->attributes['department_id'] = [
            'asc' => ['department.name' => SORT_ASC],
            'desc' => ['department.name' => SORT_DESC]
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'department_id' => $this->department_id,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
                ->andFilterWhere(['like', 'user.username', $this->username])
                ->andFilterWhere(['like', 'user.email', $this->email]);

        return $dataProvider;
    }
}
