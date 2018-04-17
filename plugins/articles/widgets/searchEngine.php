<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace plugins\articles\widgets;

use Yii;


class searchEngine extends \yii\bootstrap\Widget
{
   public $searchView="searchView";
   public $slug="articles";
   public function run()
    {
      $model= new \plugins\articles\models\CmsArticlesWordSearch();
     
      return $this->render($this->searchView,["model"=>$model,"slug"=>$this->slug]);
      
    }
}
