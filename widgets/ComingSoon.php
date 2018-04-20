<?php

namespace walter74\yiipress\widgets;


class ComingSoon extends \yii\bootstrap\Widget
{
    
    public $comingsoon_date=false;
    public $csd;
    public $template='<ul id="countdown">
					<li class="frist">
						<span class="days">{{d}}</span>
						<h3><span id="numdays">{{days}}</span></h3>
					</li>
					<li class="second">
						<span class="hours">{{h}}</span>
						<h3><span id="numhours">{{hours}}</span></h3>
					</li>
					<li class="three">
						<span class="minutes">{{i}}</span>
						<h3><span id="nummins">{{minutes}}</span></h3>
					</li>
					<li class="four">
						<span class="seconds">{{s}}</span>
						<h3><span id="numsecs">{{seconds}}</span></h3>
					</li>	
				</ul>';
	public $seconds_header="Seconds";
	public $minutes_header="Minutes";
	public $hours_header="Hours";
	public $days_header="Days";
    public function init(){
		     parent::init();
		   //  $view=$this->getView();
		     $d1=new \DateTime(); 
		 	 $d2=new \DateTime($this->comingsoon_date); 
             $this->csd=$d2->diff($d1); 
          /*   $js=<<<sss
             setTimeout(function() {location.reload();}, 1000);
sss;
		     $view->registerJs($js);*/
		   }
    public function run(){
			
		     $this->template=str_replace('{{days}}',$this->days_header,$this->template);
		     $this->template=str_replace('{{hours}}',$this->hours_header,$this->template);
		     $this->template=str_replace('{{minutes}}',$this->minutes_header,$this->template);  
		     $this->template=str_replace('{{seconds}}',$this->seconds_header,$this->template);
		     
		     
		     $this->template=str_replace('{{d}}',$this->csd->d,$this->template);
		     $this->template=str_replace('{{h}}',$this->csd->h,$this->template);
		     $this->template=str_replace('{{i}}',$this->csd->i,$this->template);  
		     $this->template=str_replace('{{s}}',$this->csd->s,$this->template);
		  
		   return $this->template;
	
	
	}
    
  

   
}
