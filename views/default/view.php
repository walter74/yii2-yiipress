<?php
$nm_default_controller=Yii::$app->controller->module->controllerNamespace.'\DefaultController';
//$this->attachBehavior('default',Yii::createObject('app\modules\cms\behaviors\DefaultBehavior'));
//in this view we have to insert assets and source even the ones inside the widgets and menu located in layout and view
$this->title=$model->title;
if(is_array($model->assets)): 
 
	foreach($model->assets as $asset):
		$className=$asset->className();
		if($asset->type==$className::TYPE_ASSET)
				$this->registerAssetBundle($asset->content);
		if($asset->type==$className::TYPE_CSS){
			    
				if($asset->depends!=''||$asset->position!=''){ 
					
					if($asset->position==''){
						
						$this->registerCssFile($asset->content,['depends'=>$asset->depends]); 
					}
					if($asset->depends==''){
						
					    $this->registerCssFile($asset->content,['position'=>$asset->position]);
					} 
					if(($asset->depends!='') && ($asset->position!='')){
						
						$this->registerCssFile($asset->content,['position'=>$asset->position,'depends'=>$asset->depends]);
					}  
				}
				else
					$this->registerCssFile($asset->content);
		}     
		if($asset->type==$className::TYPE_CSS_CODE)
				$this->registerCss($asset->content);
		if($asset->type==$className::TYPE_SCRIPT){
		        if($asset->position!='')
					$this->registerJsFile($asset->content,$asset->position); 
				else
				    $this->registerJsFile($asset->content);
		}
		if($asset->type==$className::TYPE_JS){
		        if($asset->position!='')
					$this->registerJsFile($asset->content,['position'=>$asset->position]); 
				else
				    $this->registerJsFile($asset->content); 
		}
		if($asset->type==$className::TYPE_METATAG){
			    
				$this->registerMetaTag(json_decode($asset->content)); 
		}
		if($asset->type==$className::TYPE_LINKTAG)
				$this->registerMetaTag(json_decode($asset->content)); 
				
	endforeach;
endif;

$nm_rel_assets= Yii::$app->controller->module->modelNamespace.'\CmsRelAssetView';
$nm_assets=Yii::$app->controller->module->modelNamespace.'\CmsAssets'; 
$layout_name=Yii::getAlias($model->layout);
$query=(new \yii\db\Query())->select($nm_assets::tableName().'.`id` , '.$nm_assets::tableName().'.`content`,'.$nm_assets::tableName().'.`type` ,'.$nm_assets::tableName().'.`position` ,'.$nm_assets::tableName().'.`depends`')->from([$nm_rel_assets::tableName(),$nm_assets::tableName()])->where($nm_rel_assets::tableName().".`asset_id` =  `cms_assets`.`id` AND ".$nm_rel_assets::tableName().".`path`='".Yii::$app->controller->module->template_layout_dir.'/'.basename($layout_name).'.php'."'");
$rows = $query->all();
	 
foreach($rows as $asset):

		if($asset['type']==$nm_assets::TYPE_ASSET)
				$this->registerAssetBundle($asset['content']);
		if($asset['type']==$nm_assets::TYPE_CSS){
			    
				if($asset['depends']!=''||$asset['position']!=''){ 
					
					if($asset['position']==''){
						
						$this->registerCssFile($asset['content'],['depends'=>$asset['depends']]); 
					}
					if($asset['depends']==''){
						
					    $this->registerCssFile($asset['content'],['position'=>$asset['position']]);
					} 
					if(($asset['depends']!='') && ($asset['position']!='')){
						
						$this->registerCssFile($asset['content'],['position'=>$asset['position'],'depends'=>$asset['depends']]);
					}  
				}
				else
					$this->registerCssFile($asset['content']);
		}     
		if($asset['type']==$nm_assets::TYPE_CSS_CODE)
				$this->registerCss($asset['content']);
		if($asset['type']==$nm_assets::TYPE_SCRIPT){
		        if($asset['position']!='')
					$this->registerJsFile($asset['content'],$asset['position']); 
				else
				    $this->registerJsFile($asset['content']);
		}
		if($asset['type']==$nm_assets::TYPE_JS){
		        if($asset['position']!='')
					$this->registerJsFile($asset['content'],['position'=>$asset['position']]); 
				else
				    $this->registerJsFile($asset['content']); 
		}
		if($asset['type']==$nm_assets::TYPE_METATAG)
				$this->registerMetaTag(json_decode($asset['content'])); 
		if($asset['type']==$nm_assets::TYPE_LINKTAG)
				$this->registerMetaTag(json_decode($asset['content'])); 
