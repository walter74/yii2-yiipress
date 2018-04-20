<?php

namespace walter74\yiipress\models;

use Yii;

/**
 * This is the model class for table "{{%cms_assets}}".
 *
 * @property int $id
 * @property string $content
 * @property string $depends
 * @property string $position
 * @property int $type 0=css,1=js,2=script,3=meta-tag
 * @property int $created_at
 * @property int $updated_at
 */
class CmsAssets extends \yii\db\ActiveRecord
{
    const TYPE_CSS=0;  
    const TYPE_JS=1;
    const TYPE_SCRIPT=2;
    const TYPE_METATAG=3;
    const TYPE_ASSET=4;
    const TYPE_LINKTAG=5;
    const TYPE_CSS_CODE=6;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_assets}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'type'], 'required'],
            [['content','depends'], 'string'],
            
            [['type'], 'integer'],
            ['position','required','when'=>function($model, $attribute) {
																	    return ($model->type==self::TYPE_SCRIPT)||($model->type==self::TYPE_JS);
																	
																	} ,
			],
			['position','in','range'=>function($model, $attribute) {
																	    if($model->type==self::TYPE_SCRIPT)
																					return [\yii\web\View::POS_HEAD,\yii\web\View::POS_BEGIN,\yii\web\View::POS_END];
																	    if($model->type==self::TYPE_JS)
																	                return [\yii\web\View::POS_HEAD,\yii\web\View::POS_BEGIN,\yii\web\View::POS_LOAD,\yii\web\View::POS_READY,\yii\web\View::POS_END];
																	            
																	    return [\yii\web\View::POS_HEAD,\yii\web\View::POS_BEGIN,\yii\web\View::POS_LOAD,\yii\web\View::POS_READY,\yii\web\View::POS_END];
																	            
																	} ,
			],
			[['content'], 'isJsonMetaTag'],
			/*['position','in','range'=>[\yii\web\View::POS_HEAD,\yii\web\View::POS_BEGIN,\yii\web\View::POS_END],'when'=>function ($model) {
																																		return false;//$model->type == self::TYPE_JS;
																																		} 
			],*/
			//[['position'],'integer'],
		];
    }

    /**
     * @inheritdoc
     */
    public function isJsonMetaTag($attribute,$params){
		
		if($this->$attribute=='')return;
		
		if($this->type==self::TYPE_METATAG){
			if(!is_array(json_decode($this->$attribute,true))){
				$this->addError($attribute, \Yii::t('app','Il MetaTag non è un formato Json corretto!'));
			}
	    }												
		
	}
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'content' => Yii::t('app', 'Content'),
            'type' => Yii::t('app', 'Type'),
            'position'=>Yii::t('app','Position'),
            'depends'=>Yii::t('app','Depends'), 
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    public function beforeDelete()
	{
		
		if (!parent::beforeDelete()) {
										return false;
			}
	   $nm_rel_assets= Yii::$app->controller->module->modelNamespace.'\CmsRelAssetPage';
       $nm_rel_assets::deleteAll(['asset_id'=>$this->id]);
    // ...custom code here...
		return true;
	}
    public function behaviors()
	{
		return [
				\yii\behaviors\TimestampBehavior::className(),
				];
	}
    /**
     * @inheritdoc
     * @return CmsAssetsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsAssetsQuery(get_called_class());
    }
}
