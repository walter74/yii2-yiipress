<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace plugins\articles\widgets;

use Yii;

class Article extends \yii\bootstrap\Widget
{
    public $modelNamespace='\\plugins\articles\models\CmsArticles';
    public $view_article='view';
    public $breadcrumbs=false;
   
    public function init(){
		   if($this->modelNamespace!=''&&$this->view_article!=''&&is_numeric(Yii::$app->request->get('id'))){
					$nm=$this->modelNamespace;
					$model=$nm::findOne(Yii::$app->request->get('id'));
					$view = $this->getView();
					$view->title = $model->title;
					
					$view->registerMetaTag(['name' => 'description', 'content' => ($model->meta_description!='')?$model->meta_description:$model->description],'article-description');
					
						
						
					$view->registerMetaTag(['name' => 'twitter:description', 'content' => $model->description],'article-twitter-description');
					$view->registerMetaTag(['property' => 'og:description', 'content' => $model->description],'article-og-description');
					$keywords=($model->keywords!='')?unserialize($model->keywords):[];
					$keywords=implode(',',$keywords);
				    $view->registerMetaTag(['name' => 'keywords', 'content' => $keywords],'artcle-keywords');
						
					
			}
	}
    public function run()
    {
      if($this->modelNamespace!=''&&$this->view_article!=''&&is_numeric(Yii::$app->request->get('id'))){
		    $nm=$this->modelNamespace;
			$model=$nm::findOne(Yii::$app->request->get('id'));
			
			echo $this->render($this->view_article,['model'=>$model,'breadcrumbs'=>$this->breadcrumbs]);
      }
    }
}
