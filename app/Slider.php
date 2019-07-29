<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
     static public function slidersToINdex(){
        $sliders=Slider::where('active' , "نعم")->orderBy('sort' , 'DESC')->get();  
        return $sliders;      

     }
}
