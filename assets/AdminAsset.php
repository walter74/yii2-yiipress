<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace walter74\yiipress\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
  
    public $css = [
         "css/bootstrap.min.css",
         "css/bootstrap-theme.css",
         "css/elegant-icons-style.css",
         "css/font-awesome.min.css",
         "css/style.css",
         "css/style-responsive.css"
    ];
    public $js = [
           // "js/jquery.js",
            "js/bootstrap.js",
            "js/jquery.scrollTo.min.js",
            "js/jquery.nicescroll.js",
            "js/gritter.js",
            "js/scripts.js",

      /*   ["js/modernizr.custom.32033.js",'position'=>\yii\web\View::POS_HEAD],
         "js/bootstrap.min.js","js/jquery-1.11.1.min.js",*/
        // ["js/bootstrap.min.js",'depends'=>"js/jquery-1.11.1.min.js"],
    

    ];
    public $depends = [
         'app\assets\AppAsset',
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
 
    ];
    public function init(){ 
	    $this->sourcePath=__DIR__ .'/admin';
	    
	    parent::init();
	    
	    
	  
	
	
	
	}
}
  
