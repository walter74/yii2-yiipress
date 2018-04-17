<?php

namespace walter74\yiipress\models;

/**
 * This is the ActiveQuery class for [[CmsPlugins]].
 *
 * @see CmsPlugins
 */
class CmsThemesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CmsPlugins[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CmsPlugins|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
