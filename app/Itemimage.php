<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itemimage extends Model
{
     static public function getImagesForItem($itemId){
         $urls=array();
         $Images=Itemimage::where('code' , $itemId)->get();
         foreach($Images as $image){
             $urls[]=$image->image_url;

         }
         return $urls;
     } 
}
