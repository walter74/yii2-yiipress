<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;     
  
$mailinglist_search_ns= '\plugins\mailinglist\models\CmsMailinglistSearch';
$searchModel = new $mailinglist_search_ns();
//$articles=$this->module->modelNamespace.'\CmsArticles';
$dataProvider= $searchModel->search(Yii::$app->request->get());
//this we insert $model and $action plugin passed by run view called by pluging running, inside the gridview the varibale $model and $action is represented by the article model
//so for that we have to clone them in another variable as follow described
$model_plugin=$model;
$action_plugin=$action;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\CmsPagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mailing List');



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
        <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> Aggiungi Email'), ['admin/run','plugin_name'=>'mailinglist','action'=>'aggiungi'], ['class' => 'btn btn-success']) ?>
    </p>
  
<section class="panel">
	    <?php Pjax::begin(); ?>
                          <header class="panel-heading">
                              Emails
                          </header>
                        <?= GridView::widget([
												'dataProvider' => $dataProvider,
												'filterModel' => $searchModel,
											
												'columns' => [
																['class' => 'yii\grid\SerialColumn'],

																'id',
																
																'email',
																'description',
																'created_at:date',
																'updated_at:date',
																
																[ 
																	'class' => 'yii\grid\ActionColumn', 
																	'urlCreator'=>function ($action, $model, $key, $index, $this) {
																							return \yii\helpers\Url::to(['admin/run','plugin_name'=>'mailinglist','id'=>$model->id,'action'=>$action]);
																		//return string;
																	},
                                                                    'template'=>'{update} {delete}'
            
																],
																
												],
											]); ?>
    <?php Pjax::end(); ?>
</section>
</div>  
</div>
