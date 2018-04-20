<?php

namespace walter74\yiipress\models;

use Yii;

/**
 * This is the model class for table "{{%cms_menu}}".
 *
 * @property int $id
 * @property string $tag
 * @property int $created_at
 * @property int $updated_at
 * @property string $name
 */
class CmsMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag', 'name'], 'required'],
            ['config', 'filter', 'filter' => function ($value) {
																return str_replace('\\','\\\\',$value);
																}
			],
			['classname','isClass'],
            ['config','isJson'],
            [['created_at', 'updated_at'], 'integer'],
            ['tag', 'unique'],
             ['tag', 'unique','targetClass'=>Yii::$app->controller->module->modelNamespace.'\CmsSections', 'targetAttribute' => 'tag'],
             ['tag', 'unique','targetClass'=>Yii::$app->controller->module->modelNamespace.'\CmsWidgets', 'targetAttribute' => 'tag'],
            [['tag', 'name'], 'string', 'max' => 100],
            ['pages', 'string'],
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
            'classname'=>Yii::t('app','Custom ClassName'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'name' => Yii::t('app', 'Name'),
        ];
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
    public function getListpages(){
		 $nm_pages=Yii::$app->controller->module->modelNamespace.'\CmsPages';
		 //return $this->pages;
		 $pages=($this->pages=='')?[]:unserialize($this->pages);
		 $list_pages=[];
		 if(is_array($pages)){
			foreach($pages as $page){
		      if(is_array($page)){
				$list_pages[]=$page;
			  }
			  if(is_numeric($page)){
				$list_pages[] = $nm_pages::findOne($page);
		      }
			}
		 }
		 return $list_pages;
		// return (!empty($pages))?$nm_pages::find()->where(['id'=>$pages])->orderBy([new \yii\db\Expression('FIELD (id' . (implode(',', $pages)==''?'':','.implode(',', $pages)) . ')')])->all():[];//?[$nm_pages::find()->where(['id'=>$pages])]:$nm_pages::find()->where(['id'=>$pages]);//?$nm_pages::find()->where(['id'=>$pages])->all():[$nm_pages::find()->where(['id'=>$pages])->all()];
		/* $nm_pages=Yii::$app->controller->module->modelNamespace.'\CmsPages';
		 $nm_rel_pages=Yii::$app->controller->module->modelNamespace.'\CmsRelMenuPages';
		 return $query= (new \yii\db\Query)->select([$nm_rel_pages::tableName().'.priority',$nm_pages::tableName().'.slug',$nm_pages::tableName().'.title'])->from([$nm_pages::tableName(),$nm_rel_pages::tableName()])->where([$nm_rel_pages::tableName().'.menu_id'=>$this->id,$nm_pages::tableName().'.id'=>$nm_rel_pages::tableName().'.page_id']);*/
		 /*return $this->hasMany($nm_assets::className(), ['id' => 'page_id'])
            ->viaTable('cms_rel_menu_pages', ['menu_id' => 'id'],function($query){
							$query->orderBy(['priority' => SORT_DESC]);
				});*/
		
	}
    /**
     * @inheritdoc
     * @return MenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MenuQuery(get_called_class());
    }
}
