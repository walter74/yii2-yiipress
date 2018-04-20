<?php
if(is_dir(Yii::getAlias(Yii::$app->controller->module->plugin_dir).'/'.$model->name)){
				
			   if(is_dir(Yii::getAlias(Yii::$app->controller->module->plugin_dir).'/'.$model->name.'/default')){
				   if(file_exists(Yii::getAlias(Yii::$app->controller->module->plugin_dir).'/'.$model->name.'/default/actions/'.$action.'.php')){
					  echo $this->renderPhpFile(Yii::getAlias(Yii::$app->controller->module->plugin_dir).'/'.$model->name.'/default/actions/'.$action.'.php',['model'=>$model,'action'=>$action]);
					  	   
					}
				}
}
