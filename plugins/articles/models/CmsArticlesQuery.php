<?php

namespace plugins\articles\models;

/**
 * This is the ActiveQuery class for [[CmsArticles]].
 *
 * @see CmsArticles
 */
class CmsArticlesQuery extends \yii\db\ActiveQuery
{
    
    public function published()
    {

        return $this->andWhere(['status'=> \plugins\articles\models\CmsArticles::STATUS_PUBLISHED]);
    }

    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CmsArticles[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CmsArticles|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
