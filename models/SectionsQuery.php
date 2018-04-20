<?php

namespace walter74\yiipress\models;

/**
 * This is the ActiveQuery class for [[CmsSections]].
 *
 * @see CmsSections
 */
class SectionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CmsSections[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CmsSections|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
