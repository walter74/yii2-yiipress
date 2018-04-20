<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\CmsPagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Elenco Sezioni/blocchi');



$this->params['breadcrumbs'][]=[
            'label' => $this->title,
            'url' => ['admin/sections', 'action' => 'list'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => 'Sezione #'.$model->id,
            'url' => ['admin/section', 'id' => $model->id],
            'template' => "<li><i class='fa fa-eyes'> <b>{link}</b></i></li>\n", // template for this link only 
        ];    
$this->params['breadcrumbs'][]=[
            'label' => 'Elenco Sub Sezioni',
            
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
        <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> Aggiungi Sezione'), ['admin/sections','action'=>'aggiungi'], ['class' => 'btn btn-success']) ?>
    </p>
<section class="panel">
	<?php Pjax::begin(); ?>
                          <header class="panel-heading">
                              sections
                          </header>
                        <?= GridView::widget([
												'dataProvider' => $dataProvider_sub_sections,
												//'filterModel' => $searchModel,
												'columns' => [
																['class' => 'yii\grid\SerialColumn'],

																'id',
																'nome',
																'tag',
																 [
																   'class' => 'yii\grid\DataColumn', 
																   'label'=>'Content',
																   'value'=>function ($model, $key, $index, $column){
																			return (strlen($model->content)>50)?substr($model->content,0,50).'...':$model->content;
																	   
																	},
																 ],
																//'content',
																'created_at:date',
																'updated_at:date',
																

																[ 
																	'class' => 'yii\grid\ActionColumn', 
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
