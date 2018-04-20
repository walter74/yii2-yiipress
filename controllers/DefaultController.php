<?php

namespace walter74\yiipress\controllers;

use yii\web\Controller;
use Yii;
/**
 * Default controller for the `cms` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $published=true;
    public $ajax_answer="";
    public $n_ajax_call=0;
    public static $page2show;
    public static $widgetsPage=[];
    public function behaviors()
    {
		return [ 
				'access' => [
						'class' => \yii\filters\AccessControl::className(),
                //'only' => ['logout','note','clienti','utenti'],
						'rules' => [
                   
										[
                       
										'allow' => true,
										'roles' => ($this->published)?['?','@']:['admin'],
										],
										[
                       
										'allow' => ['private'],
										'roles' => ['admin'],
										],
                   
                    
									],
				],
				/*'pageCache' => [
					'class' => 'yii\filters\PageCache',*/
				//'only' => ['index'],
				    //'duration' => 180,
					/*'dependency' => [
						'class' => 'yii\caching\ChainedDependency',
						'dependencies'=>[ (new \yii\caching\DbDependency())
											[
											 'class'=>'yii\caching\DbDependency',
											 'sql' => 'SELECT MAX(updated_at) FROM cms_pages'
										 
											],
											[
											 'class'=>'yii\caching\DbDependency',
											 'sql' => 'SELECT MAX(updated_at) FROM cms_widgets',
										 
											],
											[
											 'class'=>'yii\caching\DbDependency',
											 'sql' => 'SELECT MAX(updated_at) FROM cms_sections',
										 
											],
											[
											 'class'=>'yii\caching\DbDependency',
											 'sql' => 'SELECT MAX(updated_at) FROM cms_menu',
										 
											],
											[
											 'class'=>'yii\caching\DbDependency',
											 'sql' => 'SELECT MAX(created_at) FROM cms_assets',
										 
											],
											
						
						]
					
					],*/
					/*'variations' => [
						\Yii::$app->language,
						\Yii::$app->request->get('slug'),
						\Yii::$app->request->get('page'),
					]
				],*/
		];
    }
    public function init(){
		
			parent::init();
			
			$nm_settings_form=$this->module->modelNamespace.'\CmsSettingsForm';
			$this->published=($nm_settings_form::STATUS_PUBLISHED==$this->module->status||$nm_settings_form::STATUS_MAINTENANCE==$this->module->status);
			
	
	}
    
    public function actionIndex()
    {
      
       $this->runAction('page');
      
        
    }
    public function actionError($name,$message){
		
	    return $this->render(($this->module->error_view_default)?$this->module->error_view_default:'error',['name'=>$name,'message'=>$message]);
	
	}
	public function actionMaintenance(){
		$nm_settings_form=$this->module->modelNamespace.'\CmsSettingsForm';
		if($this->module->status!=$nm_settings_form::STATUS_MAINTENANCE)
			return $this->redirect(($this->module->action_page_root)?[$this->module->action_page_root,'slug'=>$this->module->home_page]:[$this->id.'/page','slug'=>$this->module->home_page]);
		
	    $this->layout=$this->module->maintenanceLayout;
	    $content = $this->renderContent(null);
	    echo $this->ReplacementContent($content);
	
	}
    public function actionPage($slug=null)
    {
        $nm_settings_form=$this->module->modelNamespace.'\CmsSettingsForm';
       
            
        if($this->module->status==$nm_settings_form::STATUS_MAINTENANCE)
			return $this->redirect(($this->module->action_maintenance_root)?[$this->module->action_maintenance_root]:[$this->id.'/maintenance']);
		
			
        $slug=($slug===null)?$this->module->home_page:$slug;
        
     /*   $model_page_name=$this->module->modelNamespace.'\CmsPages';
        $model_page=$model_page_name::find()->where(['slug'=>$slug])->published()->one();*/
        if(!is_object($model_page=$this->checkPage($slug))){
          return $this->runAction('error',['name'=>"Errore 404!",'message'=>'Pagina non Trovata']);
         
         }
        $this->layout=$model_page->layout;
       // $view=$model_page->view;
        self::$page2show = $this->render(($this->module->main_view_default)?$this->module->main_view_default:'view',['model'=>$model_page,'dataView'=>[]]);
       
       //section replacement
        $model_sections_name=$this->module->modelNamespace.'\CmsSections';
        $model_sections= $model_sections_name::find()->all();
        $loop_number=0;
         self::$page2show = $this->ReplaceRecursiveSections(self::$page2show,$model_sections,$loop_number);
       
	    
	    
	    //menu replacement
	      self::$page2show=$this->ReplaceRecursiveMenu(self::$page2show);
      /*  $model_menu_name=$this->module->modelNamespace.'\CmsMenu';
        $model_menu= $model_menu_name::find()->all();
        foreach($model_menu as $menu){
	        //control of presence of placeholder
	        if(strpos(self::$page2show,$menu->tag)!==false)
	        {
	          $items=[];
	          $config=[];
	          if(is_array(json_decode($menu->config,true))){
				            $config = json_decode($menu->config,true);
					       
			  }
			  if(is_array($menu->listpages)){
					        foreach($menu->listpages as $page){
								if(is_object($page)){
									$items[]=['label'=>($page->title_alt!='')?$page->title_alt:$page->title,'url'=>[($this->module->action_page_root)?$this->module->action_page_root:'//'.$this->route,'slug'=>$page->slug],'active'=>$page->slug==Yii::$app->request->get('slug')];
						        }
						        if(is_array($page)){
									$items[]=$page;
							    }
						    }
			  }
			  $config['items']=$items;
			  $menu_html=\yii\widgets\Menu::widget($config);
	          self::$page2show=str_replace($menu->tag,$menu_html,self::$page2show);
	       }   
	    }*/
	    //widget replaement
	    $model_widgets_name=$this->module->modelNamespace.'\CmsWidgets';
        $model_widgets= $model_widgets_name::find()->all();
      /*     foreach($model_widgets as $widget){
	        //control of presence of placeholder
	        if(strpos(self::$page2show,$widget->tag)!==false){
	          $config=[];
	         
			  if(is_array(json_decode($widget->args,true))){
				            $config = json_decode($widget->args,true);
					       
			  }
			  
			  $widget_classname=$widget->classname;
			  $widget_html=$widget_classname::widget($config);
	          self::$page2show=str_replace($widget->tag,$widget_html,self::$page2show);
	       }
	    }*/
	     $loop_number=0;
	    self::$page2show = $this->ReplaceRecursiveWidgets(self::$page2show,$model_widgets,$loop_number);
	  
	  //  self::$page2show=str_replace('@web',\Yii::getAlias('@web'),self::$page2show);
	    self::$page2show=str_replace('/@web/',\Yii::getAlias('@web'),self::$page2show);
		self::$page2show=str_replace('@web/',\Yii::getAlias('@web'),self::$page2show);
		self::$page2show=str_replace('/@web',\Yii::getAlias('@web'),self::$page2show);
		
        //$this->ShowDynamicContent(self::$page2show);
       // var_dump(self::$widgetsPage);
        echo self::$page2show;
        
    }
    public function MenuReplacement($page2show){
		$model_menu_name=$this->module->modelNamespace.'\CmsMenu';
		$model_menu= $model_menu_name::find()->all();
        foreach($model_menu as $menu){
	        //control of presence of placeholder
	        if(strpos($page2show,$menu->tag)!==false)
	        {
	          $items=[];
	          $config=[];
	          if(is_array(json_decode($menu->config,true))){
				            $config = json_decode($menu->config,true);
					       
			  }
			  if(is_array($menu->listpages)){
					        foreach($menu->listpages as $page){
								if(is_object($page)){
									$items[]=['label'=>($page->title_alt!='')?$page->title_alt:$page->title,'url'=>[($this->module->action_page_root)?$this->module->action_page_root:'//'.$this->route,'slug'=>$page->slug],'active'=>$page->slug==Yii::$app->request->get('slug')];
						        }
						        if(is_array($page)){
									$items[]=$page;
							    }
						    }
			  }
			  $config['items']=$items;
			  $menu_html=\yii\widgets\Menu::widget($config);
	          $page2show=str_replace($menu->tag,$menu_html,$page2show);
	       }   
	    }
	}
    public function checkPage($slug){
		// $slug=(trim($slug)=='')?$slug:$this->module->home_page;
		 $model_page_name=$this->module->modelNamespace.'\CmsPages';
		 $model_page=$model_page_name::find()->where(['slug'=>$slug])->published()->one();
		 if(is_object($model_page)){
			if(($this->module->theme!=null)&&($model_page->theme!=$this->module->theme)){
				return null;
			}
		 }
		 return $model_page;
		
		}
	
	public function ReplaceRecursiveSections($content,$model_sections,&$loop_number,$max_loop=10000){
		
		foreach($model_sections as $section){
			
			if(!is_object($section)){
				return $content;
			}
			//control of presence of placeholder 
			if(strpos($content,$section->tag)!==false){
				$section->content=$this->filterContent($section->content);
				$content=str_replace($section->tag,$section->content,$content);
				$loop_number++;
				
				if($loop_number>=$max_loop)
					break;
				
				$content=$this->ReplaceRecursiveSections($content,$model_sections,$loop_number,$max_loop);
			}
	   
			
		}
		return $content;
	}
	private function filterContent($content) {
		return \yii\helpers\HtmlPurifier::process($content, function ($config) {
	
											$config->set('HTML.SafeIframe', true);
											// $config->set('URI.AllowedSchemes', array('data' => true)); 
										    $config->set('HTML.MaxImgLength',null);
	                                        $config->set('CSS.MaxImgLength',null);
											$config->set('URI.SafeIframeRegexp', '%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/|www\.google\.com/maps/embed)%'); //allow YouTube and Vimeo and google map
											$config->getHTMLDefinition(true)->addAttribute('iframe', 'allowfullscreen', 'Bool');
											$config->getHTMLDefinition(true)
													->addElement('video', 'Block', 'Optional: (source, Flow) | (Flow, source) | Flow', 'Common', 
																array( 
																		'src' => 'URI', 
																		'type' => 'Text', 
																		'width' => 'Length', 
																		'height' => 'Length', 
																		'poster' => 'URI', 
																		'preload' => 'Enum#auto,metadata,none', 
																		'controls' => 'Bool', 
																		));
											$config->getHTMLDefinition(true)
													->addElement('source', 'Block', 'Flow', 'Common',
																array(
																		'src' => 'URI',
																		'type' => 'Text',
																	));
		});
		
	}
	public function ReplaceRecursiveWidgets($content,$model_widgets,&$loop_number,$max_loop=10000){
		
		foreach($model_widgets as $widget){
			
			if(!is_object($widget)){
				return $content;
			}
			//control of presence of placeholder 
			if(strpos($content,$widget->tag)!==false){
				$config=[];
	         
			   if(is_array(json_decode($widget->args,true))){
				            $config = json_decode($widget->args,true);
					       
			    }
			  
			    $widget_classname=$widget->classname; 
			   // $widget_html=$widget_classname::widget($config);
	           // $content=str_replace($widget->tag,$widget_html,$content);
	           // var_dump($config);
	            $content_widget=$this->renderPartial('@walter74/yii2-yiipress/views/default/_renderWidget',['widget_classname'=>$widget_classname,'config'=>$config]);
			 	$content=str_replace($widget->tag,$content_widget,$content);
				//self::$widgetsPage[]=$widget->tag;
				
				$loop_number++;
				
				if($loop_number>=$max_loop)
					break;
				
				$content=$this->ReplaceRecursiveWidgets($content,$model_widgets,$loop_number,$max_loop);
			}
	   
			
		}
		return $content;
	}
    public function ReplaceAndLoadRecursiveWidgets($content,$model_widgets,&$loop_number,$max_loop=10000){
		
		foreach($model_widgets as $widget){
			
			if(!is_object($widget)){
				return $content;
			}
			//control of presence of placeholder 
			if(strpos($content,$widget->tag)!==false){
				$config=[];
	         
			   if(is_array(json_decode($widget->args,true))){
				            $config = json_decode($widget->args,true);
					       
			    }
			  
			    $widget_classname=$widget->classname; 
			   // $widget_html=$widget_classname::widget($config);
	           // $content=str_replace($widget->tag,$widget_html,$content);
	           // var_dump($config);
	            $content_widget=$this->renderPartial('@module/views/default/_renderWidget',['widget_classname'=>$widget_classname,'config'=>$config]);
			 	$content=str_replace($widget->tag,$content_widget,$content);
				//self::$widgetsPage[]=$widget->tag;
				
				$loop_number++;
				
				if($loop_number>=$max_loop)
					break;
				
				$content=$this->ReplaceAndLoadRecursiveWidgets($content,$model_widgets,$loop_number,$max_loop);
			}
	   
			
		}
		return $content;
	}
	public function ReplaceRecursiveMenu($content){
				 //menu replacement
        $model_menu_name=$this->module->modelNamespace.'\CmsMenu';
        $model_menu= $model_menu_name::find()->all();
        foreach($model_menu as $menu){
	        //control of presence of placeholder
	        if(strpos($content,$menu->tag)!==false)
	        {
	          $items=[];
	          $config=[];
	          if(is_array(json_decode($menu->config,true))){
				            $config = json_decode($menu->config,true);
					       
			  }
			  if(is_array($menu->listpages)){
					        foreach($menu->listpages as $page){
								if(is_object($page)){
									$items[]=['label'=>($page->title_alt!='')?$page->title_alt:$page->title,'url'=>[($this->module->action_page_root)?$this->module->action_page_root:'//'.$this->route,'slug'=>$page->slug],'active'=>$page->slug==Yii::$app->request->get('slug')];
						        }
						        if(is_array($page)){
									$items[]=$page;
									if(array_key_exists("submenu",$page)){
										$model_submenu= $model_menu_name::find()->where(['tag'=>$page["submenu"]])->one();
										$submenu_content=$this->ReplaceRecursiveMenu($page["submenu"]);
										$submenu_content="<a href='#'>".$model_submenu->name."</a>".$submenu_content;
										$items[]=['label'=>$submenu_content];//$submenu_content;
								    }
									else{
										$items[]=$page;
									}
							    }
						   
						    
						    }
			  }
			  $config['items']=$items;
			  $config['encodeLabels']=false;
			  $classname_menu=($menu->classname!='')?$menu->classname:"\yii\widgets\Menu";
			  $menu_html=$classname_menu::widget($config);
	          return $content=str_replace($menu->tag,$menu_html,$content);
	          
			}   
		  }
		
		
		
		}
	public function ReplacementContent($content){
			 //section replacement
        $model_sections_name=$this->module->modelNamespace.'\CmsSections';
        $model_sections= $model_sections_name::find()->all();
        $loop_number=0;
        $content=$this->ReplaceRecursiveSections($content,$model_sections,$loop_number);
       
	    
	    
	    //menu replacement
        $model_menu_name=$this->module->modelNamespace.'\CmsMenu';
        $model_menu= $model_menu_name::find()->all();
        foreach($model_menu as $menu){
	        //control of presence of placeholder
	        if(strpos($content,$menu->tag)!==false)
	        {
	          $items=[];
	          $config=[];
	          if(is_array(json_decode($menu->config,true))){
				            $config = json_decode($menu->config,true);
					       
			  }
			  if(is_array($menu->listpages)){
					        foreach($menu->listpages as $page){
						    $items[]=['label'=>($page->title_alt!='')?$page->title_alt:$page->title,'url'=>\yii\helpers\Url::to([($this->module->action_page_root)?$this->module->action_page_root:'//'.$this->route,'slug'=>$page->slug])];
						    
						    }
			  }
			  $config['items']=$items;
			  $menu_html=\yii\widgets\Menu::widget($config);
	          $content=str_replace($menu->tag,$menu_html,$content);
	       }   
	    }
	    //widget replaement
	    $model_widgets_name=$this->module->modelNamespace.'\CmsWidgets';
        $model_widgets= $model_widgets_name::find()->all();
        foreach($model_widgets as $widget){
	        //control of presence of placeholder
	        if(strpos($content,$widget->tag)!==false){
	          $config=[];
	         
			  if(is_array(json_decode($widget->args,true))){
				            $config = json_decode($widget->args,true);
					       
			  }
			  
			  $widget_classname=$widget->classname;
			  $widget_html=$widget_classname::widget($config);
	          $content=str_replace($widget->tag,$widget_html,$content);
	       }
	    }
	    $content=str_replace('@web',\Yii::getAlias('@web'),$content);
		
        //$this->ShowDynamicContent($content);
        return $content;
	
	}
	public function actionPrivate($slug=null)
    {
        $nm_settings_form=$this->module->modelNamespace.'\CmsSettingsForm';
       	$slug=($slug===null)?$this->module->home_page:$slug;
        $model_page_name=$this->module->modelNamespace.'\CmsPages';
		$model_page=$model_page_name::find()->where(['slug'=>$slug])->one();
        $this->layout=$model_page->layout;
       
        self::$page2show = $this->render(($this->module->main_view_default)?$this->module->main_view_default:'view',['model'=>$model_page,'dataView'=>[]]);
       
       //section replacement
        $model_sections_name=$this->module->modelNamespace.'\CmsSections';
        $model_sections= $model_sections_name::find()->all();
        $loop_number=0;
         self::$page2show = $this->ReplaceRecursiveSections(self::$page2show,$model_sections,$loop_number);
       
	    
	    
	    //menu replacement
	    self::$page2show=$this->ReplaceRecursiveMenu(self::$page2show);
      /*  $model_menu_name=$this->module->modelNamespace.'\CmsMenu';
        $model_menu= $model_menu_name::find()->all();
        foreach($model_menu as $menu){
	        //control of presence of placeholder
	        if(strpos(self::$page2show,$menu->tag)!==false)
	        {
	          $items=[];
	          $config=[];
	          if(is_array(json_decode($menu->config,true))){
				            $config = json_decode($menu->config,true);
					       
			  }
			  if(is_array($menu->listpages)){
					        foreach($menu->listpages as $page){
								if(is_object($page)){
									$items[]=['label'=>($page->title_alt!='')?$page->title_alt:$page->title,'url'=>[($this->module->action_page_root)?$this->module->action_page_root:'//'.$this->route,'slug'=>$page->slug],'active'=>$page->slug==Yii::$app->request->get('slug')];
						        }
						        if(is_array($page)){
									if(array_key_exists("submenu",$page)){
										
										$items[]=$page;
								    }
									else{
										$items[]=$page;
									}
							    }
						   
						    
						    }
			  }
			  $config['items']=$items;
			  $menu_html=\yii\widgets\Menu::widget($config);
	          self::$page2show=str_replace($menu->tag,$menu_html,self::$page2show);
	       }   
	    }*/
	    //widget replaement
	    $model_widgets_name=$this->module->modelNamespace.'\CmsWidgets';
        $model_widgets= $model_widgets_name::find()->all();
    
	     $loop_number=0;
	    self::$page2show = $this->ReplaceRecursiveWidgets(self::$page2show,$model_widgets,$loop_number);
	  
	    //self::$page2show=str_replace('@web',\Yii::getAlias('@web'),self::$page2show);
	    self::$page2show=str_replace('/@web/',\Yii::getAlias('@web'),self::$page2show);
		self::$page2show=str_replace('@web/',\Yii::getAlias('@web'),self::$page2show);
		self::$page2show=str_replace('/@web',\Yii::getAlias('@web'),self::$page2show);
		
        //$this->ShowDynamicContent(self::$page2show);
       // var_dump(self::$widgetsPage);
        if(!Yii::$app->request->isAjax)
				echo self::$page2show;
		else
		        echo $this->ajax_answer;
        
    }
    public function actionRun($plugin_name,$action=null){
			$nm_plugins = $this->module->modelNamespace.'\CmsPlugins';
			$model = $nm_plugins::find()->where(['name'=>$plugin_name])->one();
            return $this->renderAjax('@module/views/default/run',['model'=>$model,'action'=>$action]);
    
    
    }
}
