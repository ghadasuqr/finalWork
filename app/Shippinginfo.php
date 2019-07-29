<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shippinginfo extends Model
{
    static public  function getNameInfoById($id){
        $user=Shippinginfo::where('id' , $id)->first();
        //does not complete yet
    }
}
