<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\CmsPagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Elenco Menu');


$this->params['breadcrumbs'][]=[
            'label' => 'Layouts',
            'url' => ['admin/layouts'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => 'Layout:'.basename($model['file']),
            'url' => ['admin/layout', 'file' => urlencode($model['file'])],
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

    
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
<section class="panel">
                          <header class="panel-heading">
                              Menu
                          </header>
                        <?= GridView::widget([
												'dataProvider' => $dataProvider,
												//'filterModel' => $searchModel,
												'columns' => [
																['class' => 'yii\grid\SerialColumn'],

																'id',
																'name',
																'tag',
																'created_at:date',
																'updated_at:date',
																

																['class' => 'yii\grid\ActionColumn',
																 'urlCreator'=>function ($action, $model, $key, $index, $this) {
																							return \yii\helpers\Url::to(['admin/menu-content','id'=>$model->id,'action'=>$action]);
																		//return string;
																	},
																'template'=>'{view}',
																],
												],
											]); ?>
    <?php Pjax::end(); ?>
</section>
   
</div>
</div>
