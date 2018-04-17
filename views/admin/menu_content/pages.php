<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\CmsPagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Elenco Pagine');



$this->params['breadcrumbs'][]=[
            'label' => 'Menu',
            'url' => ['admin/menu', 'action' => 'list'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => 'Menu #'.$model->id.' '.$model->name,
            'url' => ['admin/menu-content', 'id' => $model->id],
            'template' => "<li><i class='fa fa-eye'> <b>{link}</b></i></li>\n", // template for this link only 
        ]; 
$this->params['breadcrumbs'][]=[
            'label' => $this->title,
            
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];       


$model_menu=$model;

$js=<<<sss
$( "#send_ajax" ).on( "click", function() {


//var arr_data = ["Banana", "Orange", "Apple", "Mango"];
//arr_data.push("Kiwi");

var arr_data=Array();
$('.sorted_table tr').each(function() {
    id = $(this).find("td").slice( 1,2).html();
    
    //check if id is not numeric
    
    if(!isNaN(id)){  arr_data.push(id);
    }
    else{
        n_riga = $(this).find("td").slice(0,1).html();
        submenu = $(this).find("td").slice(6,7).html();
        if(n_riga!=null){
			if(submenu!=null){
				submenu={submenu: submenu};
				arr_data.push(submenu);
			}
			else{
				label = $(this).find("td").slice( 4,5).html();
				url =   $(this).find("td").slice( 5,6).html();
				link={ label: label, url: url };
				arr_data.push(link);
				//console.log(JSON.stringify(arr_data));
			}
	    }
    }
      
});

//var arr_data=$('#menu_data').serializeArray();

//var arr_data = { City: 'Moscow', Age: 25 };

$.ajax({
    url: '{{url_ajax}}',
    type: 'POST',
    data: JSON.stringify(arr_data),
    contentType: 'application/json; charset=utf-8',
   // dataType: 'json',
   // async: false,
   success: function(msg) {
        location.reload();
   
   
        alert(msg);
    }
});

});
sss;

$js=str_replace('{{url_ajax}}',\yii\helpers\Url::to(['admin/menu-content','id'=>$model->id,'action'=>'pagine']),$js);
$this->registerJs($js);

$nm_sortable=Yii::$app->controller->module->assetNamespace.'\SortableAsset';
$nm_sortable::register($this);
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

    <p>
         <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> Aggiungi Pagina'), ['admin/menu-content','id'=>$model->id,'action'=>'pagine','subaction'=>'aggiungi'], ['class' => 'btn btn-success']) ?>
         <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> Aggiungi Link'), ['admin/menu-content','id'=>$model->id,'action'=>'pagine','subaction'=>'aggiungi-link'], ['class' => 'btn btn-success']) ?>
         <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> Aggiungi SubMenu'), ['admin/menu-content','id'=>$model->id,'action'=>'pagine','subaction'=>'aggiungi-submenu'], ['class' => 'btn btn-success']) ?>
     
    </p>
    
<section class="panel">
                          <header class="panel-heading">
                              Pagine
                          </header>
                          
          
                        <?php  echo GridView::widget([
												'dataProvider' => $dataProvider,
												'tableOptions'=> ['class'=>'table table-striped table-bordered sorted_table'],
												//'filterModel' => $searchModel,
												'columns' => [
																['class' => 'yii\grid\SerialColumn'],

																'id',
																'title',
																'slug',
																
																//'type',
																//'updated_at',
																// 'status',
																// 'layout',
																// 'view',
																 [
																	'class'=>'yii\grid\DataColumn',
																	'label' =>'Label',
																	'value'=> function ($model, $key, $index, $column){
																		return isset($model['label'])?$model['label']:'';
																	 },
                                                                ],
                                                                [
																	'class'=>'yii\grid\DataColumn',
																	'label' =>'Link',
																	'value'=> function ($model, $key, $index, $column){
																		return isset($model['url'])?$model['url']:'';
																	 },
                                                                ],
                                                                [
																	'class'=>'yii\grid\DataColumn',
																	'label' =>'SubMenu(placeholder)',
																	'value'=> function ($model, $key, $index, $column){
																		return isset($model['submenu'])?$model['submenu']:'';
																	 },
                                                                ],
																[ 
																	'class' => 'yii\grid\ActionColumn', 
																	'visibleButtons'=>[
																						'delete'=>true,
																						'update' => false,
																						'view'=>false,
																	],
																	'urlCreator'=>function ($action, $model, $key, $index)use($model_menu){
																							
																							         return \yii\helpers\Url::to(['admin/menu-content','id'=>$model_menu->id,'action'=>'pagine','riga_id'=>($index+1),'subaction'=>$action]);
																						        
																		//return string;
																	},

            
																],
												],
											]);?>
    <?php Pjax::end(); ?>
     <form id="menu_data">
        <input type="hidden" value="prova">
     </form>
     <?= Html::button ('Save', ['id'=>'send_ajax','class'=>'btn btn-success'] )?>
</section>
   
</div>
</div>
