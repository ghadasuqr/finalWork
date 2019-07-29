<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    static public function countWishes($userId){
        $data=Favorite::where('userId' , $userId)->get();
        return count($data);

    }
     static public function inWishList($code){
         if(Auth::check()){ // if there is any member login  check if item in wishlist
            $inWishList=Favorite::where('userId' , Auth::User()->id )->where('code' , $code)->first();
            if ($inWishList){
                return true;
            }

         }else{ // there is no login member
             return  false;
         }
   

     }
}
