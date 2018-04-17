<?php

namespace walter74\yiipress\models;

/**
 * This is the ActiveQuery class for [[CmsPages]].
 *
 * @see CmsPages
 */
class PagesQuery extends \yii\db\ActiveQuery
{
    public function published()
    {
        $classname_pages=\Yii::$app->controller->module->modelNamespace.'\CmsPages';
        return $this->andWhere(['status'=>$classname_pages::STATUS_PUBLISHED]);
    }

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
