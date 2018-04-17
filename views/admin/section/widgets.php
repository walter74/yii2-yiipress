<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\CmsPagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Elenco Widgets');


$this->params['breadcrumbs'][]=[
            'label' => 'Sezioni',
            'url' => ['admin/sections'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => 'Sezione #:'.$model->id,
            'url' => ['admin/section', 'id' => $model->id],
            'template' => "<li><i class='fa fa-eye'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => 'Elenco Widgets',
            'url' => ['admin/section', 'id' => $model->id,'action'=>'widgets'],
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
                             Widgets 
                          </header>
                        <?= GridView::widget([
												'dataProvider' => $dataProvider_widgets,
												//'filterModel' => $searchModel,
												'columns' => [
																['class' => 'yii\grid\SerialColumn'],

																'id',
																'tag',
																'classname',
																
																['class' => 'yii\grid\ActionColumn',
																 'urlCreator'=>function ($action, $model, $key, $index, $this) {
																							return \yii\helpers\Url::to(['admin/widget','id'=>$model->id,'action'=>$action]);
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
