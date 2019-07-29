<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
     static public function  getSizesforColor($colorId){

        $sizes=Size::where('id_color' , $colorId)->get();
        return $sizes;


     }
}
