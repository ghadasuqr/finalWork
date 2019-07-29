<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    static public function itemsINsale($saleNo){
           $items=Sale::where('saleNo' , $saleNo)->first();
           $itemsInsale=array();
           $itemsInsale=json_decode($items->itemsINsale); // decode &   encode
           return $itemsInsale;
    }
     static  public function rightDate($date){
        $rightDate= explode(' ',$date)[0] ;
 
        return $rightDate;
     }
     static  public function dateToEdit($date){
      $editDate=str_replace('-','/', $date);                  
      $editDate=date("m/d/Y", strtotime($date));
      return $editDate;
   }
     static  public function isCurrentSale($saleNo){
   $date=date('Y-m-d');
   $data=Sale::where('saleNo' , $saleNo)
   ->where('startDate' , '<=',$date)
   ->where('endDate' , '>=',$date)        
   ->get();  
      return count($data);
     }

     static function NotYetSale($saleNo){
      $date=date('Y-m-d');
      $data=Sale::where('saleNo' , $saleNo)
      ->where('startDate' , '>',$date)         
      ->get();  
         return count($data);
        }

        static function finished($saleNo){
         $date=date('Y-m-d');
         $data=Sale::where('saleNo' , $saleNo)
         ->where('endDate' , '<',$date)         
         ->get();  
            return count($data);
           }
      // =========================================================
     static  function isactive($saleNo){
        $active;
      if (self::isCurrentSale($saleNo)  == 1) {
         $active= 'جارى ';
         return $active;

      }
     
     if (self::NotYetSale($saleNo)  == 1) {
      $active= 'مستقبل';
      return $active;

   }

      if (self::finished($saleNo)  == 1) {
         $active= 'انتهى';
         return $active;
      }
      
      
  
}
// ========================================================= show discount for currently discounts only for items discount 
//   show discount for currently discounts only 


   static public  function isCurrent($item){
      $date=date('Y-m-d');
         
      $data=Sale::where('startDate' , '<=',$date)
            ->where('endDate' , '>=',$date)        
            ->get();
            foreach($data as $Key =>$sale){
            $items=json_decode($sale->itemsINsale);
                     if(in_array($item , $items)){
                     return $sale->percentageValue;
               }//foreach
     }//if

}


// ============================ for add Another Sale=================== used before for create and edit 

//   show  gurantee the added items to this sale was not added in another sale in the current or future sales 

#
static public  function isInSale($item , $startDate ,$endDate){
   $date=date('Y-m-d');  
   $startDate;
   $endDate;
   
   $minStart=Sale::where('startDate' , '<=',$date)->where('endDate' , '>=',$date)->min('startDate');     
   $maxEnd=Sale::where('startDate' , '<=',$date)->where('endDate' , '>=',$date)->max('endDate');

   if($startDate >= $minStart && $endDate <= $maxEnd){
#-------------------- sales between    minstart >=    here              <=   maxend 
   $data=Sale::where('startDate' , '>=',$minStart)
         ->where('endDate' , '<=',$maxEnd)        
         ->get();
         foreach($data as $Key =>$sale){
         $items=json_decode($sale->itemsINsale);
                  if(in_array($item , $items)){
                  return true;
            }//foreach
  }//if
   }//duration 
}



// ========================= DURATION  of current sales  if found ========================================  not used now 
  
static public function duration(){
  $date=date('Y-m-d');   
      
   $minStart=Sale::where('startDate' , '<=',$date)->where('endDate' , '>=',$date)->min('startDate');

     
   $maxEnd=Sale::where('startDate' , '<=',$date)->where('endDate' , '>=',$date)->max('endDate');   


  $duration=  date_diff(   date_create($minStart)  , date_create($maxEnd)  )->format("%a") ;
  return $duration;

 }//
 #=================================================================== for Sale blade in index home
 static public function maxEndDate(){
   $date=date('Y-m-d');   
       
 
      
    $maxEndDate=Sale::where('startDate' , '<=',$date)->where('endDate' , '>=',$date)->max('endDate');   
 

   return  $maxEndDate;
   // dd($maxEndDate);
  }//
//  ========================================================================================== for Sale blade in index home
 static public function EndedAT(){
   $date=date('Y-m-d');   
       
    $minStart=Sale::where('startDate' , '<=',$date)->where('endDate' , '>=',$date)->min('startDate');
 
      
    $maxEnd=Sale::where('startDate' , '<=',$date)->where('endDate' , '>=',$date)->max('endDate');   
 
 
   $endedAt=  date_diff(   date_create($date)  , date_create($maxEnd)  )->format("%a") ;

   return $endedAt;
 
  }//EndedAT
//   ============================================================================ for Sale blade in index home
 static public function maxDiscount(){
   $date=date('Y-m-d');   
      
   $maxDisount=Sale::where('startDate' , '<=',$date)->where('endDate' , '>=',$date)->max('percentageValue');
   return $maxDisount;
 }
//  ================================================================================== gor mostSold in Sale blade  for Admin 

static  public function mostSoldInSale($end ,$start){



   $end=date_create($end);
   $start=date_create($start);

try{
      $items=DB::table('carts')
      ->select('code' ,  DB::raw(' SUM(quantity) as totalQty ') )
      ->where('IsOrdered' ,'=' ,1)      
      ->where( 'orderDate'  ,'<='  , $end ) 
      ->where( 'orderDate'    ,'>=' , $start ) 
      ->groupBy('code')
      ->orderBy('totalQty' , 'DESC')
      ->get();


      }catch(Exception $ex){
      throw $ex;
      }



return $items ;

}
#============================================================
static public function priceAfterDiscount($price  , $ratio){
   $afterDiscount = $price - ($price*$ratio /100);
   return $afterDiscount;
   }
#------------------------ For crete and Edit sale functions , every Sale starting and not end yet , active or future

static public function itemsInPreSales($code){
   $date=date('Y-m-d');     
   $minStart=Sale::where('startDate' , '<=',$date)->where('endDate' , '>=',$date)->min('startDate');     
   // $maxEnd=Sale::where('startDate' , '<=',$date)->where('endDate' , '>=',$date)->max('endDate');

      $data=Sale::where('startDate' , '>=',$minStart)
            ->where('endDate' , '>=',$date)        
            ->get();

         foreach($data as $Key =>$sale){

             $items=json_decode($sale->itemsINsale);

                  if(in_array($code , $items)){
                     return $code;
                  }//if
            }//foreach

   }//fn

#-------------------------------------------------
}//
