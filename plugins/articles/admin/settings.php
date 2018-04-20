<?php
return (file_get_contents(__DIR__ .'/settings.json')!==false && is_array(\yii\helpers\Json::decode(file_get_contents(__DIR__ .'/settings.json'))))?\yii\helpers\Json::decode(file_get_contents(__DIR__ .'/settings.json')):[
         'article_page'=>'articolo',
         'articles_page'=>'articoli'
         ];

