<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imodel extends Model
{
    protected $table = 'imodels';

    static public function getmodelsByCatId($categoryNo){

        $models = Imodel::where('categoryNo',$categoryNo)->where('active' , 0)->get();
        return $models;

    }

    static public function getModeNamelById($modelNo){

        $row = Imodel::where('modelNo',$modelNo)->first();
        $modelName=$row->modelName;
        return $modelName;
    }

    static public function catNoByModelNo($modelNo){

        $row = Imodel::where('modelNo',$modelNo)->first();
        $catNo=$row->categoryNo;
        return $catNo;

    }



    
}
