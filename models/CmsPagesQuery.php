<?php

namespace walter74\yiipress\models;

/**
 * This is the ActiveQuery class for [[CmsPages]].
 *
 * @see CmsPages
 */
class CmsPagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CmsPages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CmsPages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
