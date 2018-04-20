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
class SortableAsset extends AssetBundle
{
  
     public $css = [
           
            "css/application.css",

    ];
    public $js = [
          
            "js/jquery-sortable.js",
            
            "js/application.js",

      /*   ["js/modernizr.custom.32033.js",'position'=>\yii\web\View::POS_HEAD],
         "js/bootstrap.min.js","js/jquery-1.11.1.min.js",*/
        // ["js/bootstrap.min.js",'depends'=>"js/jquery-1.11.1.min.js"],
    

    ];
    public $depends = [
        
         'yii\web\YiiAsset',
         'yii\bootstrap\BootstrapAsset',
 
    ];
    public function init(){ 
	    $this->sourcePath=__DIR__ .'/sortable';
	    
	    parent::init();
	    
	    
	  
	
	
	
	}
}
