<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Session;
use Redirect;
use DB;
use Auth;
use App\Color;
use App\Favorite;
use App\Cart;
use App\Sale;
use App\Order;
use App\Shippinginfo;
use App\Invoice;
class OrderCtrl extends Controller
{
    public function create(){
        return view('frontend.orders.checkout');
        
    }
    public function store(){


    }

#  1- start Cart=========================================================


public function cart(){
    if(!Auth::check()  ||  !Auth::User()->Role == 0 )                          

    {return Redirect::to('login');}   
    $data=DB::table('carts')->where('user_id' , Auth::User()->id)->where('IsOrdered' ,'0')->get();
    $orders=DB::table('orders')->where('user_id' , Auth::User()->id)->where('status' , 2)->get();
// dd($orders);
        return view('frontend.orders.cart')->withdata($data)->withorders($orders);
}
# 2-  start add To cart=====================================================
public function addToCart(Request $request){
    $price=$request->input('price');
    $code=$request->input('code');
    $modelNo=$request->input('modelNo');
    $itemDescription=$request->input('itemDescription');
    // -------------------------
    $color=Color::color($request->input('color'));
    // dd($color);
    // ---------------------------------
    $size=$request->input('size');    
    
    #validation

    $request->validate([
        'color' => 'required',
        'size' => 'required'
    ]);
    #validation

    // if found 
    $myFound=DB::table('carts')
    ->where('user_id' , Auth::User()->id)
    ->where('code' , $code)
    ->where('modelNo' , $modelNo)
    ->where('color' , $color)
    ->where('size' , $size)
    ->get();
    if( count($myFound) !==0){
        $item=DB::table('items')->where('code' ,$code)->first();
        Session::flash('error' ,$item->itemDescription.'         '.'  '.$size.'    '.$color.'  '.' تمت   اضافته   مسبقا ');
        return Redirect::to('cart');
    }else{
            try{
                $row= new Cart;
                $row->code=$code;       
                $row->modelNo=$modelNo;
                $row->user_id=Auth::User()->id;
                // $row->date= date('Y-m-d'); 
                if( Sale::isCurrent($code) ){
                    $discount=Sale::isCurrent($code);
                    $row->ifDiscount=$discount;
                }
                $row->price=$price;
                $row->color=Color::color($request->input('color'));
                $row->size=$request->input('size');        
                $row->save();
                Session::flash('success' , 'تمت الاضافة بنجاح');
            // return Redirect::to('cart');

            }catch(Exception $ex){
                 Session::flash('error' , 'حدث خطأ اثناء الإضافة');
            }
        return Redirect::to('cart');

    }//else if count 
}//add to cart 

# END add To cart------------------------------------------------------
// ================================================================================================================

# Start update cart------------------------------------------------------

public function updateCart(Request $request){
    $user_id=Auth::User()->id;
    $id=$request->id;
    $quantity=$request->quantity;
    $ifDiscount=$request->ifDiscount;
    $subtotal=0;
    $total=0;
    try{
        //update cart by new quantity
        $cart=Cart::where('id' , $id)->where('user_id' ,$user_id)->first();
        $cart->quantity=$quantity;
        $cart->save();
   
        $price = $cart->price - ($cart->ifDiscount * $cart->price )/100;

        //calcuklate subtotal
        $subtotal=$price*$cart->quantity;
        //calcuklate subtotal

        //calculate Total        
        $data=Cart::where('user_id' ,$user_id)->where('IsOrdered' , 0)->get();

        foreach($data as $singledata){

            $price = $singledata->price - ($singledata->ifDiscount * $singledata->price )/100;

            $total +=$price * $singledata->quantity;
        }
         //calculate Total
     
         $status=true;
    }catch(Exception $ex){
        

    }
    return response()->json(['success'=>$status ,'subtotal' =>$subtotal , 'total' =>$total]);


}
# END update cart------------------------------------------------------

#4- start destroy Cart========================================================================================
public function CartDestroy($id){
    try{
        Cart::where('id' , $id)->delete();
    Session::flash('success' , "تم الحذف بنجاح");

    }catch(Excption $ex){
        Session::flash('error' , "  حدث خطا اثناء الحذف");
    }
    return Redirect::to('cart');
}//destroy

# End destroy ---------------------------------------------------------End cart

#Start ckeckout===========================================================================================================================
#================================================================================================================================================
### 1- show shippng  details to order
public function OrderCart(){
#check if not authorized 

if(!Auth::check()  ||  !Auth::User()->Role == 0 )                          

{return Redirect::to('login');}

#get data if user login and cart is not ordered yet

$data=DB::table('carts')->where('user_id' , Auth::User()->id)->where('IsOrdered' ,'0')->get();
return view('frontend.orders.checkout' , compact('data'));

}// OrderCart

### 2- Strat storOrderCart  ###===============================================================================

public function storeOrderCart(Request $request){
    
$request->validate([
'receiverName' =>'required|min:10|max:60|regex:/^[ءa-zA-Zأ-ي\s]*$/u' ,
'receiverPhone' =>'required|regex:/^[0-9]{12}$/' ,
'country' =>'required|min:3|max:70|regex:/^[0-9ء,.a-zA-Zأ-ي\s]*$/u' ,
'city' =>'required|min:2|max:50|regex:/^[0-9ء,.a-zA-Zأ-ي\s]*$/u' ,
'town' =>'required|min:2|max:50|regex:/^[0-9ء,.a-zA-Zأ-ي\s]*$/u' ,
'address' =>'required|min:10|max:200' ,
]);

try{
    DB::beginTransaction();
    #transaction gurantees that 2 oprations of saving will happened alltogether
 
#1- save order table data
    $order= new Order;
    $cart_id=array();
    $data=DB::table('carts')->where('user_id' , Auth::User()->id)->where('IsOrdered' ,0)->get();
    // $cart_id=DB::table('carts')->where('user_id' , Auth::User()->id)->where('IsOrdered' ,'0')->pluck('id');  ... another true way 

    foreach($data as $key =>$row){
        $cart_id[]=$row->id;
    }
    if(count ($cart_id) >0 ){
                $order->user_id=Auth::User()->id;
                $order->cart_id=json_encode($cart_id);   //or implode 
                $order->save();
                $lastOrderId=Order::max('orderNo');
                $invoice=new Invoice();
                $invoice->orderNo=$lastOrderId;
                #2-Update isOrdered field in carts table 
                foreach($cart_id as $id){
                    DB::table('carts')->where('id' , $id)->update(['isOrdered' =>1 , 'orderDate'=>date('Y-m-d')]); // update carts table
                    }
                #3- save shippnigInfo  table data
                $shippinginfo=new Shippinginfo;
                $shippinginfo->orderNo=$lastOrderId;
                $shippinginfo->userId=Auth::User()->id;
                $shippinginfo->receiverName=$request->input('receiverName');
                $shippinginfo->receiverPhone=$request->input('receiverPhone');
                $shippinginfo->country=$request->input('country');
                $shippinginfo->city=$request->input('city');
                $shippinginfo->town=$request->input('town');
                $shippinginfo->address=$request->input('address');
                $shippinginfo->save();


                # 4- update cart status from 0 to 1


                // decrease counts 
                foreach($cart_id as $id){
                    $cart=Cart::where('id' , $id)->first();                                
                    $color=$cart->color;
                    $code=$cart->code;
                    $size=$cart->size;
                    $quantity=$cart->quantity;
                    $row = DB::table('colors')->where('code', $code)->where('color' , $color)->first(); //get color of item
                     
                    $data=  DB::table('sizes')->where('id_color' , $row->id)->where('size' , $size)->first();  // get size
                    $oldCount=$data->count; // get quantity of this size
                    DB::table('sizes')->where('id_color' , $row->id)->where('size' , $size)->update(['count' => $oldCount - $quantity]);  
                }
    }//if count  (data )in cart where ordered==0  >0 

DB::commit();
Session::flash('successO' , "سيتم ارسال الفاتورة مجددا فور   اكتمال التجهيز  ");

return Redirect::to ('successO/'.$lastOrderId);




#5-decreas count of sizes for that item
#6-invoice page ===========================================================================================

#6-invoice page ===========================================================================================


}catch(\Exception $ex){
    Session::flash('error' , "حدث خطأ أثناء الارسال ");
    #if problem happened
    DB::rollback();
    return Redirect::back();

}




}//store order cart
#End ckeckout===========================================================================================================================
#================================================================================================================================================


public function invo($id)
{
    return view('frontend.orders.successO')->withid($id);
}
#=======================================================
public function OrderDetails($orderId){
    $orderId=$orderId;
   $data=Order::where('orderNo' , $orderId)->first();
   $cart_Ids=array();
   $cart_Ids=json_decode($data->cart_id);
  $user_shipping_info=Shippinginfo::where('orderNo' , $orderId)->first();
 
  return view('frontend.orders.details')
          ->withuserInfo($user_shipping_info)
          ->withcartIds($cart_Ids)
          ->withorderId($orderId);
}
#===============================================================
}//ctrl
