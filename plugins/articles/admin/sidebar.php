<?php

return [
                    'label'=>' <i class="icon_documents_alt"></i> <span>Articles</span><span class="menu-arrow arrow_carrot-right"></span>',
					'url'=>'javascript:;',
					'items'=>[
								[	
								'label' => \Yii::t('app','Elenca'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/run','plugin_name'=>'articles','action'=>'elenca'])
								],
								[	
								'label' => \Yii::t('app','Aggiungi'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/run','plugin_name'=>'articles','action'=>'aggiungi'])
								],
								[	
								'label' => \Yii::t('app','Info'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/run','plugin_name'=>'articles','action'=>'view'])
								],
								[	
								'label' => \Yii::t('app','Settings'), 
								'url' => \yii\helpers\Url::to(['/cms/admin/run','plugin_name'=>'articles','action'=>'settings'])
								]
							],
					 
	                 'submenuTemplate'=> (\Yii::$app->request->get('plugin_name')=='articles')?"\n<ul class=\"sub\" style=\"display: block;\">\n{items}\n</ul>\n":"\n<ul class=\"sub\">\n{items}\n</ul>\n",
	              



];
