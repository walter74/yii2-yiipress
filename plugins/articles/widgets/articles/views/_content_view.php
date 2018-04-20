<?php 
$tags=isset($model->tags)?unserialize($model->tags):null;
$model->title = strtolower(\yii\helpers\Html::encode($model->title));
$model->description = \yii\helpers\Html::encode($model->description);
?>         
            <article>
				<figure>
					<a href="<?= \yii\helpers\Url::to([((Yii::$app->controller->module->action_page_root!==null)?Yii::$app->controller->module->action_page_root:Yii::$app->controller->id.'/'.Yii::$app->controller->action->id),'slug'=>$slug,'id'=>$model->id,'titolo'=>$model->title])?>">
						<?php if($model->img!=''):?>
							<img src="<?= $model->img?>" alt="Cover" class="img-responsive">
						<?php endif;?>
					</a>
				</figure>
				<span><a href="<?= \yii\helpers\Url::to([((Yii::$app->controller->module->action_page_root!==null)?Yii::$app->controller->module->action_page_root:Yii::$app->controller->id.'/'.Yii::$app->controller->action->id),'slug'=>$slug,'id'=>$model->id,'titolo'=>$model->title])?>"><?=($model->title_alt!='')?$model->title_alt:$model->title?></a></span>
				<h2><a href="<?= \yii\helpers\Url::to([((Yii::$app->controller->module->action_page_root!==null)?Yii::$app->controller->module->action_page_root:Yii::$app->controller->id.'/'.Yii::$app->controller->action->id),'slug'=>$slug,'id'=>$model->id,'titolo'=>$model->title])?>"><?=$model->description?></a></h2>
				<span><?=Yii::$app->formatter->asDate($model->updated_at)?></span>
				<?php 
				 if(is_array($tags)):  
				      foreach($tags as $tag):?>
						  <a href="<?=\yii\helpers\Url::to([((Yii::$app->controller->module->action_page_root!==null)?Yii::$app->controller->module->action_page_root:Yii::$app->controller->id.'/'.Yii::$app->controller->action->id),'slug'=>$slug_articles,'CmsArticlesTagSearch[tag]'=>$tag])?>"><span class="label label-default"><?=$tag?></span></a> 
				 <?php endforeach;?>
			    <?php endif;?>
			    <?php if(Yii::$app->user->can($edit_permission)):?>
			         <a target ="_blank" href="<?=\yii\helpers\Url::to(['/'.Yii::$app->controller->module->id.'/admin/run','plugin_name'=>$plugin_name,'id'=>$model->id,'action'=>'update'])?>"><span>Modifica</span></a>
			    <?php endif;?>
			</article> 
	
     
