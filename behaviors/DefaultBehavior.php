<?php
namespace walter74\yiipress\behaviors;

use yii\base\Behavior;

class DefaultBehavior extends Behavior
{
    public function ReplaceRecursiveSections($content,$model_sections,&$loop_number,$max_loop=1000){
		if(is_array($model_sections)){
			foreach($model_sections as $section){
			
				if(!is_object($section)){
					return $content;
				}
			//control of presence of placeholder 
				if(strpos($content,$section->tag)!==false){
					$content=str_replace($section->tag,$section->content,$content);
					$loop_number++;
				
					if($loop_number>=$max_loop)
						break;
				
					$content=$this->ReplaceRecursiveSections($content,$model_sections,&$loop_number,$max_loop);
				}
	   
			
			}
		}
		return $content;
	}
}
