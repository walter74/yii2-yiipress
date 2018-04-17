<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\CmsPagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Elenco Assets');



$this->params['breadcrumbs'][]=[
            'label' => 'Pagine',
            'url' => ['admin/pages', 'action' => 'list'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => 'Pagina #'.$model->id.' '.$model->title,
            'url' => ['admin/page', 'id' => $model->id],
            'template' => "<li><i class='fa fa-eye'> <b>{link}</b></i></li>\n", // template for this link only 
        ]; 
$this->params['breadcrumbs'][]=[
            'label' => $this->title,
            
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];       
$model_page=$model;
?>
<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-list"></i> <?=$this->title?></h3>
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
<div class="cms-pages-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> Aggiungi Asset/Sorgente'), ['admin/page','id'=>$model->id,'action'=>'assets','subaction'=>'aggiungi'], ['class' => 'btn btn-success']) ?>
    </p>
<section class="panel">
	<?php Pjax::begin(); ?>
                          <header class="panel-heading">
                              Pagine
                          </header>
                        <?= GridView::widget([
												'dataProvider' => $dataProvider,
												//'filterModel' => $searchModel,
												'columns' => [
																['class' => 'yii\grid\SerialColumn'],

																'id',
																'content',
																//'slug',
																[ 
																	'class' => 'yii\grid\DataColumn', 
																	'attribute'=>'type',
																	'content'=>function($model) {
																		                 $classname=Yii::$app->controller->module->modelNamespace.'\CmsAssets';
																		                 switch($model['type']){
																									case $classname::TYPE_CSS:
																													return "CSS";
																									case $classname::TYPE_JS:
																													return "JS";
																									case $classname::TYPE_SCRIPT:
																													return "SCRIPT";
																									case $classname::TYPE_METATAG:
																													return "META-TAG";
																									case $classname::TYPE_ASSET:
																													return "ASSET";
																									case $classname::TYPE_LINKTAG:
																													return "LINK-TAG";
																									case $classname::TYPE_CSS_CODE:
																													return "CSS_CODE";								
																													
																									default:
																													return "CSS";       
																							
																							}
																									//return string;
																	},

            
																],
																//'type',
																//'updated_at',
																// 'status',
																// 'layout',
																// 'view',

																[ 
																	'class' => 'yii\grid\ActionColumn', 
																	'visibleButtons'=>[
																						'delete'=>true,
																						'update' => true,
																						'view'=>false,
																	],
																	'urlCreator'=>function ($action,$model)use($model_page){
																							
																							         return \yii\helpers\Url::to(['admin/page','id'=>$model_page->id,'action'=>'assets','asset_id'=>$model->id,'subaction'=>$action]);
																						        
																		//return string;
																	},

            
																],
												],
											]); ?>
    <?php Pjax::end(); ?>
</section>
   
</div>
</div>
