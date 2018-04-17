<?php
return [
                    'url'=> \yii\helpers\Url::to(['/cms/admin/run','plugin_name'=>'articles','action'=>'elenca']),
					'count'=>\plugins\articles\models\CmsArticles::find()->count(),
					'title'=>'Articles',
					 'icon'=>'<i class="icon_documents_alt"></i>'
	                // 'submenuTemplate'=> (\Yii::$app->controller->route=="cms/admin/articles")?"\n<ul class=\"sub\" style=\"display: block;\">\n{items}\n</ul>\n":"\n<ul class=\"sub\">\n{items}\n</ul>\n",
	              



];
 
