<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
   static public function getItemColors($id){

         $colors=Color::where('code' ,  $id)->get();
         return $colors;
     }
     static public function getItemColors_itself($id){
        $colors_itself =array();

        $colors=Color::where('code' ,  $id)->get();
        foreach($colors as $key=>$color){
            $colors_itself[]=$color->color;
        }
        return $colors_itself;
    }//
    
    static public function getItemsizesForColors($id , $color){
        $sizesForColor =array();
        $sizes=array();

        $data=\DB::table('items')
        ->join('colors' , 'items.code','colors.code')
        ->join('sizes' , 'colors.id','sizes.id_color')
        ->where('items.code' ,'=',  $id)
        ->where('colors.color' ,'=' ,$color)
        ->select('sizes.size')
        ->get();

        foreach($data as $Key => $row ){
           $sizesForColor[] = $row->size;
        }


   return $sizesForColor;
    }//fun
    static public function color($id ){
        $colors=Color::where('id' ,  $id)->first();
$color=$colors->color;
return $color;
    }
}
