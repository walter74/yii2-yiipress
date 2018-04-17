<?php
Yii::$app->view->title=$model->title;
$content= \yii\helpers\HtmlPurifier::process($model->content, function ($config) {
	
	  $config->set('HTML.SafeIframe', true);
	 // $config->set('URI.AllowedSchemes', array('data' => true)); 
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
?>
<?php if($model->status==\plugins\articles\models\CmsArticles::STATUS_PUBLISHED):?>

<?php
	 $route = (Yii::$app->controller->module->action_page_root!==null)?Yii::$app->controller->module->action_page_root:Yii::$app->controller->id.'/'.Yii::$app->controller->action->id;
?>
<?php if(!empty($breadcrumbs)):?>
<div class="card">
	<nav class="breadcrumb" style="background-color:white">
					<a class="breadcrumb-item" href="<?=\yii\helpers\Url::to([$route, 'slug' => isset($breadcrumbs['home']['slug'])?$breadcrumbs['home']['slug']:"articles"])?>"><?=isset($breadcrumbs['home']['title'])?$breadcrumbs['home']['title']:"Articles"?></a>
					
					<span class="breadcrumb-item active" style="color:black">Articolo  - <?=\yii\helpers\Html::encode($model->title)?></span>
	</nav>

</div>
<?php endif;?>

<?=$content?>

<?php endif;?>
