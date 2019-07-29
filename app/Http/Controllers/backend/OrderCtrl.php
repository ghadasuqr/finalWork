<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use App\Order;
use App\Cart;
use App\Shippinginfo;
use App\User;
use App\Itemimage;
use DB;
use Auth;


class OrderCtrl extends Controller
{
    
    public function index(){

      if(isset($_GET['q'])){
         $q= trim($_GET['q']);
// dd($q);
         $data=DB::table('orders')->where('orderNo' ,'=' ,$q)->paginate(15);        

           }else{
         $data=Order::paginate(15);    
               
     }
         return view('backend.orders.list' , compact('data'));
   
   }
#===================================================
    public function new(){

      if(isset($_GET['q'])){
         $q= trim($_GET['q']);

         $data=DB::table('orders')->where('status' , 0)->where('orderNo' ,'=' ,$q)->paginate(10);        

           }else{
         $data=Order::where('status' , 0)->paginate( 10 );
           }
         return view('backend.orders.new' , compact('data'));

     }
#===================================================
     public function pending(){
      if(isset($_GET['q'])){
         $q= trim($_GET['q']);

         $data=DB::table('orders')->where('status' , 1)->where('orderNo' ,'=' ,$q)->paginate(10);        

           }else{

        $data=Order::where('status' , 1)->paginate (10 );

           }
        return view('backend.orders.pending' , compact('data'));

     }
  #=====================================================   
     public function returned(){
      if(isset($_GET['q'])){
         $q= trim($_GET['q']);

         $data=Order::where('isReturned' , 1)->where('orderNo' ,'=' ,$q)->paginate( 10 );
      }else{
      $data=Order::where('isReturned' , 1)->paginate( 10 );
      // $data=array();
      }
      return view('backend.orders.returned' , compact('data'));

   }
   #========================================================
   
   public function completed(){

      if(isset($_GET['q'])){
         $q= trim($_GET['q']);

         $data=DB::table('orders')
         ->where('status' , 2)
   
         ->where('orderNo' ,'=' ,$q)
         ->paginate(10);        

           }else{

        $data=Order::where('status' , 2)

        ->paginate (10 );

           }
     
        return view('backend.orders.completed' , compact('data'));


     }
     #================================================================
   public function paid(){
      if(isset($_GET['q'])){
         $q= trim($_GET['q']);

         $data=Order::where('isPaid' , 1)->where('orderNo' ,'=' ,$q)->paginate( 10 );
      }else{
      $data=Order::where('isPaid' , 1)->paginate( 10 );
      // $data=array();
      }
      return view('backend.orders.paid' , compact('data'));

   }


     #===================================================== updatae status and shipper==================================================== newstatus fn 
     public function newstatus(Request $request , $orderNo){
      $request->validate(['status' =>'required' ,
                      'shipperNo' =>'required']);
        $status=$request->input('status');
        $shipperNo=$request->input('shipperNo');
        $CostOfShip=$request->input('CostOfShip');
        try{
           DB::table('orders')->where('orderNo' , $orderNo)->update(['status' =>$status , 'shipperNo' =>$shipperNo]);
           
           if(  !empty($CostOfShip)  ){
            DB::table('orders')->where('orderNo' , $orderNo)->update(['CostOfShip' =>$CostOfShip]);

           }
        Session::flash('success' ,"تم التعديل بنجاح");

      }catch(Exception  $ex){
          Session::flash('error' ,$ex."حدث خطأ أثناء التعديل");
      }

      return Redirect::back();
   }
   #-----------------------------------------------
   public function pendingtatus(Request $request , $orderNo){
      $request->validate(['status' =>'required' ,
                      'shipperNo' =>'required']);
        $status=$request->input('status');
        $shipperNo=$request->input('shipperNo');
        $CostOfShip=$request->input('CostOfShip');
        try{
           DB::table('orders')->where('orderNo' , $orderNo)->update(['status' =>$status , 'shipperNo' =>$shipperNo]);
           
           if(  !empty($CostOfShip)  ){
            DB::table('orders')->where('orderNo' , $orderNo)->update(['CostOfShip' =>$CostOfShip]);

           }
        Session::flash('success' ,"تم التعديل بنجاح");

      }catch(Exception  $ex){
          Session::flash('error' ,$ex."حدث خطأ أثناء التعديل");
      }

      return Redirect::back();
   }
     #===================================================== updatae status and shipper====================================================


