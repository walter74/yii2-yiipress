<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\CmsPagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Elenco Layouts');



$this->params['breadcrumbs'][]=[
            'label' => $this->title,
            //'url' => ['admin/sections', 'action' => 'list'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
?>
<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-list"></i> <?=Html::encode($this->title)?></h3>
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
        <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> Aggiungi Layout'), ['admin/layouts','action'=>'aggiungi'], ['class' => 'btn btn-success']) ?>
    </p>
    
   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
<section class="panel">
	 <?php Pjax::begin(); ?>
                          <header class="panel-heading">
                              Layouts
                          </header>
                        <?= GridView::widget([
												'dataProvider' => $dataProvider,
												//'filterModel' => $searchModel,
												'columns' => [
																['class' => 'yii\grid\SerialColumn'],

																
																'file',
																'type',
																'updated_at:date',
																

																[ 
																	'class' => 'yii\grid\ActionColumn', 
																	'urlCreator'=>function ($action, $model, $key, $index, $this) {
																							return \yii\helpers\Url::to(['admin/layout','file'=>urlencode($model['file']),'action'=>$action]);
																		//return string;
																	},
                                                                    'template' => '{view}',
            
																],
												],
											]); ?>
    <?php Pjax::end(); ?>
</section>

</div>
</div>
