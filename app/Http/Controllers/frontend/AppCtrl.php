<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Session;
use Redirect;
use DB;
use Auth;
use Hash;
use App\Favorite;
use App\Cart;
use App\Fq;
use App\Feedback;

class AppCtrl extends Controller
{
    public function index(){
        return view('frontend.layout.index');
    }
    #test------------------------------

    public function test(){
        return view('backend.category.test');
    }
#fq page----------------------------------------------
 public function showFq(){
     $fqs=Fq::get();
     return view('frontend.pages.fq')->withfqs($fqs);

 }
#------------------------- start  Register -----------------
    public function register(){
        return view('frontend.pages.register');
    }
#--------------------------------------------------------

   public function doRegister(Request $request){

#-Start validation 
                $emptErrors=array();
                $name=$request->input('name');
                $mail=$request->input('mail');
                $password=$request->input('password');
                $confirmpassword=$request->input('confirmpassword');
#check  inputs  if empty --------------------
                if(!$name){$emptErrors[]="يجب كتابة الاسم";}
                if(!$mail){$emptErrors[]="يجب كتابة البريد الالكترونى";}
                if(!$password){$emptErrors[]="يجب كتابة كلمة السر";}
                if(!$confirmpassword){$emptErrors[]="يجب تاكيد كلمة السر";}
# password and confirm  password  ------------------------mb_srlen to avoid  error with arabic letters
            if($request->input('password') !== $request->input('confirmpassword')){
                $emptErrors[]=" لا يوجد تطابق بيك كلمتى المرور ";}
                if(mb_strlen($password)<6){ $emptErrors[]="  لا ينبغى ان تقل كلمة السر  عن  ستة حروف   ";}

# Email  validation  --------------------
                $row=DB::table('users')->where('mail' , $mail)->first();
                if(!empty($row->mail)){$emptErrors[]="هذا الميل موجود مسبقا" ;}
                
                if(!empty($mail)){
                    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                        $emptErrors[]="هذا البريد غير صالح ";
                      }
                }
               
#name validation ---------------------------------
             
                     if (!preg_match("/^[0-9ء,.a-zA-Zأ-ي\s]*$/u",$name)) {

                    $emptErrors[]="  يسمح فقط بالحروف والمسافات فى الاسم  ";
                  }
                  if(mb_strlen($name)> 10 ||mb_strlen($name)< 2)
                  { $emptErrors[]="  لا ينبغى ان يقل الاسم عن حرفين او يزيد عن عشرة حروف   ";}
          

# collect all errors
if (count($emptErrors) > 0){
    Session::put('emptErrors', $emptErrors);
    return Redirect::back()->withInput();
}
                
#-End validtaion --------
                if (count($emptErrors) == 0){
                    try{
                        $user=new User();
                        $user->mail=$request->input('mail');
                        if(!empty($request->input('gender'))){ $user->gender=$request->input('gender');}  //if gender not checked put defaults in DB                                              
                   

                        $user->name=$request->input('name');
                            $user->password = Hash::make($request->input('password'));
                            $user->code = mt_rand(0 ,10000);
                            $user->save();
                            Session::flash('success' ," تم التسجيل بنجاح يرجى تسجيل الدخول لبدء استخدام الموقع ");
                    }catch(\Exeption $ex){
                            Session::flash('error' ," حدث خطا فى التسجيل");
                    }//catch

                    return Redirect::back()->withInput();

                }//if
}//register
#------------------------- End  register  -----------------
#------------------------- start  login -----------------
    public function login(){
          
         return view('frontend.pages.login');


    }//fn
