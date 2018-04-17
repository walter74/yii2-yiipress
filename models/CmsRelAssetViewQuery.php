<?php

namespace walter74\yiipress\models;

/**
 * This is the ActiveQuery class for [[CmsRelAssetView]].
 *
 * @see CmsRelAssetView
 */
class CmsRelAssetViewQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CmsRelAssetView[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CmsRelAssetView|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
