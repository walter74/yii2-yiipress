<?php

namespace walter74\yiipress\models;

use Yii;

/**
 * This is the model class for table "{{%cms_rel_asset_view}}".
 *
 * @property string $path
 * @property int $asset_id
 */
class CmsRelAssetView extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_rel_asset_view}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path', 'asset_id'], 'required'],
            [['asset_id'], 'integer'],
            [['path'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'path' => Yii::t('app', 'Path'),
            'asset_id' => Yii::t('app', 'Asset ID'),
        ];
    }
    
    /**
     * @inheritdoc
     * @return CmsRelAssetViewQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsRelAssetViewQuery(get_called_class());
    }
}