#==================================== show message to blocked users 
public function blocked(){
        $blocked=true;
    return view('frontend.pages.blocked')->withblocked($blocked);


}//fn
#--------------------------------------------------------=================================
#=========================================================================================

    public function doLogin(Request $request){

        $request->validate([
            'mail' => 'required|email',
            'password' => 'required|min:6'
        ]);
         $mail = $request->input('mail');
        $password = $request->input('password');
        $data = ['mail'=>$mail,'password' =>$password];
    //  Redirect to home or admin panel or shipper panel 

                if(Auth::attempt($data , true)) {
                    //return Redirect::to('/');
    
                            if(Auth::User()->Role == 0  ){


                                return Redirect::to('/');

                            }elseif(Auth::User()->Role == 1 ){

                                return Redirect::to('dashboard/');

                            }elseif(Auth::User()->Role == 2 ){
                        

                                return Redirect::to('dashboard/shipper'); 
                            
                                 }
                } else{
                    Session::flash("error","كلمة السر او البريد الالكترونى خطأ");
                    return Redirect::back()->withInput();

                
                }//if auth
    }//doLogin
    
#------------------------- End  login -----------------
#=============================================================================================

#-------------------------  Start log out -----------------

       public function logout() {
        Auth::logout();
        return Redirect::to('/login');
    }
    public function exit() {
        try{
            User::where('id' , Auth::User()->id)->update(['blocked' => 1]);
            Auth::logout();
            Session::flash('success'," تم الغاء هذه الحساب بنجاح ");
            return Redirect::to('/login');

        }catch(Excption $ex){
            Session::flash('error',"  خطأ");
            return Redirect::to('/login');
        }

    }//fn
    // =====================================================================

#-------------------------End  log out  -----------------


#------------------------- start  forgrtPassword -----------------

    public function forgetPassword(){
        return view('frontend.pages.forgetPassword');
    }

#--------------------------------------------------------

    public function doForgetPassword(Request $request){
            
        $request->validate([
            'mail' => 'required|email'
        ]);

          try{
                $mail=$request->input('mail');
                    if(User::where('mail' , $mail)->count()==0){
                
                        Session::flash('error' ,'هذا البريد ليس مسجل لدينا  هل تريد تسجيل حساب جديد');
                        return Redirect::to ('register');

                     } else{
                            $row=User::where('mail' , $mail)->first();
                            $row->code=$row->id.''.uniqid(md5($mail));
                            $row->save();
                            Session::flash('success' , "يرجى الضغط على الرابط لتغيير كلمة المرور");
                            Session::flash('key' ,$row->code);
                            return view ('link');
                    }//else
            }catch(\Exception $ex){
                Session::flash('error' ,"حدث خطأ أثناء الإرسال ");
                return view ('frontend.pages.link');

            }//catch
    }//fn

#------------------------- End  forgetPassword -----------------  
public function link(){
    return view ('frontend.pages.link');
}
#------------------------- start  changePassword -----------------

public function changePassword($key){
    if(User::where('code' , $key)->count() == 0){

        Session::flash('cherror' , "كود التحقق منتهى الصلاحية ");  
        return view('frontend.pages.changePassword');   
    }else{
         return view('frontend.pages.changePassword');   
    }

}
#--------------------------------------------------------
public function doChangePassword($key , Request  $request ){
    $request->validate([
       
        'password' => 'required|min:6'
    ]);
    if(User::where('code' , $key)->count() == 0){

        Session::flash('cherror' , "كود التحقق منتهى الصلاحية ");  
        return view('frontend.pages.changePassword');   
    } else if ($request->input('password')!= $request->input('confirmpassword')){
        Session::flash('cherror' , "لا يوجد تطابق بين كلمتى السر  ");  
        return view('frontend.pages.changePassword');   
    }else{
        $row=User::where('code' , $key)->first();
        $row->password=  Hash::make($request->input('password'));
        $row->code=NULL;
        $row->save();
        Session::flash('success', 'تم تغيير كلمة السر بنجاح ');
        return Redirect::to('login');

    }
}
#------------------------- End   changePassword -----------------
#========================================= End login System =========================================================================


