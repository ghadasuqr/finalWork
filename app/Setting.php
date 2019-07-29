<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    
    public   static function getSetting($setting){
        $settingValue=Setting::where('settingName' , $setting)->first();

        return $settingValue->settingContent ;   
    }

    public function selectedFn( $setting ,$value){
       $selected='';
        if (self::getSetting($setting) == $value){
            $selected = 'selected';
        }
    }
}
