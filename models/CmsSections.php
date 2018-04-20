<?php

namespace walter74\yiipress\models;

use Yii;

/**
 * This is the model class for table "{{%cms_sections}}".
 *
 * @property int $id
 * @property string $nome
 * @property string $tag
 * @property string $content
 * @property int $created_at
 * @property int $updated_at
 */
class CmsSections extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_sections}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'tag', 'content'], 'required'],
            [['content'], 'string'],
            ['tag', 'unique'],
            ['tag', 'unique','targetClass'=>Yii::$app->controller->module->modelNamespace.'\CmsMenu', 'targetAttribute' => 'tag'],
            ['tag', 'unique','targetClass'=>Yii::$app->controller->module->modelNamespace.'\CmsWidgets', 'targetAttribute' => 'tag'],
            
            [['created_at', 'updated_at'], 'integer'],
            [['nome', 'tag'], 'string', 'max' => 100],
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
            'nome' => Yii::t('app', 'Nome'),
            'tag' => Yii::t('app', 'Placeholder'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    public function getSubsections(){
		 $nm_sections=Yii::$app->controller->module->modelNamespace.'\CmsSections';
		 $list_sections=$nm_sections::find()->all();
		 $sub_sections=[];
		 if(is_array($list_sections)){
				foreach($list_sections as $section){
					if(strpos($this->content,$section->tag)!==false){
						$sub_sections[]=$section;
				    }
				
				}
		}
		return $sub_sections;
	}
    public function getWidgets(){
		 $nm_widgets=Yii::$app->controller->module->modelNamespace.'\CmsWidgets';
		 $list_widgets=$nm_widgets::find()->all();
		 $widgets=[];
		 if(is_array($list_widgets)){
				foreach($list_widgets as $widget){
					if(strpos($this->content,$widget->tag)!==false){
						$widgets[]=$widget;
				    }
				
				}
		}
		return $widgets;
    }
    public function getMenu(){
		 $nm_menus=Yii::$app->controller->module->modelNamespace.'\CmsMenu';
		 $list_menus=$nm_menus::find()->all();
		 $menus=[];
		 if(is_array($list_menus)){
				foreach($list_menus as $menu){
					if(strpos($this->content,$menu->tag)!==false){
						$menus[]=$menu;
				    }
				
				}
		}
		return $menus;
    }
    /**
     * @inheritdoc
     * @return SectionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SectionsQuery(get_called_class());
    }
}
