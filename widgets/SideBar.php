<?php

namespace walter74\yiipress\widgets;


class SideBar extends \yii\widgets\Menu
{
 public $encodeLabels = false;
 public $options=['class'=>'sidebar-menu'];
 public $submenuTemplate= "\n<ul class=\"sub\">\n{items}\n</ul>\n";   
 public $activeCssClass="active";
 public $activateParents=true;
 public $itemOptions=['class'=>'sub-menu'];
 public function init(){
	 parent::init();
	 $this->items[]=['label'=>'<i class="icon_house_alt"></i><span>Dashboard</span>','url'=>\yii\helpers\Url::to(['/cms/admin/index'])];
	 $this->items[]=[
					'label'=>'<i class="fa fa-wrench"></i><span>Settings</span><span class="menu-arrow arrow_carrot-down"></span>',
					'url'=>'javascript:;',
					'items'=>[
							[	
								'label' => \Yii::t('app','Generali'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/settings'])
							],
						],
					 
	                 'submenuTemplate'=> (\Yii::$app->controller->route=="cms/admin/settings")?"\n<ul class=\"sub\" style=\"display: block;\">\n{items}\n</ul>\n":"\n<ul class=\"sub\">\n{items}\n</ul>\n",
	                 ];
	 $this->items[]=[
					'label'=>' <i class="fa fa-list"></i><span>Menu</span><span class="menu-arrow arrow_carrot-right"></span>',
					'url'=>'javascript:;',
					'items'=>[
								[	
								'label' => \Yii::t('app','Elenca'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/menu'])
								],
								[	
								'label' => \Yii::t('app','Aggiungi'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/menu','action'=>'aggiungi'])
								],
							],
					 
	                 'submenuTemplate'=> (\Yii::$app->controller->route=="cms/admin/menu")?"\n<ul class=\"sub\" style=\"display: block;\">\n{items}\n</ul>\n":"\n<ul class=\"sub\">\n{items}\n</ul>\n",
	                 ];
	  $this->items[]=[
					'label'=>'<i class="icon_documents_alt"></i><span>Pagine</span><span class="menu-arrow arrow_carrot-right"></span>',
					'url'=>'javascript:;',
					'items'=>[
								[	
								'label' => \Yii::t('app','Elenca'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/pages'])
								],
								[	
								'label' => \Yii::t('app','Aggiungi'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/pages','action'=>'aggiungi'])
								],
							],
					 
	                 'submenuTemplate'=> (\Yii::$app->controller->route=="cms/admin/pages")?"\n<ul class=\"sub\" style=\"display: block;\">\n{items}\n</ul>\n":"\n<ul class=\"sub\">\n{items}\n</ul>\n",
	                 ];                
		$this->items[]=[
					'label'=>' <i class="icon_documents_alt"></i> <span>Sezioni</span><span class="menu-arrow arrow_carrot-right"></span>',
					'url'=>'javascript:;',
					'items'=>[
								[	
								'label' => \Yii::t('app','Elenca'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/sections'])
								],
								[	
								'label' => \Yii::t('app','Aggiungi'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/sections','action'=>'aggiungi'])
								],
							],
					 
	                 'submenuTemplate'=> (\Yii::$app->controller->route=="cms/admin/sections")?"\n<ul class=\"sub\" style=\"display: block;\">\n{items}\n</ul>\n":"\n<ul class=\"sub\">\n{items}\n</ul>\n",
	                 ]; 
	  $this->items[]=[
					'label'=>' <i class="icon_documents_alt"></i> <span>Widgets</span><span class="menu-arrow arrow_carrot-right"></span>',
					'url'=>'javascript:;',
					'items'=>[
								[	
								'label' => \Yii::t('app','Elenca'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/widgets'])
								],
								[	
								'label' => \Yii::t('app','Aggiungi'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/widgets','action'=>'aggiungi'])
								],
							],
					 
	                 'submenuTemplate'=> (\Yii::$app->controller->route=="cms/admin/widgets")?"\n<ul class=\"sub\" style=\"display: block;\">\n{items}\n</ul>\n":"\n<ul class=\"sub\">\n{items}\n</ul>\n",
	                 ];  
	  $this->items[]=[
					'label'=>' <i class="icon_documents_alt"></i> <span>Layouts</span><span class="menu-arrow arrow_carrot-right"></span>',
					'url'=>'javascript:;',
					'items'=>[
								[	
								'label' => \Yii::t('app','Elenca'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/layouts'])
								],
								[	
								'label' => \Yii::t('app','Aggiungi'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/layouts','action'=>'aggiungi'])
								],
							],
					 
	                 'submenuTemplate'=> (\Yii::$app->controller->route=="cms/admin/layouts")?"\n<ul class=\"sub\" style=\"display: block;\">\n{items}\n</ul>\n":"\n<ul class=\"sub\">\n{items}\n</ul>\n",
	                 ]; 
	 $this->items[]=[
					'label'=>' <i class="icon_documents_alt"></i> <span>Views</span><span class="menu-arrow arrow_carrot-right"></span>',
					'url'=>'javascript:;',
					'items'=>[
								[	
								'label' => \Yii::t('app','Elenca'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/views'])
								],
								[	
								'label' => \Yii::t('app','Aggiungi'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/views','action'=>'aggiungi'])
								],
							],
					 
	                 'submenuTemplate'=> (\Yii::$app->controller->route=="cms/admin/views")?"\n<ul class=\"sub\" style=\"display: block;\">\n{items}\n</ul>\n":"\n<ul class=\"sub\">\n{items}\n</ul>\n",
	                 ];  
	 $this->items[]=[
					'label'=>'<i class="fa fa-picture-o fa-2"></i><span>Media</span><span class="menu-arrow arrow_carrot-right"></span>',
					'url'=>'javascript:;',
					'items'=>[
								[	
								'label' => \Yii::t('app','Elenca'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/media'])
								],
								[	
								'label' => \Yii::t('app','Aggiungi'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/media','action'=>'aggiungi'])
								],
							],
					 
	                 'submenuTemplate'=> (\Yii::$app->controller->route=="cms/admin/media")?"\n<ul class=\"sub\" style=\"display: block;\">\n{items}\n</ul>\n":"\n<ul class=\"sub\">\n{items}\n</ul>\n",
	                 ]; 
	 $this->items[]=[
					'label'=>'<i class="fa fa-cogs fa-2"></i><span>Plugins</span><span class="menu-arrow arrow_carrot-right"></span>',
					'url'=>'javascript:;',
					'items'=>[
								[	
								'label' => \Yii::t('app','Elenca'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/plugins'])
								],
								[	
								'label' => \Yii::t('app','Aggiungi'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/plugins','action'=>'aggiungi'])
								],
							],
					 
	                 'submenuTemplate'=> (\Yii::$app->controller->route=="cms/admin/plugins")?"\n<ul class=\"sub\" style=\"display: block;\">\n{items}\n</ul>\n":"\n<ul class=\"sub\">\n{items}\n</ul>\n",
	                 ];  
	  $this->items[]=[
					'label'=>'<i class="fa fa-desktop fa-2"></i><span>Themes</span><span class="menu-arrow arrow_carrot-right"></span>',
					'url'=>'javascript:;',
					'items'=>[
								[	
								'label' => \Yii::t('app','Elenca'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/themes'])
								],
								[	
								'label' => \Yii::t('app','Aggiungi'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/themes','action'=>'aggiungi'])
								],
							],
					 
	                 'submenuTemplate'=> (\Yii::$app->controller->route=="cms/admin/themes")?"\n<ul class=\"sub\" style=\"display: block;\">\n{items}\n</ul>\n":"\n<ul class=\"sub\">\n{items}\n</ul>\n",
	                 ];    
	  //check sidebar menu and add to them
	 
	  if(is_array(\Yii::$app->controller->module->params['sidebar'])&& !empty(\Yii::$app->controller->module->params['sidebar']))$this->items=array_merge($this->items,\Yii::$app->controller->module->params['sidebar']);                                        
 } 
  

   
}
     
   
