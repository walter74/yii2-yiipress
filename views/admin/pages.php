<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\CmsPagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Elenco Pagine');



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


    <p>
        <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> Aggiungi Pagina'), ['admin/pages','action'=>'aggiungi'], ['class' => 'btn btn-success']) ?>
    </p>
  
<section class="panel">
	    <?php Pjax::begin(); ?>
                          <header class="panel-heading">
                              Pagine
                          </header>
                        <?= GridView::widget([
												'dataProvider' => $dataProvider,
												'filterModel' => $searchModel,
												
												/*'rowOptions' => function ($model, $key, $index, $grid){
													             $className=$model->className();
													                  if($model->status==$className::STATUS_PUBLISHED)
																		return ['data-key'=>$index,'style'=>'color:white;background-color:green'];
																	  if($model->status==$className::STATUS_INACTIVE)
																		return ['data-key'=>$index,'style'=>'color:white;background-color:red'];
																		
																 return ['data-key'=>$index];
																},*/
												'columns' => [
																['class' => 'yii\grid\SerialColumn'],

																'id',
																'title',
																'slug',
																'created_at:date',
																//'updated_at',
																[
																  'class' => 'yii\grid\DataColumn',
																  'attribute'=>'status',
																  'format' => 'html',
																  'filter'=>false,
																  'value'=>function ($model, $key,$index,$column){
																						$className=$model->className();
																						if($model->status==$className::STATUS_PUBLISHED)
																							return \yii\helpers\Html::tag( 'i',  '', ['class' => 'fa fa-globe','style'=>'color:green','title'=>'Pubblished','alt'=>'Pubblished'] );//return "<i class='fa fa-globe' style='background-color:green'></i> Pubblished";
																						if($model->status==$className::STATUS_INACTIVE)
																							return \yii\helpers\Html::tag( 'i',  '', ['class' => 'fa fa-lock','style'=>'color:red','title'=>'inactive','alt'=>'Pubblished'] );//return "<i class='fa fa-lock' style='background-color:red'></i> Not Pubblished";
																		
																				return null;
																			}
																
																],
																// 'status',
																 'theme',
																 'layout',
																 'view',

																[ 
																	'class' => 'yii\grid\ActionColumn', 
																	'urlCreator'=>function ($action, $model, $key, $index, $this) {
																							return \yii\helpers\Url::to(['admin/page','id'=>$model->id,'action'=>$action]);
																		//return string;
																	},

            
																],
												],
											]); ?>
    <?php Pjax::end(); ?>
</section>
</div>  
</div>

