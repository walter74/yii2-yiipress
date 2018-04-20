<?php

namespace walter74\yiipress\models;

use Yii;

/**
 * This is the model class for table "{{%cms_pages}}".
 *
 * @property int $id
 * @property string $title
 * @property int $slug
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 * @property string $layout
 * @property string $view
 */
class CmsPages extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED=10;
    const STATUS_INACTIVE=0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_pages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'layout', 'view'], 'required'],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_INACTIVE,self::STATUS_PUBLISHED]],
            //[['created_at', 'updated_at', 'status'], 'integer'],
            [['slug'], 'string', 'max' => 50],
            [['theme'], 'string', 'max' => 100],
            [['title','title_alt'], 'string', 'max' => 200],
            ['slug', 'unique'],
            ['description','string'],
            //['img', 'image', 'extensions' => 'png,jpg,jpg,jpeg,gif'],
            [['layout', 'view'], 'string'],
            [['layout', 'view'], 'isFile'],
        ];
    }
    public function behaviors()
	{
		return [
				\yii\behaviors\TimestampBehavior::className(),
				\yii\behaviors\BlameableBehavior::className(),
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
            'slug' => Yii::t('app', 'Slug'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
            'layout' => Yii::t('app', 'Layout'),
            'view' => Yii::t('app', 'View'),
        ];
    }
    public function isFile($attribute,$params)
	{
		$filename=Yii::getAlias($this->$attribute);
		$ext=pathinfo($filename, PATHINFO_EXTENSION);
		if($ext==''){
			
			$filename.='.php';
		}
		if(!file_exists($filename)){
	       $this->addError($attribute, 'Non è un file esistente... controlla il percorso!');
	    }
	}
    /**
     * @inheritdoc
     * @return PagesQuery the active query used by this AR class.
     */
    public function getAssets(){
		 $nm_assets=Yii::$app->controller->module->modelNamespace.'\CmsAssets';
		 return $this->hasMany($nm_assets::className(), ['id' => 'asset_id'])
            ->viaTable('cms_rel_asset_page', ['page_id' => 'id'])->orderBy('id');
		
	}
	public function afterSave($insert,$changedAttributes)
	{
		parent::afterSave($insert,$changedAttributes);
		$controllers=Yii::$app->controller->module->sitemapControllers;
		if(!is_array($controllers))$controllers=explode(',',$controllers);
	
		
		if(!empty($controllers)):
		   $n=1;
			foreach($controllers as $controller):
			    $arr_name_controller=explode('\\',$controller);
			    $controller_name=strtolower(str_replace('Controller','',end($arr_name_controller)));
			   
				$pages_model=self::find()->published()->all();
				$dom_name='http://'.Yii::$app->request->serverName;
				$sitemap='<?xml version="1.0" encoding="utf-8"?>
						<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
							<url>
								<loc>'.$dom_name.'</loc>
								<lastmod>'.date('Y-m-d').'</lastmod>
								<changefreq>always</changefreq>
								<priority>1.0</priority>
							</url>';
				 if(is_array($pages_model)):
					foreach($pages_model as $page):
							$sitemap.='<url>
								<loc>'.$dom_name.\yii\helpers\Url::to(['/'.$controller_name.'/page','slug'=>$page->slug]).'</loc>
								<lastmod>'.date('Y-m-d').'</lastmod>
								<changefreq>always</changefreq>
								<priority>1.0</priority>
							</url>';
					endforeach;
				 endif;
		        if(is_object($pages_model)):
					$sitemap.='<url>
						<loc>'.$dom_name.\yii\helpers\Url::to(['/'.$controller_name.'/page','slug'=>$page->slug]).'</loc>
						<lastmod>'.date('Y-m-d').'</lastmod>
						<changefreq>always</changefreq>
						<priority>1.0</priority>
					</url>';
		        endif;
		        $sitemap.='</urlset>';
		
		        file_put_contents('sitemap'.$n.'.xml',$sitemap);
		       $n++;
		    endforeach;
	     endif;
		
	}
	public function beforeDelete()
	{
		
		if (!parent::beforeDelete()) {
										return false;
			}
	   $nm_rel_assets= Yii::$app->controller->module->modelNamespace.'\CmsRelAssetPage';
       $nm_rel_assets::deleteAll(['page_id'=>$this->id]);
    // ...custom code here...
		return true;
	}
    public static function find()
    {
        return new PagesQuery(get_called_class());
    }
}
