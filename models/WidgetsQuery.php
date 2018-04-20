<?php

namespace walter74\yiipress\models;

/**
 * This is the ActiveQuery class for [[CmsWidgets]].
 *
 * @see CmsWidgets
 */
class WidgetsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CmsWidgets[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CmsWidgets|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
