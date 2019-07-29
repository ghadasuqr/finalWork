<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    protected $table = 'names';
    public static  function saleNames(){
        $saleNames=Name::get();
        return $saleNames;

    }//fun

}
