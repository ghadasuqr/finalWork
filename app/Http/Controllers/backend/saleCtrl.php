<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 use Session;
 use Redirect;
 use App\Sale;
 use App\Item;
 use App\DB;
class saleCtrl extends Controller
{

    public function index()
    {

        if(  isset($_GET['q'])  ){
            $q=$_GET['q'];
     
                    if(!empty($q) ){                      
                        $Data = Sale::select("sales.*")

                        ->whereRaw('? between startDate and endDate', [$q])
            
                        ->get();

// dd($Data);
// works fine 
// $newQ= explode(' ',$request->startDate)[0];
// $Data=Sale::where('startDate' ,'<=' ,$q )->where('endDate' ,'>=' ,$q)->orderBy('startDate', 'desc')->get();

// Session::flash('success' , "     البداية (<  او =) تاريخ البحث   -  أو  -  النهاية ( >  او = ) تاريخ البحث  ") ;

 

        }


        }else
        $Data=Sale::orderBy('startDate', 'desc')->get();
        return view('backend.sale.list')->withData($Data);
        }

#=====================================================================================================================
#=====================================================================================================================
    public function create()
    {
    # 1- get items  not b in pervouis  sales 

        $itemsNotInPreSale=array();
        $items=Item::where('active' , 0)->get();
        if(count ($items)  > 0 ){
            foreach($items as $key =>  $item){
                if(! Sale::itemsInPreSales($item->code) ){
                    $itemsNotInPreSale[]= Item::where('code' ,$item->code  )->first() ;

                }
            }
            // dd($itemsNotInPreSale);
        }//if count items 
   
        return view('backend.sale.create')
                                        ->withitemsNotInPreSale($itemsNotInPreSale);
    }
#--------------------------------------------------------------------------------------------
    public function store(Request $request)
    {
     $request->validate([
        'startDate'=>'required',
        'endDate' =>'required',
        'percentageValue'=>'required|numeric|min:1|max:99' ,
        'itemsINsale'  =>'required' ])  ;

       
        $startDate= explode(' ',$request->startDate)[0];
       $endDate= explode(' ',$request->endDate)[0];        
        $today=date("Y-m-d");

   if ($startDate < $today){
      
            Session::flash('errorStart'  , " يجب أن  لا يقل تاريخ البداية عن  تاريخ  اليوم  ") ;
            return Redirect::back();   
         } elseif( $startDate >=$endDate   ){

            Session::flash('errorEnd'  , " يجب ان يكون تاريخ الانتهاء اكبر من   تاريخ البداية  ") ;

            return Redirect::back();
            

               }else{
                        try{
                                $sale=new Sale ;
                                $sale->startDate=$startDate;
                                $sale->percentageValue=$request->percentageValue;
                                $sale->endDate=$endDate;  
                                $sale->itemsINsale=json_encode($request->input('itemsINsale'));
                                $sale->save();                              
                                Session::flash('success'  , "تمت الاضافة بنجاح ") ;   
                            }catch(\Exception $ex){
                                Session::flash('error'  , "حدث خطأ أثناء الاضافة   ") ;
                            }
                   return Redirect::to('dashboard/sales');
                } //else
    }
#============================================================================================================================================
    public function show($id)
    {
        //
    }

#=================================================================================================
    public function edit($id)
    {
        
        if(!$id||Sale::where('saleNo' , $id)->count()== 0){
            return \App::abort(404);  }   
     // ---------------------------------------------------
    
  
# 1- get items  not b in pervouis  sales 
        $itemsNotInPreSale=array();
        $items=Item::where('active' , 0)->get();
            if(count ($items)  > 0 ){
                foreach($items as $key =>  $item){
                    if(! Sale::itemsInPreSales($item->code) ){

                        $itemsNotInPreSale[]= Item::where('code' ,$item->code  )->first() ;

                    }

                }
                // dd($itemsNotInPreSale);
        }//if count items 

# 2 - add $itemsINsale array codes  to $itemsNotInPreSale array 
    $sale=Sale::where('saleNo' , $id)->first();

    $itemsINsale=json_decode($sale->itemsINsale);

    if(count ($itemsINsale)  > 0 ){
        foreach($itemsINsale as $key =>$code){
            $itemsNotInPreSale[]= Item::where('code' ,$code  )->first() ;

        }
    }//if 
        return view('backend.sale.edit')
                                        ->withsale($sale)
                                        ->withitemsINsale($itemsINsale)
                                        ->withitemsNotInPreSale($itemsNotInPreSale);;


    
    }
#===========================================================================================================================================================

    public function update(Request $request, $id)

    {

     
            $request->validate([ 
       
            'percentageValue'=>'required|numeric|min:1|max:99' ,
            'itemsINsale'=>'required'
       ])  ;
    #==========================================
       $sale= Sale::where('saleNo' , $id)->first();

    #==== ====================================

    
    $today=date("Y-m-d");
#1=======================
if(!$request->input('startDate')){
    $startDate=$sale->startDate;
}else{
    $startDate= explode(' ',$request->startDate)[0];

    if ($startDate < $today){
       
              Session::flash('errorStart'  , " يجب أن  لا يقل تاريخ البداية عن  تاريخ  اليوم  ") ;
             return Redirect::back();  

    }//inner if 
}//if else
#2======================================
    if(!$request->input('endDate')){
        $endDate=$sale->endDate;
    }else{
        $endDate= explode(' ',$request->endDate)[0];

        if( $startDate >=$endDate   ){

            Session::flash('errorEnd'  , " يجب ان يكون تاريخ الانتهاء اكبر من   تاريخ البداية  ") ;

            return Redirect::back();
 
        }//inner if 
    }//if else


                        try{  
                              $items=json_encode($request->itemsINsale);

                            \DB::table('sales')->where('saleNo' ,$id)->update([
                                'startDate'      => $startDate ,
                                'percentageValue' => $request->percentageValue,
                                'endDate'         => $endDate ,
                                'itemsINsale'      => $items
                        ]);                              
                                Session::flash('success'  , "تمت التعديل بنجاح ") ;   
                            }catch(\Exception $ex){
                                Session::flash('error'  , "حدث خطأ أثناء التعديل  ".$ex) ;
                            }
                   return Redirect::to('dashboard/sales');
            
    
    
       

    }//update

// =========================================================================

    public function destroy($id)
    {

        if(!$id||Sale::where('saleNo' , $id)->count()== 0){
            return \App::abort(404);  }   
            #----------------------------------
            try{
            
                Sale::where('saleNo' , $id)->delete();
                Session::flash('success' , 'تم الحذف بنجاح');
            }catch(Exception $ex){
               Session::flash('error','حدث خطأ اثناء الحذف');
            }
     return Redirect::to('dashboard/sales');

    }
}
