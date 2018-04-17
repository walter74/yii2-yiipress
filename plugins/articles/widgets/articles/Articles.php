<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace plugins\articles\widgets\articles;

use Yii;


class Articles extends \yii\bootstrap\Widget
{
   public $modelNamespace;
   public $condition=[];
   public $limit=10;
   public $orderby;
   public $pageSize=5;
   public $pagination=true;
   public $content_view="_content_view";
   public $main_view='view';
   public $slug="article";
   public $slug_articles="articles";
   public $breadcrumbs=false;
   public $edit_permission="admin";
   public $plugin_name="articles";
   public function run()
    {
      
      $modelNamespace=$this->modelNamespace;
      
      $this->content_view=Yii::getAlias($this->content_view);
      $this->main_view=Yii::getAlias($this->main_view);
      
      $view = $this->getView();
      if($modelNamespace!=''){
		
		if(empty($this->condition))
			$query=$modelNamespace::find()->published();
		else
			$query=$modelNamespace::find()->where($this->condition)->published();
		
		 $query = isset($this->orderby)?$query->orderBy($this->orderby):$query;
		 $query = is_numeric($this->limit)?$query->limit($this->limit):$query;
		
		if(Yii::$app->request->get('CmsArticlesTagSearch')){
			$searchModel= new \plugins\articles\models\CmsArticlesTagSearch();
			$dataProvider=$searchModel->search(Yii::$app->request->get(),$this->pagination,$this->pageSize);
			return $this->render($this->main_view,['dataProvider'=>$dataProvider,'content_view'=>$this->content_view,'slug'=>$this->slug,'slug_articles'=>$this->slug_articles,'edit_permission'=>$this->edit_permission,'plugin_name'=>$this->plugin_name]);
    
			
		}
		if(Yii::$app->request->get('CmsArticlesWordSearch')){
			$searchModel= new \plugins\articles\models\CmsArticlesWordSearch();
			$dataProvider=$searchModel->search(Yii::$app->request->get(),$this->pagination,$this->pageSize);
			return $this->render($this->main_view,['dataProvider'=>$dataProvider,'content_view'=>$this->content_view,'slug'=>$this->slug,'slug_articles'=>$this->slug_articles,'edit_permission'=>$this->edit_permission,'plugin_name'=>$this->plugin_name]);
    
			
		}
		if(is_object($query)){
			$dataProvider=new \yii\data\ActiveDataProvider([
                        'query'=>$query,
                        'pagination' => ($this->pagination!=false)?[
                                        // 'limit'=>$this->limit,
                                         'route'=>(Yii::$app->controller->module->action_page_root!==null)?Yii::$app->controller->module->action_page_root:Yii::$app->controller->id.'/'.Yii::$app->controller->action->id,
                                         'pageSize' => $this->pageSize,
                                          'params'   => ['slug'=>Yii::$app->request->get("slug"),'page'=>is_numeric(Yii::$app->request->get("page"))?Yii::$app->request->get("page"):1],
                                         ]:false, 
                                        ]);
        }
      }
      return $this->render($this->main_view,['dataProvider'=>$dataProvider,'content_view'=>$this->content_view,'slug'=>$this->slug,'slug_articles'=>$this->slug_articles,'edit_permission'=>$this->edit_permission,'plugin_name'=>$this->plugin_name,"breadcrumbs"=>$this->breadcrumbs]);
      
    }
}
