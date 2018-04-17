<?php
/**
 * @copyright Copyright (c) 2013-2015 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace walter74\yiipress\widgets\tinymcecms;

use yii\web\AssetBundle;

class TinyMcePopupAsset extends AssetBundle
{
  

    public $js = [
     'tiny_mce_popup.js',
                
    ];
    public function init(){ 
	    $this->sourcePath=__DIR__ .'/tinymce/plugins/compat3x';
	    
	    parent::init();
	
	
	
	
	}
}
