<?php

namespace App;
use Auth;
use DB;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    static public function Total($userId){
        $total=0;
        $data=Cart::where('user_id',$userId )->where('isOrdered' ,0)->get();
            if(count($data)  > 0 ){
                foreach(Cart::where('user_id',$userId )->where('isOrdered' ,0)->get() as $row){
                    $price = $row->price - ($row->ifDiscount * $row->price )/100;

                    $total+= $price * $row->quantity;
                }//foreach
            }
      
        return $total;
    }//fun

    static public function CountCart($userId){
        $data=Cart::where('user_id' , Auth::User()->id)->where('isOrdered' , 0)->get();
        $count=count($data);
        return $count;
    }
#==============================================================================
    static public function TotalForOrder($cartIds){
        $total=0;

        foreach($cartIds as $cartId){
           $row= Cart::where('id',$cartId )->first();
           if($row->isReturned==0){
        

            $price = $row->price - ($row->ifDiscount * $row->price )/100;

            $total+= $price * $row->quantity;
           }
          
        }//foreach

        return $total;

    }//fun
#=====================================================================================

static public function TotalForReOrder($cartIds){
    $total=0;

    foreach($cartIds as $cartId){
       $row= Cart::where('id',$cartId )->first();
       if($row->isReturned==0){
    

        $price = $row->price - ($row->ifDiscount * $row->price )/100;

        $total+= $price * $row->quantity;
       }
      
    }//foreach

    return $total;

}//fu
// ================================== to show in Most Sold ======================================
    static public function getItemPrice($code){
        $item=Item::where('code'  , $code)->first();
        $price=$item->price;
        return $price;
    }
#=================================== Price

static public function Price($price  , $discount){
$price=$price - ($discount*$price)/100;
return $price;
}


static public function subTotal( $cartId){
    $subtotal=0;

    $row=Cart::where('id',$cartId )->first();

    $price = $row->price - ($row->ifDiscount * $row->price )/100;

    $subtotal= $price * $row->quantity;

    return $subtotal;
    }
#======================================= Total for Cart

static public  function totalForInvoice($cartIds){
    $total=0;

    foreach($cartIds as $cartId){

       $row= Cart::where('id',$cartId )->first();

       $price = $row->price - ($row->ifDiscount * $row->price )/100;

       $total+= $price * $row->quantity;
     
    
     
      
    }//foreach

    return $total;
}
// ======================= for invoice============================================
static public  function totalForCart($cartIds){
    $total=0;

    foreach($cartIds as $cartId){
       $row= Cart::where('id',$cartId )->first();
       $price = $row->price - ($row->ifDiscount * $row->price )/100;

       $total+= $price * $row->quantity;

    }//foreach

    return $total;
}
#================================================

}//ctrl
