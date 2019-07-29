<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Item extends Model
{
    protected $table = 'items';
        static public function latest(){
                $items=DB::table('items')
                ->where('active' , 0)
                ->orderBy('created_at', 'desc')
                ->limit(4)
                ->get();
                return $items;
            }//latest

        static public function getItemName($code){
            $item=Item::where('code'  , $code)->first();
            $Name=$item->itemDescription;
            return $Name;
        }



        static public function inSale($code){
            $items=Item::where('code' ,$code )->get();
            return $items;
        }

        static public function getModelNo($code){

            $item=Item::where('code' ,$code )->first();
            $modelNo=$item->modelNo;

            return $modelNo;
        }

        static public function getPrice($code){
            $item=Item::where('code'  , $code)->first();
            $price=$item->price;
            return $price;
        }

}
