<?php

namespace plugins\articles\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use plugins\articles\models\CmsArticles;

/**
 * CmsArticlesSearch represents the model behind the search form of `app\modules\cms\models\CmsArticles`.
 */
class CmsArticlesTagSearch extends CmsArticles
{
    /**
     * @inheritdoc
     */
    public $tag;
    public function rules()
    {
        return [
           
            [['tag'], 'string'],
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
    public function search($params,$pagination=true,$pageSize=6)
    {
        $query = CmsArticles::find()->published();
       

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ($pagination!=false)?[
                                        // 'limit'=>$this->limit,
                                         'route'=>(Yii::$app->controller->module->action_page_root!==null)?Yii::$app->controller->module->action_page_root:Yii::$app->controller->id.'/'.Yii::$app->controller->action->id,
                                         'pageSize' => $pageSize,
                                        //  'params'   => ['slug'=>Yii::$app->request->get("slug"),'CmsArticlesWordSearch[w]'=>$this->w,'page'=>is_numeric(Yii::$app->request->get("page"))?Yii::$app->request->get("page"):1],
                                         ]:false, 
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

    

        $query->andFilterWhere(['like', 'tags',$this->tag]);
      

        return $dataProvider;
    }
}
