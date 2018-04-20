<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Cmssections */
/* @var $form ActiveForm */

/* @var $this yii\web\View */

$this->title="Menu #".$model->id;

$this->params['breadcrumbs'][]=[
            'label' => 'Elenco Menu',
            'url' => ['admin/menu'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => $this->title,
           
            'template' => "<li><i class='fa fa-eye'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
?>
<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-eye"></i> <?=$this->title?></h3>
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
<div class="row">
                  <div class="col-lg-12">
					  <p>
								<?= Html::a('<i class="fa fa-pencil"></i> '.Yii::t('app', 'Aggiorna'), ['admin/menu-content','id' => $model->id,'action'=>'update'], ['class' => 'btn btn-primary']) ?>
								<?= Html::a('<i class="fa fa-list"></i> '.Yii::t('app', 'Pagine'), ['admin/menu-content','id' => $model->id,'action'=>'pagine'], ['class' => 'btn btn-success']) ?>
        
					  </p>
                      <section class="panel">
                          <header class="panel-heading">
                               <?= Html::encode($this->title) ?>
                          </header>
                          
                          <div class="panel-body">
                             
								<div class="cms-menu-view">


									<?= DetailView::widget([
															'model' => $model,
																				'attributes' => [
																									'id',
																									'tag',
																									'classname',
																									'created_at:date',
																									'updated_at:date',
																									'name',
																								],
															]) ?>

								</div>


							

                          </div>
                      </section>
               </div>
</div>
</div>