endforeach;
$view_name=Yii::getAlias($model->view);
$query=(new \yii\db\Query())->select($nm_assets::tableName().'.`id` , '.$nm_assets::tableName().'.`content`,'.$nm_assets::tableName().'.`type` ,'.$nm_assets::tableName().'.`position` ,'.$nm_assets::tableName().'.`depends`')->from([$nm_rel_assets::tableName(),$nm_assets::tableName()])->where($nm_rel_assets::tableName().".`asset_id` =  `cms_assets`.`id` AND ".$nm_rel_assets::tableName().".`path`='".Yii::$app->controller->module->template_views_dir.'/'.basename($view_name).'.php'."'");
$rows = $query->all();
foreach($rows as $asset):


		if($asset['type']==$nm_assets::TYPE_ASSET)
				$this->registerAssetBundle($asset['content']);
		if($asset['type']==$nm_assets::TYPE_CSS){
			    
				if($asset['depends']!=''||$asset['position']!=''){ 
					
					if($asset['position']==''){
						
						$this->registerCssFile($asset['content'],['depends'=>$asset['depends']]); 
					}
					if($asset['depends']==''){
						
					    $this->registerCssFile($asset['content'],['position'=>$asset['position']]);
					} 
					if(($asset['depends']!='') && ($asset['position']!='')){
						
						$this->registerCssFile($asset['content'],['position'=>$asset['position'],'depends'=>$asset['depends']]);
					}  
				}
				else
					$this->registerCssFile($asset['content']);
		}     
		if($asset['type']==$nm_assets::TYPE_CSS_CODE)
				$this->registerCss($asset['content']);
		if($asset['type']==$nm_assets::TYPE_SCRIPT){
		        if($asset['position']!='')
					$this->registerJsFile($asset['content'],$asset['position']); 
				else
				    $this->registerJsFile($asset['content']);
		}
		if($asset['type']==$nm_assets::TYPE_JS){
		        if($asset['position']!='')
					$this->registerJsFile($asset['content'],['position'=>$asset['position']]); 
				else
				    $this->registerJsFile($asset['content']); 
		}
		if($asset['type']==$nm_assets::TYPE_METATAG)
				$this->registerMetaTag(json_decode($asset['content'])); 
		if($asset['type']==$nm_assets::TYPE_LINKTAG)
				$this->registerMetaTag(json_decode($asset['content'])); 
endforeach;



//check widget inside layout and load on array

$nm_widget=Yii::$app->controller->module->modelNamespace.'\CmsWidgets';
$list_widgets=$nm_widget::find()->all();
$content=file_get_contents(Yii::getAlias($model->layout).'.php');
//unfolding the section to check widget inside sections
$model_sections_name=Yii::$app->controller->module->modelNamespace.'\CmsSections';
$model_sections= $model_sections_name::find()->all();
$loop_number=0;
$content=Yii::$app->controller->ReplaceRecursiveSections($content,$model_sections,$loop_number);
//loading widget
$loop_number=0;
$content=Yii::$app->controller->ReplaceRecursiveWidgets($content,$list_widgets,$loop_number);
//var_dump($nm_default_controller::$widgetsPage);
/*$list_widgets_page=[];

if(is_array($list_widgets)){
				foreach($list_widgets as $widget){
					if(strpos($content,$widget->tag)!==false){
						$list_widgets_page[]=$widget;
				    }
				
				}
			  
}*/

$content=file_get_contents(Yii::getAlias($model->view).'.php');
//unfolding of sections
$loop_number=0; 
$content=Yii::$app->controller->ReplaceRecursiveSections($content,$model_sections,$loop_number);
//check widget inside view and load on array
$content=Yii::$app->controller->ReplaceRecursiveWidgets($content,$list_widgets,$loop_number);
//var_dump($nm_default_controller::$widgetsPage);
/*
if(is_array($list_widgets)){
				foreach($list_widgets as $widget){
					if(strpos($content,$widget->tag)!==false){
						$list_widgets_page[]=$widget;
				    }
				
				}
			  
}*/
//Now we've to load widgets to permittto register assets inside them by using  widget init function

/*
foreach($list_widgets_page as $widget):
			  $config=[];
	         
			  if(is_array(json_decode($widget->args,true))){
				            $config = json_decode($widget->args,true);
					       
			  }
			  
			  $widget_classname=$widget->classname;
			  new $widget_classname($config);
			  
		
endforeach;*/


 echo $this->render($model->view,$dataView);

/*
$content_entire_page=Yii::$app->controller->render($model->view,$dataView);
$model_sections_name=Yii::$app->controller->layout=$model->layout;
$model_sections_name=Yii::$app->controller->module->modelNamespace.'\CmsSections';
$model_sections= $model_sections_name::find()->all();
$loop_number=0;
$content_entire_page=Yii::$app->controller->ReplaceRecursiveSections($content_entire_page,$model_sections,$loop_number);*/
/*echo $content_fin;*/

?>
