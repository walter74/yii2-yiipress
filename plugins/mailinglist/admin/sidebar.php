<?php
return [
                    'label'=>' <i class="fa fa-book fa-2"></i> <span>Mailing List</span><span class="menu-arrow arrow_carrot-right"></span>',
					'url'=>'javascript:;',
					'items'=>[
								[	
								'label' => \Yii::t('app','Info'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/run','plugin_name'=>'mailinglist','action'=>'view'])
								],
								[	
								'label' => \Yii::t('app','Elenca'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/run','plugin_name'=>'mailinglist','action'=>'elenca'])
								],
								[	
								'label' => \Yii::t('app','Aggiungi'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/run','plugin_name'=>'mailinglist','action'=>'aggiungi'])
								],
							],
					 
	                 'submenuTemplate'=> (\Yii::$app->request->get("plugin_name")=="mailinglist")?"\n<ul class=\"sub\" style=\"display: block;\">\n{items}\n</ul>\n":"\n<ul class=\"sub\">\n{items}\n</ul>\n",
	              



];
