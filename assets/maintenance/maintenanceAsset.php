<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\cms\assets\maintenance;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class maintenanceAsset extends AssetBundle
{
  
    public $css = [
					"css/style.css",
                   ];
    public $js = [
					"http://code.jquery.com/jquery-1.9.1.min.js",
					"js/countdown.js",
					"js/init.js"
                 ];
    public $depends = [
        
         //'yii\web\YiiAsset',
         //'yii\bootstrap\BootstrapAsset',
 
    ];
    public function init(){ 
	    
	    $this->sourcePath=__DIR__ .'/assets';
	    
	    parent::init();
	}
}