     public function viewOrderDetails($orderId){
         $orderId=$orderId;
        $data=Order::where('orderNo' , $orderId)->first();
        $cart_Ids=array();
        $cart_Ids=json_decode($data->cart_id);
       $user_shipping_info=Shippinginfo::where('orderNo' , $orderId)->first();
      
       return view('backend.orders.details')
               ->withuserInfo($user_shipping_info)
               ->withcartIds($cart_Ids)
               ->withorderId($orderId);
     }
     public function invoiceToAdmin($id){
      return view('backend.orders.invoiceToAdmin')->withid($id);

   }
// ========================== to shipper ================================//
// ========================== to shipper ================================//
// 1-=========================================================================================== Index shipper fn
public function shipperIndex(){
   if(isset($_GET['q'])){
      $q= trim($_GET['q']);

      $data=Order::where('shipperNo' ,Auth::User()->id)
                        ->where('orderNo' , '=' , $q)
                        ->where('status' , 2)
                        ->where('isPaid' , 0 )
                        ->where('isReturned' , 0)
                        ->get(); //choose ordered for this shipper while   not returned or paid yet 
   }else{
      $data=Order::where('shipperNo' ,Auth::User()->id)
                  ->where('isPaid' , 0 )
                  ->where('status' , 2)
                  ->where('isReturned' , 0)
                  ->get(); //choose ordered for this shipper while   not returned or paid yet 
      }
      return view('backend.layouts.shipper')->withdata($data);

}
#========================================to show completed orders to shipper to  confirm paid or returned status 
static public function returnedToShipper(){
   $data=Order::where('shipperNo' ,Auth::User()->id)->where('status' , 2)->where('isPaid' , 0 )->get(); //choose ordered for this shipper while   not returned yet 

}
//2- =================================================================================================== Details fn
     public function OrderDetailsToShipper($orderId){

      $data=Order::where('orderNo' , $orderId)->first();
      $cart_Ids=array();
      $cart_Ids=json_decode($data->cart_id);
     $user_shipping_info=Shippinginfo::where('orderNo' , $orderId)->first();
     $orderNo=$orderId;
    
     return view('backend.orders.detailsToShipper')
             ->withuserInfo($user_shipping_info)
             ->withcartIds($cart_Ids)
             ->withorderNo($orderNo);
   }#3 ===================================================================================================
   public function invoiceToShipper($id){
      return view('backend.orders.invoiceToShipper')->withid($id);

   }

 
   #=========================================== to show invoices  of returned orders to shipper 
   public function ReturnedShipping(){
      if(isset($_GET['q'])){
         $q= trim($_GET['q']);

         $data=Order::where('isReturned' , 1)->where('shipperNo' , Auth::user()->id)->where('orderNo' ,'=' ,$q)->paginate( 10 );
      }else{
      $data=Order::where('isReturned' , 1)->where('shipperNo' , Auth::user()->id)->paginate( 10 );
      // $data=array();
      }
      return view('backend.orders.ReturnedShipping' , compact('data'));

   }


   # 4- =================== Return  Order Function  FOr Shipper======================================= Return  orders fn
   
