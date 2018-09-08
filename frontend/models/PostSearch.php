<?php
namespace frontend\models;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use common\models\Post;
use yii\data\ActiveDataProvider;
class PostSearch extends Post
{
    public function search($params)
    {
        $query = Post::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                    'updated_at' => SORT_DESC
                ]
            ]
        ]);
        
        if($this->load($params)){
            $query->andFilterWhere(['like', 'name', $this->name]);
            
            $query->andFilterWhere(['created_by' => $this->created_by])
                    ->andFilterWhere(['updated_by' => $this->updated_by]);
        }
        return $dataProvider;
    }
}

