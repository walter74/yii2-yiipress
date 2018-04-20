<?php

namespace walter74\yiipress\widgets;


class CurrentTime extends \yii\bootstrap\Widget
{
    
    public $year=false;
    public $month=false;
    public $days=false;
    
    public function run(){
			if($this->year===true)
				return date('Y');
				
			if($this->day===true)
			    return date('D');
			
		    if($this->month===true)
		        return date('M');
		        
		   return Yii::$app->formatter->asDate(time());
	
	
	}
    
  

   
}
