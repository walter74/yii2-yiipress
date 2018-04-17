<?php

namespace walter74\yiipress\models;

use Yii;

/**
 * This is the model class for table "{{%cms_plugins}}".
 *
 * @property int $id
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 */
class CmsPlugins extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_plugins}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
            ['name', 'unique'],
        ];
    }
    public function behaviors()
	{
		return [
				\yii\behaviors\TimestampBehavior::className(),
				];
	}
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    public function afterSave ($insert, $changedAttributes){
		
		parent::afterSave($insert,$changedAttributes);
		
		//after saving initialize the plugin
	    if(is_dir(Yii::getAlias(Yii::$app->controller->module->plugin_dir).'/'.$this->name)){
				
			   if(is_dir(Yii::getAlias(Yii::$app->controller->module->plugin_dir).'/'.$this->name)){
				   if(file_exists(Yii::getAlias(Yii::$app->controller->module->plugin_dir).'/'.$this->name.'/activate.php')){
					 
					   require(Yii::getAlias(Yii::$app->controller->module->plugin_dir).'/'.$this->name.'/activate.php');
					   
					}
				}
		} 
	
	}
	public function beforeDelete()
	{
		if (!parent::beforeDelete()){
					return false;
		}
		//before deleting eliminate the plugin initialization
		if(is_dir(Yii::getAlias(Yii::$app->controller->module->plugin_dir).'/'.$this->name)){
				
			   if(is_dir(Yii::getAlias(Yii::$app->controller->module->plugin_dir).'/'.$this->name)){
				   if(file_exists(Yii::getAlias(Yii::$app->controller->module->plugin_dir).'/'.$this->name.'/deactivate.php')){
					 
					   require(Yii::getAlias(Yii::$app->controller->module->plugin_dir).'/'.$this->name.'/deactivate.php');
					   
					}
				}
		} 
        
		return true;
	}
    /**
     * @inheritdoc
     * @return CmsPluginsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsPluginsQuery(get_called_class());
    }
}