##====================================== Start Wish list====================================================##
#WishList----------------------------
public function wishList(){
  
if(!Auth::check() || !Auth::User()->Role == 0 )     
    {   return Redirect::to('login');    }
$data=DB::table('favorites')->where('userId' , Auth::User()->id)->get();

        return view('frontend.orders.wishList', compact('data'));
    
}
#addToWishList -------------------------
public function addToWishList(Request $request){
    if(!Auth::check()){   return Redirect::to('login');    }

            try{
                $row= new Favorite;
                $row->code=$request->code;
                $row->modelNo=$request->modelNo;
                $row->userId=Auth::User()->id;
                $row->save();
                $status=true;
            }catch(\Exception $ex){
                $status=false;

            }
        return response()->json(['success'=>$status]);

    
}//addToWishlist
#addToWishList ----------------------

#destroy-----------------------------
public function destroy($id){
    try{
        if(Favorite::where('code',$id)->where('userId',Auth::user()->id)->count()) {
            Favorite::where('code',$id)->where('userId',Auth::user()->id)->delete();}
            Session::flash('success','  تم الحذف بنجاح'); 
     
 
    }catch(Exception  $ex){
        Session::flash('error' ,"حدث خطأ أثناء الحذف");
    }
 
    return Redirect::back();
}
#destroy-----------------------------

#  =======================================================  End WishList  ==============================================

#  =======================================================  Start  Comments  ==============================================
public function addComment(Request $request){

    if(!empty($request->comment)){

        try{
            $feedback=new Feedback;
            
            $feedback->comment=$request->comment;
            $feedback->code=$request->code;
            $feedback->memberId=Auth::User()->id;
            $feedback->save();
            $status=true;
            }catch(Exception $ex){
                $status=flase;
            }
    
    
            return response()->json(['success'=>$status]);
    
    }//addComment
    }//if not empty
// 
public function removeComment(Request $request){
$feedbackId=$request->feedbackId;
        try{
            Feedback::where('feedbackId' , $feedbackId)->update(['comment' =>'']);
            $status=true;
        }catch(Exception $ex){
            $status=flase;
        }

return response()->json(['success'=>$status]);

}//remove Comment
#  =======================================================  End Comments  ==============================================

#  =======================================================  star rating  ==============================================


 public function addtofeedback(Request $request){
    if(!Auth::check() || !Auth::User()->Role == 0){   return Redirect::to('login');    }

        try{
                $point=$request->point; 
                $code=$request->code; 
                $userId=Auth::User()->id; 

                 $data=DB::table('feedbacks')->where('code' ,$code)->where('memberId' , $userId)->get();
                    if(count($data)  > 0 ){  //found before
                        DB::table('feedbacks')->updateOrInsert(
                            ['code' => $code , 'memberId' =>$userId ],
                            ['points' => $point]
                        );

                    }else{
                        DB::table('feedbacks')->insert(
                            ['code' => $code ,
                            'memberId' =>$userId ,
                            'points' => $point ,
                            ]);
                    }//else if found before

                // $average=Feedback::where('code' , $code)->avg('points'); 
                
                $items=DB::table('feedbacks')
                ->select('code' ,   DB::raw(' avg(points) as average ') )
                ->where('code' ,'=' ,$code)
                ->where('points' , '!=' , 0)
                ->groupBy('code')
                ->first();
                $average=$items->average; 

             
                    $average=$average * 20 .'%';             
   
              
                $status=true;
                }catch(Exception $ex){
                    // throw $ex;                    
                    $status=flase;
                }//catch
    
         return response()->json(['success'=>$status , 'average' =>$average]);
    

 }//stars
#  =======================================================  star rating  ==============================================
// ======================================= return back if Not Authinticated ============================================

static public  function returnBack(){
    if(      !Auth::check()  || !Auth::User()->Role == 1   ) 

    return Redirect::to('/');  
   }
// =====================================================================================================
}//ctrl