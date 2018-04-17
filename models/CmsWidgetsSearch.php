<?php

namespace walter74\yiipress\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use walter74\yiipress\models\CmsWidgets;

/**
 * CmsSearchWidgets represents the model behind the search form of `walter74\yiipress\models\CmsWidgets`.
 */
class CmsWidgetsSearch extends CmsWidgets
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['tag', 'args', 'classname'],'safe']
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
        $query = CmsWidgets::find();

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
      /*  $query->andFilterWhere([
          //  'id' => $this->id,
            'tag' => $this->tag,
           // 'args' => $this->args,
            'classname' => $this->classname,
        ]);*/
         $query->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'classname', $this->classname]);
        return $dataProvider;
    }
}
