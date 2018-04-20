<?php
return [
                    'url'=> \yii\helpers\Url::to(['/cms/admin/run','plugin_name'=>'mailinglist','action'=>'elenca']),
					'count'=>\plugins\mailinglist\models\CmsMailinglist::find()->count(),
					'title'=>'Mailing List',
					'icon'=>'<i class="fa fa-book"></i>'
	                // 'submenuTemplate'=> (\Yii::$app->controller->route=="cms/admin/articles")?"\n<ul class=\"sub\" style=\"display: block;\">\n{items}\n</ul>\n":"\n<ul class=\"sub\">\n{items}\n</ul>\n",
	              



];
