<?php

namespace plugins\articles\models;

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
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_INACTIVE,self::STATUS_PUBLISHED]],
            [['description','meta_description','content','type','tags','keywords'], 'string'],
            [['img'], 'string'],
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
            'type' => Yii::t('app', 'Type'),
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
			    
				
				$typology=$query = self::find()->select('type')->distinct()->all();
				$article_slug_map=["article"=>"articolo","open-source"=>"open-source"];
				
				if(is_array($typology))
				{
					
					
					foreach($typology as $type):
					    $art_type=$type->type;
					    $articles_model=self::find()->where(['type'=>$art_type])->published()->all();
						$dom_name='http://'.Yii::$app->request->serverName;
						$sitemap='<?xml version="1.0" encoding="utf-8"?>
								<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
						if(is_array($articles_model)):
							foreach($articles_model as $article):
									$sitemap.='<url>
										<loc>'.$dom_name.\yii\helpers\Url::to(['/'.$controller_name.'/page','slug'=>isset($article_slug_map[$art_type])?$article_slug_map[$art_type]:$art_type,'id'=>$article->id,'titolo'=>$article->title]).'</loc>
										<lastmod>'.date('Y-m-d').'</lastmod>
										<changefreq>always</changefreq>
										<priority>1.0</priority>
									</url>';
							endforeach;
						endif;
						if(is_object($articles_model)):
							$sitemap.='<url>
								<loc>'.$dom_name.\yii\helpers\Url::to(['/'.$controller_name.'/page','slug'=>isset($article_slug_map[$art_type])?$article_slug_map[$art_type]:$art_type,'id'=>$article->id,'titolo'=>$article->title]).'</loc>
								<lastmod>'.date('Y-m-d').'</lastmod>
								<changefreq>always</changefreq>
								<priority>1.0</priority>
							</url>';
						endif;
						$sitemap.='</urlset>';
		
						file_put_contents('sitemap_article_'.$art_type.'_'.$n.'.xml',$sitemap);
					 
				    endforeach;
						
				  }	
				  if(is_object($typology)){
					    $art_type=$typology->type;
					    $articles_model=self::find()->where(['type'=>$art_type])->published()->all();
						$dom_name='http://'.Yii::$app->request->serverName;
						$sitemap='<?xml version="1.0" encoding="utf-8"?>
								<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
						if(is_array($articles_model)):
							foreach($articles_model as $article):
									$sitemap.='<url>
										<loc>'.$dom_name.\yii\helpers\Url::to(['/'.$controller_name.'/page','slug'=>isset($article_slug_map[$art_type])?$article_slug_map[$art_type]:$art_type,'id'=>$article->id,'titolo'=>$article->title]).'</loc>
										<lastmod>'.date('Y-m-d').'</lastmod>
										<changefreq>always</changefreq>
										<priority>1.0</priority>
									</url>';
							endforeach;
						endif;
						if(is_object($articles_model)):
							$sitemap.='<url>
								<loc>'.$dom_name.\yii\helpers\Url::to(['/'.$controller_name.'/page','slug'=>isset($article_slug_map[$art_type])?$article_slug_map[$art_type]:$art_type,'id'=>$article->id,'titolo'=>$article->title]).'</loc>
								<lastmod>'.date('Y-m-d').'</lastmod>
								<changefreq>always</changefreq>
								<priority>1.0</priority>
							</url>';
						endif;
						$sitemap.='</urlset>';
		
						file_put_contents('sitemap_article_'.$art_type.'_'.$n.'.xml',$sitemap);
						
				  }
				$n++;
		    endforeach;
	     endif;
		
	}
    public static function find()
    {
        return new CmsArticlesQuery(get_called_class());
    }
}
