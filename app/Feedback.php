<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';


    static public  function Average($code){
      

        $items=DB::table('feedbacks')
        ->select('code' ,   DB::raw(' avg(points) as average ') )
        ->where('code' ,'=' ,$code)
        ->where('points' , '!=' , 0)
        ->groupBy('code')
        ->first();
        if ($items){

            $result=$items->average * 20 .'%'; 
 
        
     
        } else{
            $result=' لم يتم تقييمه بعد ';
 
        }    
return $result;




    }
}
