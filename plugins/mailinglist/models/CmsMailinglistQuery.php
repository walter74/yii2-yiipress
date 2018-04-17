<?php

namespace plugins\mailinglist\models;

/**
 * This is the ActiveQuery class for [[CmsArticles]].
 *
 * @see CmsArticles
 */
class CmsMailinglistQuery extends \yii\db\ActiveQuery
{
    
  

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
