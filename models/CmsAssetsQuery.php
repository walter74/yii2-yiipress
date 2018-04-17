<?php

namespace walter74\yiipress\models;

/**
 * This is the ActiveQuery class for [[CmsAssets]].
 *
 * @see CmsAssets
 */
class CmsAssetsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CmsAssets[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CmsAssets|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
