<?php

namespace walter74\yiipress\controllers;
use Yii;
class AdminController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
<<<<<<< HEAD
                'class' => \yii\filters\AccessControl::className(),
=======
                'class' => yii\filters\AccessControl::className(),
>>>>>>> 4df8bfe047d938d809d3f02a6202fdb341e85bdf
                //'only' => ['logout','note','clienti','utenti'],
                'rules' => [
                   
                    [
                       
                        'allow' => true,
<<<<<<< HEAD
                        'roles' => [$this->module->permission_admin_controller],
=======
                        'roles' => ['admin'],
>>>>>>> 4df8bfe047d938d809d3f02a6202fdb341e85bdf
                    ],
                    
                   
                    
                ],
            ],
          /*  'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],*/
        ];
    }
   
   
    public function actions(){
		return [
           
            'file-upload'=>[
				'class'	=>	$this->module->actionNamespace.'\FileUploadAction',
			],
            'file-browser'=>[
				'class'	=>	$this->module->actionNamespace.'\FileBrowserAction',
			],
            
        ];
	}
    public function init(){
		
		parent::init();
		$this->layout = $this->module->admin_layout;
		$this->checkPluginActive();
		
	}
	public function checkPluginActive(){
		$nm_plugins=$this->module->modelNamespace.'\CmsPlugins';
		$plugin_model=$nm_plugins::find()->all();
		foreach($plugin_model as $plugin):
		    
			if(is_dir(Yii::getAlias($this->module->plugin_dir).'/'.$plugin->name)){
				
			   if(is_dir(Yii::getAlias($this->module->plugin_dir).'/'.$plugin->name.'/admin')){
				   if(file_exists(Yii::getAlias($this->module->plugin_dir).'/'.$plugin->name.'/admin/sidebar.php')){
					  
					   $this->module->params['sidebar'][]=require(Yii::getAlias($this->module->plugin_dir).'/'.$plugin->name.'/admin/sidebar.php');
					   
					}
					if(file_exists(Yii::getAlias($this->module->plugin_dir).'/'.$plugin->name.'/admin/settings.php')){
					  
					   $this->module->params['settings'][$plugin->name]=require(Yii::getAlias($this->module->plugin_dir).'/'.$plugin->name.'/admin/settings.php');
					   
					}
					if(file_exists(Yii::getAlias($this->module->plugin_dir).'/'.$plugin->name.'/admin/dashboard.php')){
					  
					   $this->module->params['dashboard'][$plugin->name]=require(Yii::getAlias($this->module->plugin_dir).'/'.$plugin->name.'/admin/dashboard.php');
					   
					}
				}
			}
		endforeach;
		
	}
	public function actionError($name,$message){
		
	    return $this->render('../default/error',['name'=>$name,'message'=>$message]);
	
	}
    public function actionIndex()
    {
        
        $nm_pages=$this->module->modelNamespace.'\CmsPages';
        $nm_sections=$this->module->modelNamespace.'\CmsSections';
        $nm_widgets=$this->module->modelNamespace.'\CmsWidgets';
        $nm_menu=$this->module->modelNamespace.'\CmsMenu';
        $nm_plugins=$this->module->modelNamespace.'\CmsPlugins';
        $nm_themes=$this->module->modelNamespace.'\CmsThemes';
        $n_pages=$nm_pages::find()->count();
        $n_sections=$nm_sections::find()->count();
        $n_widgets=$nm_widgets::find()->count();
        $n_menu=$nm_menu::find()->count();
        $n_plugins=$nm_plugins::find()->count();
        $n_themes=$nm_themes::find()->count();
        $n_layouts=count(\yii\helpers\FileHelper::findFiles(Yii::getAlias($this->module->template_layout_dir), ['only'=>['*.php']] ));
        $n_views=count(\yii\helpers\FileHelper::findFiles(Yii::getAlias($this->module->template_views_dir), ['only'=>['*.php']] ));
        $n_media=count(\yii\helpers\BaseFileHelper::findFiles(Yii::getAlias($this->module->upload_dir)));
        return $this->render('index',['n_pages'=>$n_pages,'n_sections'=>$n_sections,'n_widgets'=>$n_widgets,'n_menu'=>$n_menu,'n_plugins'=>$n_plugins,'n_layouts'=>$n_layouts,'n_views'=>$n_views,'n_media'=>$n_media,'n_themes'=>$n_themes]);
    }

    public function actionLayouts($action=null)
    {
       $dir_layouts=Yii::getAlias($this->module->template_layout_dir);
       if($action=="aggiungi"){
		  $upload_form_ns= $this->module->modelNamespace.'\UploadForm';
	      $model=new $upload_form_ns();
		  return $this->render('layouts/add',['model'=>$model]);
	   }
       $files=\yii\helpers\FileHelper::findFiles($dir_layouts, ['only'=>['*.php']] );
       $filesdetails=[];
       
       foreach($files as $file){
		   $filesdetails[]=['file'=>$file,'type'=> \yii\helpers\FileHelper::getMimeType ($file),'updated_at'=>filemtime ($file)];
	   }
       
	   $provider = new \yii\data\ArrayDataProvider([
											'allModels' => $filesdetails,
											'sort' => [
														'attributes' => ['id', 'username', 'email'],
											],
											'pagination' => [
															'pageSize' => 10,
											],
										]);
		
        return $this->render('layouts',['dataProvider'=>$provider]);
    }
    public function actionLayout($file,$action='view',$subaction=null)
    {
       $dir_layouts=Yii::getAlias($this->module->template_layout_dir);
      // echo '*/'.basename(urldecode($file));
       $files=\yii\helpers\FileHelper::findFiles($dir_layouts, ['only'=>[basename(urldecode($file))]] );
       $filesdetails=[];
      // var_dump($files);
       foreach($files as $file){
		   $filesdetails[]=['file'=>$file,'type'=> \yii\helpers\FileHelper::getMimeType ($file),'updated_at'=>filemtime ($file)];
	   }
       if($action=='menu'){
		   $nm_menu=$this->module->modelNamespace.'\CmsMenu';
		   $list_menu=$nm_menu::find()->all();
		   $content=file_get_contents($file);
		   $list_menu_layout=[];
			if(is_array($list_menu)){
				foreach($list_menu as $menu){
					if(strpos($content,$menu->tag)!==false){
						$list_menu_layout[]=$menu;
				    }
				
				}
			     $dataProvider= new \yii\data\ArrayDataProvider([
													'allModels' => $list_menu_layout,
													
													'pagination' => [
																				'pageSize' => 10,
																],
													]);
			}
			//var_dump($list_menu_layout);
			return $this->render('layout/menu',['model'=>$filesdetails[0],'dataProvider'=>$dataProvider]);
	   }
	   
	   if($action=='widgets'){
		   $nm_widget=$this->module->modelNamespace.'\CmsWidgets';
		   $list_widgets=$nm_widget::find()->all();
		   $content=file_get_contents($file);
		   $list_widgets_layout=[];
			if(is_array($list_widgets)){
				foreach($list_widgets as $widget){
					if(strpos($content,$widget->tag)!==false){
						$list_widgets_layout[]=$widget;
				    }
				
				}
			     $dataProvider= new \yii\data\ArrayDataProvider([
													'allModels' => $list_widgets_layout,
													
													'pagination' => [
																				'pageSize' => 10,
																],
													]);
			}
			//var_dump($list_widget_layout);
			return $this->render('layout/widgets',['model'=>$filesdetails[0],'dataProvider'=>$dataProvider]);
	   }
	   
	    if($action=='sections'){
		   $nm_sections=$this->module->modelNamespace.'\CmsSections';
		   $list_sections=$nm_sections::find()->all();
		   $content=file_get_contents($file);
		   $list_sections_layout=[];
			if(is_array($list_sections)){
				foreach($list_sections as $section){
					if(strpos($content,$section->tag)!==false){
						$list_sections_layout[]=$section;
				    }
				
				}
			     $dataProvider= new \yii\data\ArrayDataProvider([
													'allModels' => $list_sections_layout,
													
													'pagination' => [
																				'pageSize' => 10,
																],
													]);
			}
			//var_dump($list_menu_layout);
			return $this->render('layout/sections',['model'=>$filesdetails[0],'dataProvider'=>$dataProvider]);
	      }
	   
	 if($action=="assets"){
			   $nm_rel_assets= Yii::$app->controller->module->modelNamespace.'\CmsRelAssetView';
			   $nm_assets=$this->module->modelNamespace.'\CmsAssets'; 
			    if($subaction=="aggiungi"){
				    
				    $model_assets= new $nm_assets();
				     if($model_assets->load(Yii::$app->request->post())) {
						 $transaction = Yii::$app->db->beginTransaction();
								if ($model_assets->save()) {
									 
									 $model_rel_assets=new $nm_rel_assets();
									 $model_rel_assets->asset_id = $model_assets->id;
									 $model_rel_assets->path = $this->module->template_layout_dir.'/'.basename($file);
									 
									    if($model_rel_assets->save()){
											$transaction->commit();
											Yii::$app->session->setFlash('success','L\'asset/source è stata aggiunto correttamente al layout');
						
											}
										else{
											$transaction->rollBack();
											$errors=var_export($model_rel_assets->errors,true);
											Yii::$app->session->setFlash('error','Errore nell\'associazione layout/Asset!:'.$errors);
										}
								}
								else{
										$transaction->rollBack();
										$errors=var_export($model_assets->errors,true);
										Yii::$app->session->setFlash('error','Errore inserimento Asset!:'.$errors);
									}
								}
					return $this->render('layout/assets/create',['model'=>$filesdetails[0],'model_assets'=>$model_assets]);
				   
				   } 
			       if($subaction=='delete'&& (Yii::$app->request->get('asset_id')!==null))
			       {
						$nm_assets=$this->module->modelNamespace.'\CmsAssets';
						$model_asset= $nm_assets::findOne(Yii::$app->request->get('asset_id'));
						$model_asset->delete();  
				   }
				   if($subaction=='update'&& (Yii::$app->request->get('asset_id')!==null))
			       {
						$nm_assets=$this->module->modelNamespace.'\CmsAssets';
						$model_assets= $nm_assets::findOne(Yii::$app->request->get('asset_id'));
						if($model_assets->load(Yii::$app->request->post())){
							if($model_assets->save()){
									Yii::$app->session->setFlash('success','L\'asset/source è stata aggiornato correttamente nel Layout');
						    }
						    else{
									Yii::$app->session->setFlash('error','L\'asset/source non è stato aggiornato per via dei seguenti errori: '.json_encode($model->errors));
						
							}
						}
					 return $this->render('layout/assets/update',['model'=>$filesdetails[0],'model_assets'=>$model_assets]);  
				   } 
				   $query=(new \yii\db\Query())->select($nm_assets::tableName().'.`id` , '.$nm_assets::tableName().'.`content`,'.$nm_assets::tableName().'.`type`')->from([$nm_rel_assets::tableName(),$nm_assets::tableName()])->where($nm_rel_assets::tableName().".`asset_id` =  `cms_assets`.`id` AND ".$nm_rel_assets::tableName().".`path`='".$this->module->template_layout_dir.'/'.basename($file)."'");
			   //$list_assets_layout = $nm_rel_assets::find()->where(['path'=>$this->module->template_layout_dir.'/'.basename($file)])->all();
			 
				    
				   $dataProvider= new \yii\data\ActiveDataProvider([
													'query' => $query,
													'sort' => [
																'attributes' => ['id'],
																],
																'pagination' => [
																				'pageSize' => 10,
																],
													]);
			       
			       return $this->render('layout/assets',['model'=>$filesdetails[0],'dataProvider'=>$dataProvider]);	
			
			
		}
        return $this->render('layout',['model'=>$filesdetails[0]]);
    }
    public function actionMenu($action='list')
    {
       if($action=='aggiungi'){
			    $menu_form_ns= $this->module->modelNamespace.'\CmsMenu';
				$model = new $menu_form_ns();

				if ($model->load(Yii::$app->request->post())) {
					if ($model->save()) {
								Yii::$app->session->setFlash('success','Il Menù è stata creato correttamente');
					}
					else
						Yii::$app->session->setFlash('error','Errore creazione Menù!');
				}

				return $this->render('menu/create_menu', [
														'model' => $model,
													 ]);
		}
		$menu_search_ns= $this->module->modelNamespace.'\CmsMenuSearch';
		$searchModel = new $menu_search_ns();
		$menu=$this->module->modelNamespace.'\CmsMenu';
		$dataProvider=$searchModel->search(Yii::$app->request->get());
		/*$dataProvider= new \yii\data\ActiveDataProvider([
															'query' => $menu::find(),
															'pagination' => [
																'pageSize' => 20,
															],
														]);*/
        
        return $this->render('menu',['dataProvider'=>$dataProvider,'searchModel'=>$searchModel]);
    }
    public function actionMenuContent($id,$action='view',$subaction=null)
    {
		
		$menu=$this->module->modelNamespace.'\CmsMenu';
		$model=$menu::find()->where(['id'=>$id])->one();
		if($action=="delete"){
			$model->delete(); 
			return $this->redirect(Yii::$app->request->referrer);
		}
		
		if($action=="update"){
			
			  if($model->load(Yii::$app->request->post())) {
					if ($model->save()) {
								Yii::$app->session->setFlash('success',' Menu aggiornato correttamente!');
					}
					else
						Yii::$app->session->setFlash('error','Errore Aggiornamento Menu!');
				}

			 
			
			
			return $this->render('menu_content/update',['model'=>$model]);	
	    
	    
	    }
	    if($action=="pagine"){
<<<<<<< HEAD
			      $rawbody = Yii::$app->request->getRawBody();
			      
			      $json_response = \yii\helpers\Json::decode($rawbody);
			      if(Yii::$app->request->isAjax && !empty($json_response)){
=======
			  
			      if(Yii::$app->request->isAjax&&!empty(\yii\helpers\Json::decode(Yii::$app->request->getRawBody()))){
>>>>>>> 4df8bfe047d938d809d3f02a6202fdb341e85bdf
				        $data_menu = \yii\helpers\Json::decode(Yii::$app->request->getRawBody());
				        //var_dump($data_menu);
				        $validator= new \walter74\yiipress\validators\MenuItemValidator();
						
						$error='';
						if($validator->validate($data_menu,$error)){
						    $model->pages=serialize($data_menu);
						    if($model->save())
						       return Yii::t('app','Il menu è stato salvato corretamente!');
						    else
						       return Yii::t('app','Errore! Menu non salvato!');
						 }
						 else{
						    return Yii::t('app',$error);
						 }
				   }
				    if($subaction=="aggiungi-submenu"){
					 $nm_menu = Yii::$app->controller->module->modelNamespace.'\CmsMenu';
					 $nm_submenu_form = Yii::$app->controller->module->modelNamespace.'\CmsSubMenuForm';
					 $model_submenu_form = new $nm_submenu_form();
					 $list_menu=$nm_menu::find()->asArray()->all();
		             $list_menu=\yii\helpers\ArrayHelper::map($list_menu, 'tag', 'name');
		             $pages=($model->pages=='')?[]:unserialize($model->pages);
		             if($model_submenu_form->load(Yii::$app->request->post())) {
					   $pages[] = Yii::$app->request->post('CmsSubMenuForm');
					   $model->pages = serialize($pages);
					   if($model->save()){
						   Yii::$app->session->setFlash('success','il submenu è stato aggiunto correttamente al menu');
						
						 }
					   else{
						   $errors=var_export($model->errors,true);
					    	Yii::$app->session->setFlash('error','Errore nell\'associazione Menu/SubMenu!:'.$errors);
									
						}
					  }
					
					return $this->render('menu_content/pages/aggiungi_submenu',['model'=>$model,'list_menu'=>$list_menu,'model_submenu_form'=>$model_submenu_form]);
				   
				   } 
				   if($subaction=="aggiungi-link"){
					 $nm_model_link_form=Yii::$app->controller->module->modelNamespace.'\CmsLinkForm';
					 $model_link_form = new $nm_model_link_form();
		             $pages=($model->pages=='')?[]:unserialize($model->pages);
		             if($model_link_form->load(Yii::$app->request->post())&&$model_link_form->validate()) {
						
					   $pages[]=Yii::$app->request->post('CmsLinkForm');
					   $model->pages=serialize($pages);
					   if($model->save()){
						   Yii::$app->session->setFlash('success','Il link è stata aggiunto correttamente al menu');
						
						 }
					   else{
						   $errors=var_export($model->errors,true);
					    	Yii::$app->session->setFlash('error','Errore nell\'associazione Menu/Link!:'.$errors);
									
						}
					  }
					/* $nm_rel_pages= Yii::$app->controller->module->modelNamespace.'\CmsRelMenuPages';
				     $model_rel_pages=new $nm_rel_pages();
				     if($model_rel_pages->load(Yii::$app->request->post())) {
						
									
									 $model_rel_pages->menu_id=$model->id;
									
									    if($model_rel_pages->save()){
											
											Yii::$app->session->setFlash('success','La pagina è stata aggiunta correttamente al menu');
						
											}
										else{
											
											$errors=var_export($model_rel_pages->errors,true);
											Yii::$app->session->setFlash('error','Errore nell\'associazione Menu/Pagina!:'.$errors);
										}
							
								}*/
					return $this->render('menu_content/pages/aggiungi_link',['model'=>$model,'model_link_form'=>$model_link_form]);
				   
				   } 
			      if($subaction=="aggiungi"){
					 $nm_pages=Yii::$app->controller->module->modelNamespace.'\CmsPages';
					 $pagine=$nm_pages::find()->asArray()->all();
		             $lista_pagine=\yii\helpers\ArrayHelper::map($pagine, 'id', 'title');
		             $pages=($model->pages=='')?[]:unserialize($model->pages);
		             if($model->load(Yii::$app->request->post())) {
					   $pages[]=$model->pages;
					   $model->pages=serialize($pages);
					   if($model->save()){
						   Yii::$app->session->setFlash('success','La pagina è stata aggiunta correttamente al menu');
						
						 }
					   else{
						   $errors=var_export($model->errors,true);
					    	Yii::$app->session->setFlash('error','Errore nell\'associazione Menu/Pagina!:'.$errors);
									
						}
					  }
					/* $nm_rel_pages= Yii::$app->controller->module->modelNamespace.'\CmsRelMenuPages';
				     $model_rel_pages=new $nm_rel_pages();
				     if($model_rel_pages->load(Yii::$app->request->post())) {
						
									
									 $model_rel_pages->menu_id=$model->id;
									
									    if($model_rel_pages->save()){
											
											Yii::$app->session->setFlash('success','La pagina è stata aggiunta correttamente al menu');
						
											}
										else{
											
											$errors=var_export($model_rel_pages->errors,true);
											Yii::$app->session->setFlash('error','Errore nell\'associazione Menu/Pagina!:'.$errors);
										}
							
								}*/
					return $this->render('menu_content/pages/aggiungi',['model'=>$model,'lista_pagine'=>$lista_pagine]);
				   
				   } 
				   
			      /* if($subaction=='delete'&& (Yii::$app->request->get('page_id')!==null))
			       {
					$pages=($model->pages=='')?[]:unserialize($model->pages);
					$keys=array_keys($pages,Yii::$app->request->get('page_id'));
					if(is_array($keys)){
						foreach($keys as $key){
							
							unset($pages[$key]);
							
							
						}
					
					}
					$model->pages=serialize($pages);
					$model->save();
				    
				   }*/
				   
				   if($subaction=='delete'&& (Yii::$app->request->get('riga_id')!==null))
			       {
					$pages=($model->pages=='')?[]:unserialize($model->pages);
					
					
					$key=Yii::$app->request->get('riga_id')-1;
				    unset($pages[$key]);
				   
				    $pages_reindexed=[];
		             foreach($pages as $value){
						 $pages_reindexed[]=$value;
						 
						 }
					//var_dump($pages);
					$model->pages=serialize($pages_reindexed);
					$model->save();
				    return $this->redirect(Yii::$app->request->referrer);
				   }
				    
				    
				    $dataProvider= new \yii\data\ArrayDataProvider([
													'allModels' => $model->listpages,
													
													'pagination' => [
																				'pageSize' => 50,
																],
													]);
			       
			       return $this->render('menu_content/pages',['model'=>$model,'dataProvider'=>$dataProvider]);	
			
			
			}
	    
	    return $this->render('menu_content',['model'=>$model]);
    }
    public function actionSettings(){
		$nm_settings_form= $this->module->modelNamespace.'\CmsSettingsForm';
		$model= new $nm_settings_form();
		
		if(Yii::$app->request->post('CmsSettingsForm')){
			//var_dump(Yii::$app->request->post());
			//echo __DIR__ .'/../settings2.php';
			//validiamo i campi
			//var_dump(Yii::$app->request->post());
			if($model->load(Yii::$app->request->post())&&$model->validate()){
				$json=json_encode(Yii::$app->request->post('CmsSettingsForm'));
				if(file_put_contents(__DIR__ .'/../settings.php',$json)!==false){
					Yii::$app->session->setFlash('success',Yii::t('app','Le nuove impostazioni sono state salvate correttamente!'));
			    //Riaggiorniamo per permettere al modulo di settare le nuove impostazioni e visualizzarele sui campi del form
					return $this->refresh();
				}
				else
					Yii::$app->session->setFlash('error',Yii::t('app','Errore!Le nuove impostazioni non sono state salvate!'));
			}
			else{
			   Yii::$app->session->setFlash('error',Yii::t('app','Errore!'.json_encode($model->errors)));
			  // var_dump($model->errors);
			}
		
		}
	    return $this->render('settings',['model'=>$model]);	
	
	}
    public function actionPage($id='main',$action="view",$subaction=null)
    {
		
		$pages_search_ns= $this->module->modelNamespace.'\CmsPagesSearch';
		$searchModel = new $pages_search_ns();
		$page=$this->module->modelNamespace.'\CmsPages';
		$model=$page::find()->where(['id'=>$id])->one();
		if(!is_object($model)){
          return $this->runAction('error',['name'=>"Errore 404!",'message'=>'Pagina non Trovata']);
         
         }
		if($action=="delete"){
			$model->delete(); 
			return $this->redirect(Yii::$app->request->referrer);
		}
        if($action=="update"){
			if($model->load(Yii::$app->request->post())) {
				     $nm_generic_form=$this->module->modelNamespace.'\CmsGenericFieldForm';
					 $nm_generic_model = new $nm_generic_form();
<<<<<<< HEAD
					 $uploaded_file=\yii\web\UploadedFile::getInstances($nm_generic_model, 'image');
					 if(!empty($uploaded_file))
=======
					 if(!empty(\yii\web\UploadedFile::getInstances($nm_generic_model, 'image')))
>>>>>>> 4df8bfe047d938d809d3f02a6202fdb341e85bdf
					 {
						$nm_generic_model->image = \yii\web\UploadedFile::getInstances($nm_generic_model, 'image')[0];
					// var_dump($nm_generic_model->image);
						$model->img=($nm_generic_model->validate())?'data:'.$nm_generic_model->image->type.';base64,'.base64_encode(file_get_contents($nm_generic_model->image->tempName)):'';
				     }
					 if ($model->save()) {
								Yii::$app->session->setFlash('success','La Pagina è stata aggiornata correttamente');
					 }
					 else
						Yii::$app->session->setFlash('error','Errore Aggiornamento pagina!');
			}

			 
			
			
			return $this->render('page/update',['model'=>$model]);	
	    
	    
	    }
	    
	    if($action=="assets"){
			  
			 
			   if($subaction=="aggiungi"){
				    $nm_assets=$this->module->modelNamespace.'\CmsAssets';
				    $model_assets= new $nm_assets();
				     if($model_assets->load(Yii::$app->request->post())) {
						 $transaction = Yii::$app->db->beginTransaction();
								if ($model_assets->save()) {
									 $nm_rel_assets= Yii::$app->controller->module->modelNamespace.'\CmsRelAssetPage';
									 $model_rel_assets=new $nm_rel_assets();
									 $model_rel_assets->asset_id=$model_assets->id;
									 $model_rel_assets->page_id=$model->id;
									    if($model_rel_assets->save()){
											$transaction->commit();
											Yii::$app->session->setFlash('success','L\'asset/source è stata aggiunto correttamente alla pagina');
						
											}
										else{
											$transaction->rollBack();
											$errors=var_export($model_rel_assets->errors,true);
											Yii::$app->session->setFlash('error','Errore nell\'associazione Pagina/Asset!:'.$errors);
										}
								}
								else{
										$transaction->rollBack();
										$errors=var_export($model_assets->errors,true);
										Yii::$app->session->setFlash('error','Errore inserimento Asset!:'.$errors);
									}
								}
					return $this->render('page/assets/create',['model'=>$model,'model_assets'=>$model_assets]);
				   
				   } 
			       if($subaction=='delete'&& (Yii::$app->request->get('asset_id')!==null))
			       {
				    $nm_assets=$this->module->modelNamespace.'\CmsAssets';
				    $model_asset= $nm_assets::findOne(Yii::$app->request->get('asset_id'));
					$model_asset->delete();  
				   }
				   if($subaction=='update'&& (Yii::$app->request->get('asset_id')!==null))
			       {
				    $nm_assets=$this->module->modelNamespace.'\CmsAssets';
				    $model_assets= $nm_assets::findOne(Yii::$app->request->get('asset_id'));
						if($model_assets->load(Yii::$app->request->post())){
							if($model_assets->save()){
									Yii::$app->session->setFlash('success','L\'asset/source è stata aggiornato correttamente alla pagina');
						    }
						    else{
									Yii::$app->session->setFlash('error','L\'asset/source non è stato aggiornato per via dei seguenti errori: '.json_encode($model->errors));
						
							}
						}
					 return $this->render('page/assets/update',['model'=>$model,'model_assets'=>$model_assets]);
				   }
				   
				    $dataProvider= new \yii\data\ArrayDataProvider([
													'allModels' => $model->assets,
													'sort' => [
																'attributes' => ['id'],
																],
																'pagination' => [
																				'pageSize' => 10,
																],
													]);
			       
			       return $this->render('page/assets',['model'=>$model,'dataProvider'=>$dataProvider]);	
			
			
			}
		if($action=="widgets"){
		   $file_layout=Yii::getAlias($model->layout);
		   $nm_widget=$this->module->modelNamespace.'\CmsWidgets';
		   $list_widgets=$nm_widget::find()->all();
		   if(pathinfo($file_layout,PATHINFO_EXTENSION)=='')
				$file_layout.=".php";
		      
		   $content=file_get_contents($file_layout);
		   $list_widgets_layout=[];
			if(is_array($list_widgets)){
				foreach($list_widgets as $widget){
					if(strpos($content,$widget->tag)!==false){
						$list_widgets_layout[]=$widget;
				    }
				
				}
			     $dataProvider_layout= new \yii\data\ArrayDataProvider([
													'allModels' => $list_widgets_layout,
													
													'pagination' => [
																				'pageSize' => 10,
																],
													]);
			}
			
		   $file_view=Yii::getAlias($model->view);
		    if(pathinfo($file_view,PATHINFO_EXTENSION)=='')
				$file_view.=".php";
				
		   $content=file_get_contents($file_view);
		   $list_widgets_views=[];
			if(is_array($list_widgets)){
				foreach($list_widgets as $widget){
					if(strpos($content,$widget->tag)!==false){
						$list_widgets_views[]=$widget;
				    }
				
				}
			     $dataProvider_views= new \yii\data\ArrayDataProvider([
													'allModels' => $list_widgets_views,
													
													'pagination' => [
																				'pageSize' => 10,
																],
													]);
			}
			//var_dump($list_widget_layout);
			
			
			
			
			
			return $this->render('page/widgets',['model'=>$model,'dataProvider_layout'=>$dataProvider_layout,'dataProvider_views'=>$dataProvider_views]);
	  
		}
		if($action=='sections'){
			$file_layout=Yii::getAlias($model->layout);
			if(pathinfo($file_layout,PATHINFO_EXTENSION)=='')
				$file_layout.=".php";
		      
		   $content=file_get_contents($file_layout);
		   $nm_sections=$this->module->modelNamespace.'\CmsSections';
		   $list_sections=$nm_sections::find()->all();
		  
		   $list_sections_layout=[];
			if(is_array($list_sections)){
				foreach($list_sections as $section){
					if(strpos($content,$section->tag)!==false){
						$list_sections_layout[]=$section;
				    }
				
				}
			     $dataProvider_layout= new \yii\data\ArrayDataProvider([
													'allModels' => $list_sections_layout,
													
													'pagination' => [
																				'pageSize' => 10,
																],
													]);
													
			}
			$file_view=Yii::getAlias($model->view);
		    if(pathinfo($file_view,PATHINFO_EXTENSION)=='')
				$file_view.=".php";
				
			$content=file_get_contents($file_view);
			$list_sections_views=[];
			if(is_array($list_sections)){
				foreach($list_sections as $section){
					if(strpos($content,$section->tag)!==false){
						$list_sections_views[]=$section;
				    }
				
				}
			     $dataProvider_views= new \yii\data\ArrayDataProvider([
													'allModels' => $list_sections_views,
													
													'pagination' => [
																				'pageSize' => 10,
																],
													]);
			}
			
			//var_dump($list_menu_layout);
			return $this->render('page/sections',['model'=>$model,'dataProvider_layout'=>$dataProvider_layout,'dataProvider_views'=>$dataProvider_views]);
	  
	      }
        
        if($action=='menu'){
		   $file_layout=Yii::getAlias($model->layout);
		   if(pathinfo($file_layout,PATHINFO_EXTENSION)=='')
				$file_layout.=".php";
		   $nm_menu=$this->module->modelNamespace.'\CmsMenu';
		   $list_menu=$nm_menu::find()->all();
		   $content=file_get_contents($file_layout);
		   $list_menu_layout=[];
			if(is_array($list_menu)){
				foreach($list_menu as $menu){
					if(strpos($content,$menu->tag)!==false){
						$list_menu_layout[]=$menu;
				    }
				
				}
			     $dataProvider_layout= new \yii\data\ArrayDataProvider([
													'allModels' => $list_menu_layout,
													
													'pagination' => [
																				'pageSize' => 10,
																],
													]);
			}
			
			
			$file_view=Yii::getAlias($model->view);
		    if(pathinfo($file_view,PATHINFO_EXTENSION)=='')
				$file_view.=".php";
				
			$content=file_get_contents($file_view);
			$list_menu_views=[];
			if(is_array($list_menu)){
				foreach($list_menu as $menu){
					if(strpos($content,$menu->tag)!==false){
						$list_menu_views[]=$menu;
				    }
				
				}
			     $dataProvider_views= new \yii\data\ArrayDataProvider([
													'allModels' => $list_menu_views,
													
													'pagination' => [
																				'pageSize' => 10,
																],
													]);
			}
			//var_dump($list_menu_layout);
			return $this->render('page/menu',['model'=>$model,'dataProvider_layout'=>$dataProvider_layout,'dataProvider_views'=>$dataProvider_views]);
	  
		}
        
        return $this->render('page',['model'=>$model]);
    }
    public function actionPages($action='list')
    {
		if($action=='aggiungi'){
			    $pages_form_ns= $this->module->modelNamespace.'\CmsPages';
				$model = new $pages_form_ns();

				if ($model->load(Yii::$app->request->post())) {
					$nm_generic_form=$this->module->modelNamespace.'\CmsGenericFieldForm';
					$nm_generic_model = new $nm_generic_form();
<<<<<<< HEAD
					
					$uploaded_file=\yii\web\UploadedFile::getInstances($nm_generic_model, 'image');
					if(!empty($uploaded_file))
=======
					if(!empty(\yii\web\UploadedFile::getInstances($nm_generic_model, 'image')))
>>>>>>> 4df8bfe047d938d809d3f02a6202fdb341e85bdf
					 {
						
						$nm_generic_model->image = \yii\web\UploadedFile::getInstances($nm_generic_model, 'image')[0];
							
					// var_dump($nm_generic_model->image);
						$model->img=($nm_generic_model->validate())?'data:'.$nm_generic_model->image->type.';base64,'.base64_encode(file_get_contents($nm_generic_model->image->tempName)):'';
					// var_dump($nm_generic_model->errors);
					 }
					if ($model->save()) {
								Yii::$app->session->setFlash('success','La Pagina è stata creata correttamente');
					}
					else
						Yii::$app->session->setFlash('error','Errore creazione pagina!');
				}

				return $this->render('create_pages', [
														'model' => $model,
													 ]);
		}
		$pages_search_ns= $this->module->modelNamespace.'\CmsPagesSearch';
		$searchModel = new $pages_search_ns();
		$pages=$this->module->modelNamespace.'\CmsPages';
		$dataProvider= $searchModel->search(Yii::$app->request->get());
        return $this->render('pages',['dataProvider'=>$dataProvider,'searchModel'=>$searchModel]);
    }
    public function actionSection($id,$action='view')
    {
		
		$section=$this->module->modelNamespace.'\CmsSections';
		$model=$section::find()->where(['id'=>$id])->one();
		if($action=="delete"){
			$model->delete(); 
			return $this->redirect(Yii::$app->request->referrer);
		}
		
		if($action=="update"){
			
			  if($model->load(Yii::$app->request->post())) {
					if ($model->save()) {
								Yii::$app->session->setFlash('success',' Sezione aggiornata correttamente!');
					}
					else
						Yii::$app->session->setFlash('error','Errore Aggiornamento Sezione!');
				}

			 
			
			
			return $this->render('section/update',['model'=>$model]);	
	    
	    
	    }
	   if($action=='sub-sections'){
			
		  /* $nm_sections=$this->module->modelNamespace.'\CmsSections';
		   $list_sections=$nm_sections::find()->all();
		   $sub_sections=[];
			if(is_array($list_sections)){
				foreach($list_sections as $section){
					if(strpos($model->content,$section->tag)!==false){
						$sub_sections[]=$section;
				    }
				
				}
			    
													
			}*/
			 $dataProvider_sub_sections= new \yii\data\ArrayDataProvider([
													'allModels' => $model->subsections,
													
													'pagination' => [
																				'pageSize' => 10,
																],
													]);
			
			//var_dump($list_menu_layout);
			return $this->render('section/sub-sections',['model'=>$model,'dataProvider_sub_sections'=>$dataProvider_sub_sections]);
	  
	     }
	     if($action=='widgets'){
			
		 /*  $nm_widgets=$this->module->modelNamespace.'\CmsWidgets';
		   $list_widgets=$nm_widgets::find()->all();
		   $widgets=[];
			if(is_array($list_widgets)){
				foreach($list_widgets as $widget){
					if(strpos($model->content,$widget->tag)!==false){
						$widgets[]=$widget;
				    }
				
				}
			    
													
			}*/
			
			 $dataProvider_widgets= new \yii\data\ArrayDataProvider([
													'allModels' => $model->widgets,
													
													'pagination' => [
																				'pageSize' => 10,
																],
													]);
			//var_dump($list_menu_layout);
			return $this->render('section/widgets',['model'=>$model,'dataProvider_widgets'=>$dataProvider_widgets]);
	  
	     }
	     if($action=='menu'){
			
		  /* $nm_menu=$this->module->modelNamespace.'\CmsMenu';
		   $list_menu=$nm_menu::find()->all();
		   $menu=[];
			if(is_array($list_menu)){
				foreach($list_menu as $menu_content){
					if(strpos($model->content,$menu_content->tag)!==false){
						$menu[]=$menu_content;
				    }
				
				}
			    
													
			}*/
			 $dataProvider_menu= new \yii\data\ArrayDataProvider([
													'allModels' => $model->menu,
													
													'pagination' => [
																				'pageSize' => 10,
																],
													]);
			
			//var_dump($list_menu_layout);
			return $this->render('section/menu',['model'=>$model,'dataProvider_menu'=>$dataProvider_menu]);
	  
	     }
	    return $this->render('section',['model'=>$model]);
    }
    public function actionSections($action='list')
    {
		if($action=='aggiungi'){
			    $sections_form_ns= $this->module->modelNamespace.'\CmsSections';
				$model = new $sections_form_ns();

				if ($model->load(Yii::$app->request->post())) {
					if ($model->save()) {
								Yii::$app->session->setFlash('success','La Sezione(blocco) è stata creato correttamente');
					}
					else
						Yii::$app->session->setFlash('error','Errore creazione sezione/blocco!');
				}

				return $this->render('sections/create_sections', [
														'model' => $model,
													 ]);
		}
		$sections_search_ns= $this->module->modelNamespace.'\CmsSectionsSearch';
		$searchModel = new $sections_search_ns();
		$sections=$this->module->modelNamespace.'\CmsSections';
		$dataProvider=$searchModel->search(Yii::$app->request->get());
		/*$dataProvider= new \yii\data\ActiveDataProvider([
															'query' => $sections::find(),
															'pagination' => [
																'pageSize' => 20,
															],
														]);*/ 
        return $this->render('sections',['dataProvider'=>$dataProvider,'searchModel'=>$searchModel]);
    }


 public function actionView($file,$action='view',$subaction=null)
    {
       $dir_views=Yii::getAlias($this->module->template_views_dir);
      // echo '*/'.basename(urldecode($file));
       $files=\yii\helpers\FileHelper::findFiles($dir_views, ['only'=>[basename(urldecode($file))]] );
       $filesdetails=[];
      // var_dump($files);
       foreach($files as $file){
		   $filesdetails[]=['file'=>$file,'type'=> \yii\helpers\FileHelper::getMimeType ($file),'updated_at'=>filemtime ($file)];
	   }
       if($action=='menu'){
		   $nm_menu=$this->module->modelNamespace.'\CmsMenu';
		   $list_menu=$nm_menu::find()->all();
		   $content=file_get_contents($file);
		   $list_menu_view=[];
			if(is_array($list_menu)){
				foreach($list_menu as $menu){
					if(strpos($content,$menu->tag)!==false){
						$list_menu_view[]=$menu;
				    }
				
				}
			     $dataProvider= new \yii\data\ArrayDataProvider([
													'allModels' => $list_menu_view,
													
													'pagination' => [
																				'pageSize' => 10,
																],
													]);
			}
			//var_dump($list_menu_view);
			return $this->render('view/menu',['model'=>$filesdetails[0],'dataProvider'=>$dataProvider]);
	   }
	   
	   
	   
	   if($action=='widgets'){
		   $nm_widget=$this->module->modelNamespace.'\CmsWidgets';
		   $list_widgets=$nm_widget::find()->all();
		   $content=file_get_contents($file);
		   $list_widgets_view=[];
			if(is_array($list_widgets)){
				foreach($list_widgets as $widget){
					if(strpos($content,$widget->tag)!==false){
						$list_widgets_view[]=$widget;
				    }
				
				}
			     $dataProvider= new \yii\data\ArrayDataProvider([
													'allModels' => $list_widgets_view,
													
													'pagination' => [
																				'pageSize' => 10,
																],
													]);
			}
			//var_dump($list_widget_view);
			return $this->render('view/widgets',['model'=>$filesdetails[0],'dataProvider'=>$dataProvider]);
	   }
	   
	   
	   
	    if($action=='sections'){
		   $nm_sections=$this->module->modelNamespace.'\CmsSections';
		   $list_sections=$nm_sections::find()->all();
		   $content=file_get_contents($file);
		   $list_sections_view=[];
			if(is_array($list_sections)){
				foreach($list_sections as $section){
					if(strpos($content,$section->tag)!==false){
						$list_sections_view[]=$section;
				    }
				
				}
			     $dataProvider= new \yii\data\ArrayDataProvider([
													'allModels' => $list_sections_view,
													
													'pagination' => [
																				'pageSize' => 10,
																],
													]);
			}
			//var_dump($list_menu_view);
			return $this->render('view/sections',['model'=>$filesdetails[0],'dataProvider'=>$dataProvider]);
	    }
	      
	      
	    if($action=="assets"){
			   $nm_rel_assets= Yii::$app->controller->module->modelNamespace.'\CmsRelAssetView';
			   $nm_assets=$this->module->modelNamespace.'\CmsAssets'; 
			    if($subaction=="aggiungi"){
				    
				    $model_assets= new $nm_assets();
				     if($model_assets->load(Yii::$app->request->post())) {
						 $transaction = Yii::$app->db->beginTransaction();
								if ($model_assets->save()) {
									 
									 $model_rel_assets=new $nm_rel_assets();
									 $model_rel_assets->asset_id = $model_assets->id;
									 $model_rel_assets->path = $this->module->template_views_dir.'/'.basename($file);
									 
									    if($model_rel_assets->save()){
											$transaction->commit();
											Yii::$app->session->setFlash('success','L\'asset/source è stata aggiunto correttamente alla view');
						
											}
										else{
											$transaction->rollBack();
											$errors=var_export($model_rel_assets->errors,true);
											Yii::$app->session->setFlash('error','Errore nell\'associazione View/Asset!:'.$errors);
										}
								}
								else{
										$transaction->rollBack();
										$errors=var_export($model_assets->errors,true);
										Yii::$app->session->setFlash('error','Errore inserimento Asset!:'.$errors);
									}
								}
					return $this->render('view/assets/create',['model'=>$filesdetails[0],'model_assets'=>$model_assets]);
				   
				   } 
			       if($subaction=='delete'&& (Yii::$app->request->get('asset_id')!==null))
			       {
						$nm_assets=$this->module->modelNamespace.'\CmsAssets';
						$model_asset= $nm_assets::findOne(Yii::$app->request->get('asset_id'));
						$model_asset->delete();  
				   }
				   if($subaction=='update'&& (Yii::$app->request->get('asset_id')!==null))
			       {
						$nm_assets=$this->module->modelNamespace.'\CmsAssets';
						$model_assets= $nm_assets::findOne(Yii::$app->request->get('asset_id'));
						if($model_assets->load(Yii::$app->request->post())){
							if($model_assets->save()){
									Yii::$app->session->setFlash('success','L\'asset/source è stata aggiornato correttamente nella view');
						    }
						    else{
									Yii::$app->session->setFlash('error','L\'asset/source non è stato aggiornato per via dei seguenti errori: '.json_encode($model->errors));
						
							}
						}
					 return $this->render('view/assets/update',['model'=>$filesdetails[0],'model_assets'=>$model_assets]);  
				   }
				    $query=(new \yii\db\Query())->select($nm_assets::tableName().'.`id` , '.$nm_assets::tableName().'.`content`,'.$nm_assets::tableName().'.`type`')->from([$nm_rel_assets::tableName(),$nm_assets::tableName()])->where($nm_rel_assets::tableName().".`asset_id` =  `cms_assets`.`id` AND ".$nm_rel_assets::tableName().".`path`='".$this->module->template_views_dir.'/'.basename($file)."'");
			   //$list_assets_view = $nm_rel_assets::find()->where(['path'=>$this->module->template_view_dir.'/'.basename($file)])->all();
			 
				    
				    $dataProvider= new \yii\data\ActiveDataProvider([
													'query' => $query,
													'sort' => [
																'attributes' => ['id'],
																],
																'pagination' => [
																				'pageSize' => 10,
																],
													]);
			       
			       return $this->render('view/assets',['model'=>$filesdetails[0],'dataProvider'=>$dataProvider]);	
			
			
		}
		
        return $this->render('view',['model'=>$filesdetails[0]]);
    }


    public function actionViews($action=null)
    {
       $dir_views=Yii::getAlias($this->module->template_views_dir);
       
       if($action=="aggiungi"){
		  $upload_form_ns= $this->module->modelNamespace.'\UploadForm';
	      $model=new $upload_form_ns();
		  return $this->render('views/add',['model'=>$model]);
	   }
       
       
       $files=\yii\helpers\FileHelper::findFiles($dir_views, ['only'=>['*.php','*.html','*.txt']] );
       $filesdetails=[];
       
      
      
      
       foreach($files as $file){
		   $filesdetails[]=['file'=>$file,'type'=> \yii\helpers\FileHelper::getMimeType ($file),'updated_at'=>filemtime ($file)];
	   }
       
	   $provider = new \yii\data\ArrayDataProvider([
											'allModels' => $filesdetails,
											'sort' => [
														'attributes' => ['id', 'username', 'email'],
											],
											'pagination' => [
															'pageSize' => 10,
											],
										]);
		
        return $this->render('views',['dataProvider'=>$provider]);
        
    }
    
    public function actionWidget($id,$action='view')
    {
	    $widget=$this->module->modelNamespace.'\CmsWidgets';
		$model=$widget::find()->where(['id'=>$id])->one();
		if($action=="delete"){
			$model->delete(); 
			return $this->redirect(Yii::$app->request->referrer);
		}
		
		if($action=="update"){
			
			  if($model->load(Yii::$app->request->post())) {
					if ($model->save()) {
								Yii::$app->session->setFlash('success',' Record Widget aggiornato correttamente!');
					}
					else
						Yii::$app->session->setFlash('error','Errore Aggiornamento record Widget!');
				}

			 
			
			
			return $this->render('widget/update',['model'=>$model]);	
	    
	    
	    }
	   
	    
	    return $this->render('widget',['model'=>$model]);
	
	}
	
    public function actionWidgets($action='list')
    {
        if($action=='aggiungi'){
			    $widgets_form_ns= $this->module->modelNamespace.'\CmsWidgets';
				$model = new $widgets_form_ns();

				if ($model->load(Yii::$app->request->post())) {
					if ($model->save()) {
								Yii::$app->session->setFlash('success','Il Widget è stato inserito correttamente');
					}
					else
						Yii::$app->session->setFlash('error','Errore inserimento Widget!');
				}

				return $this->render('widgets/insert_widget', [
														'model' => $model,
													 ]);
		}
		$widgets_search_ns= $this->module->modelNamespace.'\CmsWidgetsSearch';
		$searchModel = new $widgets_search_ns();
		//$widgets=$this->module->modelNamespace.'\CmsWidgets';
		$dataProvider=$searchModel->search(Yii::$app->request->get());
		/*$dataProvider= new \yii\data\ActiveDataProvider([
															'query' => $widgets::find(),
															'pagination' => [
																'pageSize' => 20,
															],
														]);*/
        
        return $this->render('widgets',['dataProvider'=>$dataProvider,'searchModel'=>$searchModel]);
       
       //return $this->render('widgets');
    }
    public function actionMedia($action="list"){
		
	
	    switch($action){
			   
			   case "aggiungi":
			                $upload_form_ns= $this->module->modelNamespace.'\UploadForm';
	                        $model=new $upload_form_ns();
			                return $this->render('media/add',['model'=>$model]);
			                break;
			   case "delete":
			                if(Yii::$app->request->isAjax){
								
								if(unlink(Yii::getAlias($this->module->upload_dir).'/'.Yii::$app->request->post('nome')))
								 return 1;
								else
								 return 0;
								
								}
			                break;
			   default:
			                $files = \yii\helpers\BaseFileHelper::findFiles(Yii::getAlias($this->module->upload_dir));
			                $list_files=[];
			                if(is_array($files)){
								    foreach($files as $key=>$value){
										
										$list_files[]=['nome'=>basename($value),'tipo'=>\yii\helpers\BaseFileHelper::getMimeTypeByExtension($value)];
									
										
										
										}
							}
			                $pagination = new \yii\data\Pagination([
																	'totalCount' => count($list_files),
																	'pageSize' => '4',
																	//'page'=>Yii::$app->request->get('page'),
																	
																	]);
							$array_list_files=array_chunk($list_files,$pagination->pageSize);
							
<<<<<<< HEAD
							$list_files=count($list_files)!=0?$array_list_files[$pagination->page]:[];
=======
							$list_files=$array_list_files[$pagination->page];
>>>>>>> 4df8bfe047d938d809d3f02a6202fdb341e85bdf
							//$list_files = array_slice($list_files, ($pagination->page-1)*$pagination->pageSize, (($pagination->page*$pagination->pageSize)> $pagination->totalCount)?($pagination->pageSize-($pagination->page*$pagination->pageSize -$pagination->totalCount)):$pagination->pageSize);										
			                return $this->render('media/list',['list_files'=>$list_files,'pagination'=>$pagination]);
			                
			  
			  
			  
			  }
	
	}
	
	public function actionThemes($action='active'){
		
		if(Yii::$app->request->isAjax){
			if(Yii::$app->request->get('action')=='activate'&&Yii::$app->request->post('keylist')){
				$themes_activate=json_decode(Yii::$app->request->post('keylist'));
				
				if(is_array($themes_activate)&&!empty($themes_activate)){
					$themes_activated=[];
					foreach($themes_activate as $theme){
						
						$nm_themes=$this->module->modelNamespace.'\CmsThemes';
						$theme_model=new $nm_themes();
						$theme_model->name=$theme;
						if($theme_model->save()){
							  $themes_activated[]=$theme;
						}
					
					
					}
					
					Yii::$app->session->setFlash('info',Yii::t('app',implode(',',$themes_activated).' {n,plural,=0{Nessun theme è stato attivato} =1{ è stato attivato} other{ sono stati attivati}}!', ['n' => count($themes_activated)]));
						
						
				}
			  
			
			}
			
		 return;	
		}
	   if($action=="aggiungi"){
		  $upload_form_ns= $this->module->modelNamespace.'\UploadForm';
	      $model=new $upload_form_ns();
		  return $this->render('themes/add',['model'=>$model]);
		  
		  
		  }
	   if($action=='active'){
		  $nm_themes=$this->module->modelNamespace.'\CmsThemes';
		
		  $provider = new \yii\data\ActiveDataProvider([
											'query' => $nm_themes::find(),
											
											'sort' => [
														'attributes' => ['name'],
											],
											'pagination' => [
															'pageSize' => 10,
											],
										]);
		  return $this->render('themes/active',['dataProvider'=>$provider]);
	   }
	   if($action=='inactive'){
		  $dir_themes=Yii::getAlias($this->module->theme_dir);
       
      // $files=\yii\helpers\FileHelper::findFiles($dir_themes,['recursive'=>false]);
			$files=scandir($dir_themes);
			foreach($files as $key=>$file){
				if($file==='.'||$file==='..'){
						unset($files[$key]);
	      
	      
				} 
			}
            
            //delete theme activated
            $nm_themes=$this->module->modelNamespace.'\CmsThemes';
			$themes_act= $nm_themes::find()->asArray()->all();
            
            $themes_act=\yii\helpers\ArrayHelper::map($themes_act,'id', 'name');
            
          
            $files=array_diff($files,$themes_act);
      
			$filesdetails=[];
      // var_dump($files);
       
			foreach($files as $file){
				$filesdetails[]=['file'=>$file,'type'=> \yii\helpers\FileHelper::getMimeType(Yii::getAlias($this->module->theme_dir.'/'.$file)),'updated_at'=>filemtime(Yii::getAlias($this->module->theme_dir.'/'.$file))];
			}
       
			$provider = new \yii\data\ArrayDataProvider([
											'allModels' => $filesdetails,
											'key' => 'file',
											'sort' => [
														'attributes' => ['file', 'type'],
											],
											'pagination' => [
															'pageSize' => 10,
											],
										]);
		
			return $this->render('themes',['dataProvider'=>$provider]);	
       }					
	
	}
	
	public function actionTheme($id,$action="view"){
			$nm_themes = $this->module->modelNamespace.'\CmsThemes';
			$model = $nm_themes::findOne($id);
			if($action=="delete"){
				
				$model->delete(); 
				return $this->redirect(Yii::$app->request->referrer);
			
			}
	
	}
	
	
	public function actionPlugins($action='active'){
		
		if(Yii::$app->request->isAjax){
			if(Yii::$app->request->get('action')=='activate'&&Yii::$app->request->post('keylist')){
				$plugins_activate=json_decode(Yii::$app->request->post('keylist'));
				
				if(is_array($plugins_activate)&&!empty($plugins_activate)){
					$plugins_activated=[];
					foreach($plugins_activate as $plugin){
						
						$nm_plugins=$this->module->modelNamespace.'\CmsPlugins';
						$plugin_model=new $nm_plugins();
						$plugin_model->name=$plugin;
						if($plugin_model->save()){
							  $plugins_activated[]=$plugin;
						}
					
					
					}
					
					Yii::$app->session->setFlash('info',Yii::t('app',implode(',',$plugins_activated).' {n,plural,=0{Nessun Plugin è stato attivato} =1{ è stato attivato} other{ sono stati attivati}}!', ['n' => count($plugins_activated)]));
						
						
				}
			  
			
			}
			
		 return;	
		}
	   if($action=="aggiungi"){
		  $upload_form_ns= $this->module->modelNamespace.'\UploadForm';
	      $model=new $upload_form_ns();
		  return $this->render('plugins/add',['model'=>$model]);
		  
		  
		  }
	   if($action=='active'){
		  $nm_plugins=$this->module->modelNamespace.'\CmsPlugins';
		
		  $provider = new \yii\data\ActiveDataProvider([
											'query' => $nm_plugins::find(),
											
											'sort' => [
														'attributes' => ['name'],
											],
											'pagination' => [
															'pageSize' => 10,
											],
										]);
		  return $this->render('plugins/active',['dataProvider'=>$provider]);
	   }
	   if($action=='inactive'){
		  $dir_plugins=Yii::getAlias($this->module->plugin_dir);
       
      // $files=\yii\helpers\FileHelper::findFiles($dir_plugins,['recursive'=>false]);
			$files=scandir($dir_plugins);
			foreach($files as $key=>$file){
				if($file==='.'||$file==='..'){
						unset($files[$key]);
	      
	      
				} 
			}
            
            //delete plugin activated
            $nm_plugins=$this->module->modelNamespace.'\CmsPlugins';
			$plugins_act= $nm_plugins::find()->asArray()->all();
            
            $plugins_act=\yii\helpers\ArrayHelper::map($plugins_act,'id', 'name');
            
          
            $files=array_diff($files,$plugins_act);
      
			$filesdetails=[];
      // var_dump($files);
       
			foreach($files as $file){
				$filesdetails[]=['file'=>$file,'type'=> \yii\helpers\FileHelper::getMimeType(Yii::getAlias($this->module->plugin_dir.'/'.$file)),'updated_at'=>filemtime(Yii::getAlias($this->module->plugin_dir.'/'.$file))];
			}
       
			$provider = new \yii\data\ArrayDataProvider([
											'allModels' => $filesdetails,
											'key' => 'file',
											'sort' => [
														'attributes' => ['file', 'type'],
											],
											'pagination' => [
															'pageSize' => 10,
											],
										]);
		
			return $this->render('plugins',['dataProvider'=>$provider]);	
       }					
	
	}
    public function actionPlugin($id,$action="view"){
			$nm_plugins = $this->module->modelNamespace.'\CmsPlugins';
			$model = $nm_plugins::findOne($id);
			if($action=="delete"){
				
				$model->delete(); 
				return $this->redirect(Yii::$app->request->referrer);
			
			}
	
	}
	public function actionRun($plugin_name,$action=null){
			$nm_plugins = $this->module->modelNamespace.'\CmsPlugins';
			$model = $nm_plugins::find()->where(['name'=>$plugin_name])->one();
            return $this->render('run',['model'=>$model,'action'=>$action]);
    
    
    }
}
