<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\CmsPagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Temi Inattivi');

$this->params['breadcrumbs'][]=[
            'label' => Yii::t('app', 'Temi Attivi'),
            'url' => ['admin/themes', 'action' => 'active'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];

$this->params['breadcrumbs'][]=[
            'label' => $this->title,
            //'url' => ['admin/sections', 'action' => 'list'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];


$js= <<<sss
 
    $('#activate_themes').click(function(){

       var keys = $('#w0').yiiGridView('getSelectedRows');
      
        $.post({
           url: '{{url_themes_activation}}', 
           dataType: 'json',
           data: {keylist: JSON.stringify(keys)},

        }).always(function( data ) {
            
           location.reload();
       });
    });
sss;
$js=str_replace('{{url_themes_activation}}',\yii\helpers\Url::to(['admin/themes','action'=>'activate']),$js);

$this->registerJs($js,\yii\web\view::POS_READY);

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

    
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
<section class="panel">
                          <header class="panel-heading">
                           themes
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
																	
																	'class' => 'yii\grid\CheckboxColumn', 
																	'checkboxOptions' => function ($model, $key, $index, $column) {
                                                                                                                                   return ['value' => $model['file']];
                                                                    }
																	
            
																]
												],
											]); ?>
    
</section>
<?= \yii\helpers\Html::button ('Attiva Themes', ["id"=>"activate_themes","class"=>"btn btn-success"] )?>
<?php Pjax::end(); ?>
</div>
</div>
