<?php

namespace walter74\yiipress\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use walter74\yiipress\models\CmsPages;

/**
 * CmsPagesSearch represents the model behind the search form of `walter74\yiipress\models\CmsPages`.
 */
class CmsPagesSearch extends CmsPages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['title', 'layout', 'view','slug'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = CmsPages::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'layout', $this->layout])
            ->andFilterWhere(['like', 'view', $this->view])
            ->andFilterWhere(['like', 'slug', $this->slug]);
        return $dataProvider;
    }
}