   public function return(Request $request, $orderNo){
      $data=Order::where('orderNo' , $orderNo)->first();    
      $cart_Ids=json_decode($data->cart_id);
     
      // fill array 

      $returndIds=array();
      foreach($cart_Ids as $key =>$Id){
         if ($request->has('returnedItem'.$key)){
            $returndIds[]=$request->input('returnedItem'.$key);
         }
      }
      // ======== work with new cart Id to add items in items list  
      try{
      if( count ($returndIds)  >0 ){
                  foreach($returndIds as $key =>$cartId){
                     $cart=Cart::where('id' , $cartId)->first();
#update cartid to be returned 
                     DB::table('carts')->where('id' , $cartId)->update(['isReturned' => 1]);
#update cartid to be returned 
                     #upadte count in size table                      
                     $color=$cart->color;
                     $code=$cart->code;
                     $size=$cart->size;
                     $quantity=$cart->quantity;

                     $row = DB::table('colors')->where('code', $code)->where('color' , $color)->first(); //get color of item
                     // dd($row);
                     $data=  DB::table('sizes')->where('id_color' , $row->id)->where('size' , $size)->first();  // get size
                     $oldCount=$data->count; // get quantity of this size
                     DB::table('sizes')->where('id_color' , $row->id)->where('size' , $size)->update(['count' => $quantity+$oldCount]);
                   }//foreach cartId
  #= in  OrderTable =========== Make Order Returned 
               DB::table('orders')->where('orderNo' , $orderNo)->update( ['isReturned' => 1]);
               Session::flash('success' , "تم الارجاع بنجاح");
               return Redirect::to('dashboard/shipper')  ;

         }else{
         Session::flash('request' , " يجب اختيار منتج على الاقل");
         return Redirect::back()  ;


               }

      }catch(Exception $ex){

         Session::flash('error' , "حدث خطأ أثناء الارجاع");
         return Redirect::to('dashboard/shipper')  ;

      }

   }//fun Return

   
   #=================================================== ُEnd  Return  Order Function ==========================
   #=================================================== paid   Order Function ==========================
   public function ConfirmPaid(Request $request , $id){
      try{
      DB::table('orders')->where('orderNO' , $id)->update(['isPaid' => 1]);

         Session::flash('success', " تم تأكيد الدفع بنجاح");
         Session::flash('id',$id);

         return Redirect::to('dashboard/shipper')  ;
      }catch(Exception $ex){
         Session::flash('error' , " حدث خطأ أثناء  تاكيد الدفع");
         return Redirect::to('dashboard/shipper')  ;
      }

   }
      #=================================================== paid   Order Function ==========================

   #=================================================== ُOrders TO Ship =======================================
   public function ToShip(){
      $data=Order::where('status' , 2)->where('isReturned' , 0)->where('shipperNo' , Auth::User()->id)->get();
      return view('backend.orders.completeToShip' , compact('data'));
   }
 #=================================================== ُOrders Details  TO Ship =======================================
 
 public function viewOrderDetailsToShip($orderId){
   $orderId=$orderId;
  $data=Order::where('orderNo' , $orderId)->first();
  $cart_Ids=array();
  $cart_Ids=json_decode($data->cart_id);
 $user_shipping_info=Shippinginfo::where('orderNo' , $orderId)->first();

 return view('backend.orders.detailsToShip')
         ->withuserInfo($user_shipping_info)
         ->withcartIds($cart_Ids)
         ->withorderId($orderId);
}
// ========================== End  shipper ================================//
// ==========================  End shipper ================================//



# ======================================== destroy============================================== desroy fn

     public function delete($id)
     {
      
             try{
               DB::beginTransaction();
               //  cart
               $data=Order::where('orderNo' , $id)->first();
               $cart_Ids=array();
               $cart_Ids=json_decode($data->cart_id);
               foreach($cart_Ids as $cartId){
                  Cart::where('id' , $cartId)->delete();
               }
               // shipping adddress
                  Shippinginfo::where('orderNo' , $id)->delete();
               // order   
                 Order::where('orderNo' , $id)->delete();
                 DB::commit();
 
                 Session::flash('success' , 'تم الحذف بنجاح');
             }catch(Exception $ex){
                throw($ex);
                DB::rollback();
             }
             return Redirect::back();
 
     }//desrroy
     
}
