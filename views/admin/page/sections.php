<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\CmsPagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Elenco Sezioni/Blocchi');


$this->params['breadcrumbs'][]=[
            'label' => 'Pagine',
            'url' => ['admin/pages'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => 'Pagina:'.$model->title,
            'url' => ['admin/page', 'id' => $model->id],
            'template' => "<li><i class='fa fa-eye'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => $this->title,
            //'url' => ['admin/menu', 'action' => 'list'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
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

    
  
   

    
<section class="panel">
	  <?php Pjax::begin(); ?>
                          <header class="panel-heading">
                            Sezioni/Blocchi: Layout <?=\yii\helpers\Html::encode(basename($model->layout))?>
                          </header>
                        <?= GridView::widget([
												'dataProvider' => $dataProvider_layout,
												//'filterModel' => $searchModel,
												'columns' => [
																['class' => 'yii\grid\SerialColumn'],

																'id',
																
																'tag',
																 [
																   'class' => 'yii\grid\DataColumn', 
																   'label'=>'Content',
																   'value'=>function ($model, $key, $index, $column){
																			return (strlen($model->content)>50)?substr($model->content,0,50).'...':$model->content;
																	   
																	},
																 ],
																
																['class' => 'yii\grid\ActionColumn',
																 'urlCreator'=>function ($action, $model, $key, $index, $this) {
																							return \yii\helpers\Url::to(['admin/section','id'=>$model->id,'action'=>$action]);
																		//return string;
																	},
																'template'=>'{view} {update}',
																],
												],
											]); ?>
    <?php Pjax::end(); ?>
</section>
<section class="panel">
	  <?php Pjax::begin(); ?>
                          <header class="panel-heading">
                            Sezioni/Blocchi: View <?=\yii\helpers\Html::encode(basename($model->view))?>
                          </header>
                        <?= GridView::widget([
												'dataProvider' => $dataProvider_views,
												//'filterModel' => $searchModel,
												'columns' => [
																['class' => 'yii\grid\SerialColumn'],

																'id',
																'tag',
																
																 [
																   'class' => 'yii\grid\DataColumn', 
																   'label'=>'Content',
																   'value'=>function ($model, $key, $index, $column){
																			return (strlen($model->content)>50)?substr($model->content,0,50).'...':$model->content;
																	   
																	},
																 ],
																['class' => 'yii\grid\ActionColumn',
																 'urlCreator'=>function ($action, $model, $key, $index, $this) {
																							return \yii\helpers\Url::to(['admin/section','id'=>$model->id,'action'=>$action]);
																		//return string;
																	},
																'template'=>'{view} {update}',
																],
												],
											]); ?>
    <?php Pjax::end(); ?>
</section>  
</div>
</div>
