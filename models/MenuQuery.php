<?php

namespace walter74\yiipress\models;

/**
 * This is the ActiveQuery class for [[CmsMenu]].
 *
 * @see CmsMenu
 */
class MenuQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CmsMenu[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CmsMenu|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
