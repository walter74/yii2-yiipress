<?php
/* @var $this yii\web\View */
$this->params['breadcrumbs'][]="DashBoard";
?>
<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-list"></i> DashBoard</h3>
					<div class="pull-right"></div>
					<?= \yii\widgets\Breadcrumbs::widget([
												'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
											]);?>
					
</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box blue-bg">
						<i class="icon_document_alt"></i> Pagine
						<div class="count"><a href="<?=\yii\helpers\Url::to(['admin/pages'])?>"><?=$n_pages?></a></div>
											
					</div><!--/.info-box-->	
						
</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box green-bg">
						<i class="fa fa-puzzle-piece"></i> Sezioni
						<div class="count"><a href="<?=\yii\helpers\Url::to(['admin/sections'])?>"><?=$n_sections?></a></div>
											
					</div><!--/.info-box-->			
</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box red-bg">
						<i class="icon_genius"></i> Widgets
						<div class="count"><a href="<?=\yii\helpers\Url::to(['admin/widgets'])?>"><?=$n_widgets?></a></div>
										
					</div><!--/.info-box-->			
</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box yellow-bg">
						<i class="fa fa-list"></i>
						<div class="count"><a href="<?=\yii\helpers\Url::to(['admin/menu'])?>"><?=$n_menu?></a></div> Menu
											
					</div><!--/.info-box-->				
</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box purple-bg">
						<i class="fa fa-file-text"></i>
						<div class="count"><a href="<?=\yii\helpers\Url::to(['admin/layouts'])?>"><?=$n_layouts?></a></div> Layouts
											
					</div><!--/.info-box-->				
</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box orange-bg">
						<i class="fa fa-file-text"></i>
						<div class="count"><a href="<?=\yii\helpers\Url::to(['admin/views'])?>"><?=$n_views?></a></div> Views
											
					</div><!--/.info-box-->				
</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box pink-bg">
						<i class="fa fa-cog"></i>
						<div class="count"><a href="<?=\yii\helpers\Url::to(['admin/plugins'])?>"><?=$n_plugins?></a></div> Plugins
											
					</div><!--/.info-box-->				
</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box brown-bg">
						<i class="fa fa-picture-o"></i>
						<div class="count"><a href="<?=\yii\helpers\Url::to(['admin/media'])?>"><?=$n_media?></a></div> Media
											
					</div><!--/.info-box-->				
</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box brown-bg">
						<i class="fa fa-desktop"></i>
						<div class="count"><a href="<?=\yii\helpers\Url::to(['admin/themes'])?>"><?=$n_themes?></a></div> Themes
											
					</div><!--/.info-box-->				
</div>
<?php if(!empty(Yii::$app->controller->module->params['dashboard'])):?>
	<?php foreach(Yii::$app->controller->module->params['dashboard'] as $key => $value):?>
	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box brown-bg">
						<?=isset($value['icon'])?$value['icon']:'<i class="fa fa-cog"></i>'?>
						<div class="count"><a href="<?=isset($value['url'])?$value['url']:'#'?>"><?=isset($value['count'])?$value['count']:'N.D.'?></a></div> <?=isset($value['title'])?$value['title']:'N.D.'?>
											
					</div><!--/.info-box-->				
   </div>
	<?php endforeach;?>

<?php endif;?>
