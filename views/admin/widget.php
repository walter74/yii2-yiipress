<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Cmssections */
/* @var $form ActiveForm */

/* @var $this yii\web\View */

$this->title="Widget #".$model->id;

$this->params['breadcrumbs'][]=[
            'label' => 'Widgets',
            'url' => ['admin/widgets'],
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
<p>
					<?= Html::a('<i class="fa fa-pencil"></i> '.Yii::t('app', 'Aggiorna'), ['admin/widget','id' => $model->id,'action'=>'update'], ['class' => 'btn btn-primary']) ?>
								
</p>
<div class="col-lg-12">
	<div class="row">
               
					  
                      <section class="panel">
                          <header class="panel-heading">
                               <?= Html::encode($this->title) ?>
                          </header>
                          
                          <div class="panel-body">
                             
								<div class="cms-widget-view">


									<?= DetailView::widget([
															'model' => $model,
																				'attributes' => [
																									'id',
																									'tag',
																									'classname',
																									'args',
																									'created_at:date',
																									'updated_at:date',
																									
																								],
															]) ?>

								</div>


							

                          </div>
                      </section>
              
	</div>
</div>
