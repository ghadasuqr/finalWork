<?php

namespace App\Http\Controllers\frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use App\category;
use App\Item;
use App\Feedback;
use App\Sale;
use DB;
use Session;
use Redirect;
class productsCtrl extends Controller
{
    // products page ------------------============================================  الاقسام ==========================
    public function index(){
        $emptyErrors=array();
        // $data=category::where('active' , 0)->get();
        $items=DB::table('items')->where('active' ,'=' , 0)->orderby('created_at' , 'DESC')->get();

      
        return view ('frontend.pages.products')->withitems($items)->withemptyErrors($emptyErrors);
    }
    public function modelItems($modelNo){
        $emptyErrors=array();
        $data=category::where('active' , 0)->get();
        $items=DB::table('items')->where('modelNo' , $modelNo)->where('active' ,'=' , 0)->orderby('created_at' , 'DESC')->get();
        return view ('frontend.pages.products')->withitems($items)->withemptyErrors($emptyErrors);


    }
    public function sizColor(){
        #---sidebar
        // $data=category::where('active' , 0)->get();
   
        #---sidebar
        if(isset($_GET['filter'])){
            
            // =================== validation
            $emptyErrors=array();
            if(empty($_GET['color']) ){ $emptyErrors[] ="يجب اختيار اللون  " ;}
            if(empty($_GET['size']) ){ $emptyErrors[] =" يجب اختيار المقاس" ;}
    #------------- validate correct  min price ---------------------
            if(empty($_GET['min']) ){ $emptyErrors[] =" يجب اختيار ادنى سعر " ;}
            if($_GET['min'] >=$_GET['max']){ $emptyErrors[] =" لا يجب ان يكون ادنى سعر اكبر من أو يساوى  اعلى سعر" ;}
    #------------------ validate correct max price  -----------------
            if(empty($_GET['max']) ){ $emptyErrors[] =" يجب اختيار اعلى سعر " ;}
            if($_GET['max'] <= $_GET['min'] ){ $emptyErrors[] =" لا يجب ان يكون اعلى سعر اقل من او يساوى ادنى سعر " ;}

            if (count ($emptyErrors) > 0 ){
                $items=array();
                Session::flash('validation' , $emptyErrors);
                return view ('frontend.pages.products')->withitems($items)->withemptyErrors($emptyErrors)->withrsize($_GET['size']);

            }

    if (count($emptyErrors) == 0){
#------------------------------- errors==0
        try{
                // inputs=============
                $color=$_GET['color'];
                $size=$_GET['size'];
                $min=$_GET['min'];
                $max=$_GET['max'];

                $items=  DB::table('items')        
                ->join('colors', 'items.code', '=', 'colors.code')
                ->join('sizes', 'colors.id', '=', 'sizes.id_color')
                ->select('items.code', 'items.itemDescription','items.price' , 'items.modelNo' )
                ->where('active' ,'=' , '0')      
                ->whereBetween('items.price', array($min, $max))
                ->where('colors.color', '=' , $color)
                 ->where('sizes.size' , '=' , $size)
                ->get();
                return view ('frontend.pages.products')->withitems($items)->withemptyErrors($emptyErrors);
                }catch(\Exception $ex){
                    Session::flash('msg' , "حدث خطا اثناء البحث");
                    return Redirect::to('products/');
                }//catch
#----------------------------------------------------errors==0
  
         }//if erroes
#------------------------------------------tempErrors>0
    
    }//if get
}//sizeColor fn 
    // products page----------------------------------------------------------------------------------End
    // ==================================================== ProductDetails Page=====================================
    public function productDetails($code){
        if(!$code || Item::where('code' , $code)->count()==0){
            return \App::abort(404);
        }
        $item=DB::table('items')->where('code',$code)->first();
        return view('frontend.products.productDetails')->withitem($item);
    }

#start ajax ===============================================================================================
public function getsize($color)

{
        $sizes=array();
   
        $data=DB::table('sizes')
        ->where('id_color' , $color)        
        ->select('sizes.size')
        ->get();

        foreach($data as $key =>$size){
            $sizes[]=$size;
        }

    return \Response::json(['data'=> $sizes]); 

}


#End select ajax  =====================================================================================================


