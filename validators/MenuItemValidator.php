<?php
namespace walter74\yiipress\validators;

use yii\validators\Validator;

class MenuItemValidator extends Validator
{
    public function validateValue($value)
    {
       if(is_array($value)){
		 foreach($value as $key_value_pair){
					if(!is_numeric($key_value_pair)&&!is_array($key_value_pair)&&!is_string($key_value_pair))
					    return [Yii::t('app', '{attribute} non valido.')];
						
		 }
	   }
	   else{
		     return [Yii::t('app', '{attribute} non è array.')];
	   }
       
    }
}
