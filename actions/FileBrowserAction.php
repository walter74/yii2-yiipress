<?php

namespace walter74\yiipress\actions;

use Yii;
use yii\base\Action;


class FileBrowserAction extends Action
{
   public function run($type='image'){
	                        
	                        switch($type){
								
									case "image":
												$files = \yii\helpers\BaseFileHelper::findFiles(Yii::getAlias($this->controller->module->upload_dir),[
																																						'only' =>  ['*.jpg','*.png','*.jpeg','*.gif']
																																							      
																																					 ]);
												break;
									case "media":
											    $files = \yii\helpers\BaseFileHelper::findFiles(Yii::getAlias($this->controller->module->upload_dir),[
																																						'only' =>  ['*.mp3','*.mp4']
																																							      
																																					 ]);
												break;
									case "file":
											    $files = \yii\helpers\BaseFileHelper::findFiles(Yii::getAlias($this->controller->module->upload_dir),[
																																						'only' =>  ['*.txt','*.pdf','*.doc','*.docx']
																																							      
																																					 ]);
												break;
											
						    }
	                        //$files = \yii\helpers\BaseFileHelper::findFiles(Yii::getAlias($this->controller->module->upload_dir,['only'=>['.jpg','.jpeg','.png','.gif']]));
			                
			                
			                
			                $list_files=[];
			                if(is_array($files)){
								    foreach($files as $key=>$value){
										
										$list_files[]=['nome'=>basename($value),'tipo'=>\yii\helpers\BaseFileHelper::getMimeTypeByExtension($value)];
									
										
										
										}
							}
			              
			                return $this->controller->renderPartial('file_browser',['list_files'=>$list_files,'type'=>$type]);

	   
	   }
}
