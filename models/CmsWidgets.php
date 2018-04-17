<?php

namespace walter74\yiipress\models;

use Yii;

/**
 * This is the model class for table "{{%cms_widgets}}".
 *
 * @property int $id
 * @property int $tag
 * @property int $args
 * @property int $classname
 */
class CmsWidgets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_widgets}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag', 'classname'], 'required'],
            [['tag', 'args', 'classname'], 'string'],
            ['classname','isClass'],
            ['args', 'filter', 'filter' => function ($value) {
																$content = str_replace('\\','\\\\',$value);
																$content = str_replace('/','\/',$content);
																return $content;
																}
			],
            ['args', 'isJson'],
            [['created_at', 'updated_at'], 'integer'], 
            ['tag', 'unique'],
            ['tag', 'unique','targetClass'=>Yii::$app->controller->module->modelNamespace.'\CmsSections', 'targetAttribute' => 'tag'],
            ['tag', 'unique','targetClass'=>Yii::$app->controller->module->modelNamespace.'\CmsMenu', 'targetAttribute' => 'tag'],
            
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
            'tag' => Yii::t('app', 'Placeholder'),
            'args' => Yii::t('app', 'Args'),
            'classname' => Yii::t('app', 'ClassName'),
        ];
    }
    public function str_replacement_widget_link($value){
		
		$content = str_replace('\\\\','\\',$value);
		$content = str_replace('\/','/',$content);
		return $content;
	
	
	}
    public function isJson($attribute,$params){
		
		if($this->$attribute=='')return;
		
		if(!is_array(json_decode($this->$attribute,true))){
			$this->addError($attribute, 'Non è un formato Json corretto!');
		}
														
		
	}
    public function isClass($attribute,$params)
	{ 
		$classname=trim($this->$attribute);
		
		if(!class_exists($classname)){ 
	       $this->addError($attribute, 'Non è un namespace corrispondente ad una classe esistente!');
	    }
	}
    /**
     * @inheritdoc
     * @return WidgetsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WidgetsQuery(get_called_class());
    }
}
