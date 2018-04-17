Yii Press - Cms Module For Yii Developer
========================================
Module Yii2 for content management system Yii App

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist walter74/yii2-yiipress "*"
```

or add

```
"walter74/yii2-yiipress": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply set config.php module adding the following instruction within 
modules configuartion array

```php
'modules'=>[
			'cms' => [
           
						'class' => 'walter74\yiipress\Module',
						
					]
			]


```
then access module by rooting r=cms/admin to access admin controller... 
r=cms/default to default controller which represent the frontend
