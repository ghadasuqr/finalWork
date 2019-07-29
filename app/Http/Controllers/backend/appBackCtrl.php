<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Auth;
use App\Order;
use App\Cart;
use App\Shippinginfo;
use App\User;
use App\Itemimage;
use DB;
use Session;
use App\Feedback;
use App\Item;
use App\Sale;

class appBackCtrl extends Controller
{
     public function logoutBack(){
            Auth::logout();
            return Redirect::to('login');
        }


     public function adminIndex(){
        $items=DB::table('items')->where('active' , 0)->orderBy('code', 'DESC')->limit(4)->get();

        return view('backend.layouts.index')->withitems($items);

    }
#============================ users in admin sidebar================================ 
public function getUsersAdmin(){
    // $users=DB::table('users')->get();

    if(isset($_GET['q'])){
        $q=$_GET['q'];
        // $data=DB::table('imodels')->where('modelName' , 'LIKE ' ,'%'.$q.'%')->get();
        $users=User::where('blocked' , 0)
        ->where(function($query) use($q){
        $query->where('name' , 'LIKE' ,'%'.$q.'%')
        ->orwhere('mail', 'LIKE' ,'%'.$q.'%')  
        ->orwhere('id', '=' ,$q)  ;
        })                  
        ->paginate(5);

    }else{
        $users=User::where('blocked' , 0)->paginate(7);
    }
   

    // $users=array();

    return view('backend.pages.activeUsers')->withusers($users);


}

#============================================================================
public function blockedUsersAdmin(){
    if(isset($_GET['q'])){
        $q=$_GET['q'];
        // $data=DB::table('imodels')->where('modelName' , 'LIKE ' ,'%'.$q.'%')->get();
        $users=User::where('blocked' , 1)
                    ->where(function($query) use($q){
                    $query->where('name' , 'LIKE' ,'%'.$q.'%')
                    ->orwhere('mail', 'LIKE' ,'%'.$q.'%')  
                    ->orwhere('id', '=' ,$q)  ;
                    })                  
                    ->paginate(5);
                    
           

    }else{
    //    $users=array();
        $users=User::where('blocked' , 1)->paginate(5);
    }
   


    return view('backend.pages.blockedUsers')->withusers($users);
}
#=========================================================================================
public function blockUser($id)
{ 

    if(!$id||DB::table('users')->where('id' , $id)->count()==0){
        return \App::abort(404);
    }
    try{
    User::where('id' ,'=', $id)->update(['blocked' => 1]);
    Session::flash("success" , "تم  حجب بنجاح");        

        }catch(\Exception $ex ){
            Session::flash("error" , $ex);
        }
        return  Redirect::to('dashboard/blockedUsers');


}//destroy
// =======================================================
public function activateUser($id)
{ 

    if(!$id||DB::table('users')->where('id' , $id)->count()==0){
        return \App::abort(404);
    }
    try{
    User::where('id' ,'=', $id)->update(['blocked' => 0]);
    Session::flash("success" , "تم  الاعادة  بنجاح");        

        }catch(\Exception $ex ){
            Session::flash("error" , $ex);
        }
        return  Redirect::to('dashboard/getUsers');


}//destroy
// ===============================================
public function updateRole(Request  $request, $id)
{ 
    $role=$request->input('role');

    if(!$id||DB::table('users')->where('id' , $id)->count()==0){
        return \App::abort(404);
    }
    try{
    User::where('id' ,'=', $id)->update(['Role' => $role]);
    Session::flash("success" , "تم  التعديل بنجاح");        

        }catch(\Exception $ex ){
            Session::flash("error" , $ex);
        }
        return  Redirect::to('dashboard/blockedUsers');


}//destroy
// ===========================================================Comments============================
public function getComments(){
    // $users=DB::table('users')->get();

    if(isset($_GET['q'])){
        $q=$_GET['q'];
        // $data=DB::table('imodels')->where('modelName' , 'LIKE ' ,'%'.$q.'%')->get();
        $comments=Feedback::where('comment' , 'LIKE' ,'%'.$q.'%')
                      ->paginate(7);

    }else{
        $comments=Feedback::where('comment' , '!=' ,"")->paginate(7);
    }
   

// $comments=array();
    return view('backend.pages.comments')->withcomments($comments);


}
#delete Comment-------------------------------------
public function deleteComment($id){
    try{

    
    $comments=Feedback::where('feedbackId' , $id)->update([ 'comment' => '']);
    Session::flash("success" , "تم   الحذف بنجاح");        

    }catch(Exception $ex){
        Session::flash("error" , " حدث خطأ اثناء الحذف");

    }
    return  Redirect::to('dashboard/comments');

}
#================================================================ End Comments====================================

// ================================================= Admin page ========================================= End most Rated section an admin page
static public function mostSoldToAdmin(){
    $items=DB::table('carts')
                    ->select('code' ,  DB::raw(' SUM(quantity) as totalQty ') )
                    ->where('IsOrdered' ,'=' ,1)
                    ->groupBy('code')
                    ->orderBy('totalQty' , 'DESC')
                    ->limit(3)
                    ->get();
    return $items;

}
#=================================================

public function latest(){
    if(isset($_GET['q'])){
        $q=$_GET['q'];
        $items=DB::table('items')
     
        ->join('imodels','imodels.modelNo', '=', 'items.modelNo')
           ->where('items.active' , 0)
        ->where(function($query) use($q){
            $query->where('items.itemDescription' ,'LIKE' ,'%'.$q.'%')
            ->orwhere('code' ,'=' , $q)
            ->orwhere('itemDescription' ,'LIKE' ,'%'.$q.'%')
            ->orwhere('imodels.modelName' ,'LIKE' , '%'.$q.'%')
            ->orwhere('materialType1' ,'LIKE' , '%'.$q.'%')
            ->orwhere('materialType2' ,'LIKE' , '%'.$q.'%');
          
        })
        ->select('items.code', 'items.itemDescription','items.price' , 'items.modelNo'  , 'items.quantity' ,'items.materialType1')

        ->orderBy('code', 'DESC')->paginate(8);
    }else{
        $items=DB::table('items')->where('active' , 0)->orderBy('code', 'DESC')->paginate(8);
      
    }
        
        // $items=array();

    return  view('backend.pages.latest')->withitems($items);
}//

#=============================================================================================
public function mostSoldAdmSale(){
    if(  isset($_GET['q'])  ){
        $q=$_GET['q'];
     
                if(!empty($q) ){                      
                    $Data = Sale::select("sales.*")

                    ->whereRaw('? between startDate and endDate', [$q])
        
                    ->get();
                }
    }else
    
    $Data=Sale::orderBy('startDate', 'desc')->get();
    return view('backend.layouts.mostSoldInSale')->withData($Data);
}
// ====================================================================================== End Most Sold section in index admin 
 static public function mostRatedToAdmin(){
   
    $items=DB::table('feedbacks')
                        ->select('code' ,   DB::raw(' avg(points) as average ') )
                        ->where('points' ,'!=' , 0)
                        ->groupBy('code')
                        ->orderBy('average' , 'DESC')                      
                        ->limit(3)
                        ->get();
    return $items;

}
// =========================================================================================== End Most Rated

 public function mostSoldAdminPage(){
     try{

     
    $data=DB::table('carts')
    ->select('code' ,  DB::raw(' SUM(quantity) as totalQty ') )
    ->where('IsOrdered' ,'=' ,1)
    ->groupBy('code')
    ->orderBy('totalQty' , 'DESC')
    // ->skip(3)
    ->paginate(4);
    

            return  view('backend.pages.mostSoldAdminPage')->withdata($data);
     }catch(\Exception $ex){
         throw $ex;
     }

 }
//  ========================================================================================

public function mostRatedAdminPage(){


    $data=DB::table('feedbacks')
    ->select('code' ,   DB::raw(' avg(points) as average ') )
    ->where('points' ,'!=' , 0)
    ->groupBy('code')
    ->orderBy('average' , 'DESC')                      
    ->paginate(3);
return view('backend.pages.mostRatedAdminPage')->withdata($data);
}
// =====================================================================================================
}//ctrl
