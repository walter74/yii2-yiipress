<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\CmsPages */

$this->title = $model->title; 
$this->params['breadcrumbs'][]=[
            'label' => 'Pagine',
            'url' => ['admin/pages'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => 'Pagina :#'.$model->id.' - '.$model->title,
           
            'template' => "<li><i class='fa fa-eye'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
?>
<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-eye"></i> <?=$this->title?></h3>
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
                        

   

    <p>
        <?= Html::a('<i class="fa fa-pencil"></i> '.Yii::t('app', 'Aggiorna'), ['admin/page','id'=>$model->id, 'action' => 'update'], ['class' => 'btn btn-primary']) ?>
        
        
        <?= Html::a('<i class="fa fa-eye"></i> '.Yii::t('app', 'Mostra Pagina'), ['default/page', 'slug' => $model->slug], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-list"></i> '.Yii::t('app', 'Assets/Source'), ['admin/page', 'id' => $model->id,'action'=>'assets'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('<i class="fa fa-list"></i> '.Yii::t('app', 'Sezioni/Blocchi'), ['admin/page', 'id' => $model->id,'action'=>'sections'], ['class' => 'btn btn-default']) ?>
		<?= Html::a('<i class="fa fa-list"></i> '.Yii::t('app', 'Menu'), ['admin/page', 'id' => $model->id,'action'=>'menu'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('<i class="fa fa-list"></i> '.Yii::t('app', 'Widgets'), ['admin/page', 'id' => $model->id,'action'=>'widgets'], ['class' => 'btn btn-default']) ?>
    </p>
    <div class="cms-pages-view">
		<section class="panel">
			<header class="panel-heading no-border">
				Pagina :#<?=$model->id.' - '.$model->title?>
			</header>
		<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'title_alt',
            'slug',
			 [
               'attribute'=>'created_at',
               'format'=>'date'
             ],
             [
               'attribute'=>'updated_at',
               'format'=>['date','long']
             ],
             [
               'attribute'=>'status',
               'format'=>'html',
               'value'=>function($model,$widget){
				                  $ns_model=Yii::$app->controller->module->modelNamespace.'\CmsPages'; 
				                  if($ns_model::STATUS_PUBLISHED==$model->status){
											return Yii::t('app','Pubblished');
								  }
				                  else{
										return Yii::t('app','Blocked')." ".Html::a('<i class="fa fa-eye"></i> ', ['default/private', 'slug' => $model->slug],['title'=>Yii::t('app', 'Mostra Pagina Bozza')]);	
									 }
				          
				           
				          
				           
				  },
             ],
            'theme',
            'layout',
            'view',
			],
		]) ?>
		</section>
		
    </div>
    <div>
		<section class="panel">
			<header class="panel-heading no-border">
				Preview Pagina :#<?=$model->id.' - '.$model->title?>
			</header>
			<iframe width=100% height=auto src="<?= \yii\helpers\Url::to(['default/page','slug'=>$model->slug])?>"></iframe>
		</section>
    </div>
</div>
