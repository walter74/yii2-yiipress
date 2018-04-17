<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \plugins\articles\models\CmsArticles;
use \plugins\articles\models\CmsTags;
use \plugins\articles\models\CmsKeywords;
use \plugins\articles\models\CmsUploadCover;
use yii\web\UploadedFile;
/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Cmssections */
/* @var $form ActiveForm */

$model_article = new CmsArticles();
$model_uploadcover = new CmsUploadCover();
$model_tags = new CmsTags();
$model_keywords = new CmsKeywords();    

if($action=='aggiungi'){
			   

				if ($model_article->load(Yii::$app->request->post())) {
				/*	$nm_generic_form=$this->module->modelNamespace.'\CmsGenericFieldForm';
					$nm_generic_model = new $nm_generic_form();
					if(!empty(\yii\web\UploadedFile::getInstances($nm_generic_model, 'image')))
					 {
						
						$nm_generic_model->image = \yii\web\UploadedFile::getInstances($nm_generic_model, 'image')[0];
							
					// var_dump($nm_generic_model->image);
						$model->img=($nm_generic_model->validate())?'data:'.$nm_generic_model->image->type.';base64,'.base64_encode(file_get_contents($nm_generic_model->image->tempName)):'';
					// var_dump($nm_generic_model->errors);
					 }*/
					$model_tags->tags=Yii::$app->request->post('CmsTags')['tags'];
					$model_keywords->keywords=Yii::$app->request->post('CmsKeywords')['keywords'];
					$model_uploadcover->imageFile = UploadedFile::getInstance($model_uploadcover, 'imageFile');
					if(is_object($model_uploadcover->imageFile)&&$model_uploadcover->validate()){
						$time=time();
						//$filename_url=Yii::$app->request->hostName.Yii::getAlias(Yii::$app->controller->module->upload_dir.'/'.$model_article->title .'_'.'cover_#'.$model_article->id.'_'.time(). '.' . $model_uploadcover->imageFile->extension);
						$filename=Yii::getAlias(Yii::$app->controller->module->upload_dir.'/'.$model_article->title .'_'.$time. '.' . $model_uploadcover->imageFile->extension);
						$filename_url=Yii::$app->request->hostName.$filename;
						$model_uploadcover->imageFile->saveAs($filename);
                        $model_article->img=$filename_url;
					}
					if($model_tags->validate()){
				        $model_article->tags=serialize($model_tags->tags);
				    
				    }
					if($model_keywords->validate()){
				        $model_article->keywords=serialize($model_keywords->keywords);
				    
				    }
					
					if ($model_article->save()) {
								Yii::$app->session->setFlash('success','l\'articolo è stato creato correttamente');
								
								
					}
					else
						Yii::$app->session->setFlash('error','Errore creazione articolo!'.json_encode($model_article->errors));
				}

			
		}
?>
<?php
/* @var $this yii\web\View */

$this->title='Aggiungi Articolo';

$this->params['breadcrumbs'][]=[
            'label' => 'Articoli',
            'url' => ['admin/run','plugin_name'=>'articles','action'=>'elenca'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => $this->title,
           
            'template' => "<li><i class='fa fa-plus'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
?>
<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-plus"></i> Aggiungi Articolo</h3>
					<div class="pull-right"></div>
					<?= \yii\widgets\Breadcrumbs::widget([
															'homeLink'=>[
																			'label' => ' DashBoard',
																			'url' => ['admin/index'],
																			'template' => "<li><i class='fa fa-home'>{link}</i></li>\n", // template for this link only
																		],
															'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		 									            ]);?>
					
</div>
 <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Aggiungi Articolo
                          </header>
                          <div class="panel-body">
                             <div class="form">
                                  
								<div class="admin-create_article">
									
                                 <?= $this->render('@plugins/articles/admin/actions/_form',['model'=>$model_article,'model_uploadcover'=>$model_uploadcover,'model_tags'=>$model_tags,'model_keywords'=>$model_keywords])?>
								

								</div><!-- admin-create_sections -->

							</div>

                          </div>
                      </section>
 </div>
