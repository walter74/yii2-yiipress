<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\CmsPagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Aggiungi SubMenu');



$this->params['breadcrumbs'][]=[
            'label' => 'Menu',
            'url' => ['admin/pages', 'action' => 'list'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => 'Menu #'.$model->id.' '.$model->name,
            'url' => ['admin/menu-content', 'id' => $model->id],
            'template' => "<li><i class='fa fa-eye'> <b>{link}</b></i></li>\n", // template for this link only 
        ]; 
$this->params['breadcrumbs'][]=[
            'label' => 'Elenco Pagine',
            'url' => ['admin/menu-content', 'id' => $model->id,'action'=>'pagine'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];         
        
$this->params['breadcrumbs'][]=[
            'label' => $this->title,
            
            'template' => "<li><i class='fa fa-plus'> <b>{link}</b></i></li>\n", // template for this link only 
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

    <p>
        <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> Aggiungi Pagina'), ['admin/menu-content','id'=>$model->id,'action'=>'pagine','subaction'=>'aggiungi'], ['class' => 'btn btn-success']) ?>
    </p>
<section class="panel">
                          <header class="panel-heading">
                              Menu
                          </header>
             <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>

			<?= $form->field($model_submenu_form, 'submenu')->label('SubMenu')->widget(\kartik\select2\Select2::classname(), [
																						'data' => $list_menu,
																						'options' => ['placeholder' => 'Seleziona Menu...'],
																						'pluginOptions' => [
																											'allowClear' => true,
																											//'multiple' => true
																						],
																					])
 
			
			?>
			

    
			<div class="form-group">
					<?= \yii\helpers\Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
			</div>
            <?php \yii\bootstrap\ActiveForm::end(); ?>
</section>
   
</div>
</div>
