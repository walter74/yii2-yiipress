<?php

namespace walter74\yiipress\models;

use Yii;

/**
 * This is the model class for table "{{%cms_articles}}".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property resource $img
 * @property string $content
 * @property int $created_at
 * @property int $updated_at
 */
class CmsArticles extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED=10;
    const STATUS_INACTIVE=0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_articles}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'content'], 'required'],
            [['description','meta_description', 'img', 'content'], 'string'],
           // [['created_at', 'updated_at','created_by'], 'integer'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'img' => Yii::t('app', 'Img'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @inheritdoc
     * @return CmsArticlesQuery the active query used by this AR class.
     */
    public function behaviors()
	{
		return [
				\yii\behaviors\TimestampBehavior::className(),
				\yii\behaviors\BlameableBehavior::className()
				];
	}
    public function getUser()
    {
        $userModel=Yii::$app->controller->module->userModel;
        return $this->hasOne($userModel::className(), ['id' => 'created_by']);
    }
   
    public static function find()
    {
        return new CmsArticlesQuery(get_called_class());
    }
}