    #===================================================  DID NOT Paginate   ====================================
    public function latestPage(){
        
        $items=DB::table('items')->where('active' , 0)->orderBy('code', 'DESC')->paginate(8);
            // $items=array();

        return  view('frontend.products.latestPage')->withitems($items);
    }//
    // ========================================================================= MostSoldPage  =====================
    public function mostSold(){
        $items=DB::table('carts')
                        ->select('code' ,   DB::raw(' SUM(quantity) as totalQty ') )
                        ->where('IsOrdered' ,'=' ,1)
                        ->groupBy('code')
                        ->orderBy('totalQty' , 'DESC')
                        ->paginate(4);
        //    $items=array()        ;
    return view('frontend.products.mostSold')->withitems($items);

    }
// ======================================== show in index (Home page) ===================================================
  static public function mostSoldToIndex(){
        $items=DB::table('carts')
                        ->select('code' ,   DB::raw(' SUM(quantity) as totalQty ') )
                        ->where('IsOrdered' ,'=' ,1)
                        ->groupBy('code')
                        ->orderBy('totalQty' , 'DESC')
                        ->limit(4)
                        ->get();
        return $items;

    }
    
//============================================================= Search page==========================================================
public static function search(){
    if(isset($_GET['search'])){
        $emptyErrors=array();
            if(empty($_GET['search']) ){ $emptyErrors[] ="يجب كتابة  كلمة للبحث عنها   " ;}

            if (count ($emptyErrors) > 0 ){
                $items=array();
                return view ('frontend.products.search')->withitems($items)->withemptyErrors($emptyErrors);
            }
    if (count ($emptyErrors) ==0 ){
           
        try{
            $search=$_GET['search'];
            $items=  DB::table('categories')
         ->join('imodels','categories.categoryNo','=','imodels.categoryNo')          
         ->join('items','Imodels.modelNo', '=', 'items.modelNo')
         ->where('categories.active' , '=' , 0)                 
         ->where('imodels.active' , '=' , 0) 
         ->where('items.active' , '=' , 0)  

        ->where(function($query) use($search){
            $query->where('items.itemDescription' ,'LIKE' ,'%'.$search.'%')
            ->orwhere('imodels.modelName' ,'LIKE' , '%'.$search.'%')
            ->orwhere('categories.categoryName' ,'LIKE' , '%'.$search.'%');
        })

        ->select('items.code', 'items.itemDescription','items.price' , 'items.modelNo' )
        ->paginate(8);

        

            return view('frontend.products.search')->withitems($items)->withsearch($search)->withemptyErrors($emptyErrors);

        }catch(Exception $ex){
            return view('frontend.products.search');
            Session::flash('error' , "wrong");
        }//catch
    }//if errors==0
}//if  get is set 
}//fn
#========================================================================================================
public function mostRated(){
    $items=DB::table('feedbacks')
                        ->select('code' ,   DB::raw(' avg(points) as average ') )
                        ->where('points' ,'!=' , 0)
                        ->groupBy('code')
                        ->orderBy('average' , 'DESC')                      
                        ->paginate(4);

    // $items=array();
       return view('frontend.products.mostRated')->withitems($items);

}
#=========================================================================== Discount Page 
//   show discount for currently discounts only 
    public  function discount(){
        $date=date('Y-m-d');
                
        $data=Sale::where('startDate' , '<=',$date)
            ->where('endDate' , '>=',$date)
            ->orderBy('percentageValue' , 'DESC')        
            ->paginate(1);
        return view('frontend.products.discount')->withdata($data);

    }
}//ctrl
