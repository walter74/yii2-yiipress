<?php

namespace walter74\yiipress\models;

use Yii;

/**
 * This is the model class for table "{{%cms_rel_menu_pages}}".
 *
 * @property int $menu_id
 * @property int $page_id
 * @property int $priority
 */
class CmsRelMenuPages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_rel_menu_pages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id', 'page_id', 'priority'], 'required'],
            [['menu_id', 'page_id', 'priority'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menu_id' => Yii::t('app', 'Menu ID'),
            'page_id' => Yii::t('app', 'Page ID'),
            'priority' => Yii::t('app', 'Priority'),
        ];
    }
}
