<?php

namespace walter74\yiipress\models;

use Yii;

/**
 * This is the model class for table "{{%cms_rel_asset_page}}".
 *
 * @property int $page_id
 * @property int $asset_id
 */
class CmsRelAssetPage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_rel_asset_page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'asset_id'], 'required'],
            [['page_id', 'asset_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => Yii::t('app', 'Page ID'),
            'asset_id' => Yii::t('app', 'Asset ID'),
        ];
    }
}
