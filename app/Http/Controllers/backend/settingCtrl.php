<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use Session ;
use Redirect;
use DB;

class settingCtrl extends Controller
{
    


    public function URL(){


        return view ('backend.settings.listSetting');
    }
// =================================================
    public function connect(){

        return view ('backend.settings.connect');
    }
    // =============================================================================

    public function saleName(){

        return view ('backend.settings.saleName');
    }
    // =======================================================
    // ============================================================================
    public function updateURL(Request $request){
        $request->validate([
            'facebookURL'=>'required|url',
            'twitterURL'=>'required|url',
            'googlePlusURL'=>'required|url',
            'youTubeURL'=>'required|url'        
        ]);
        $facebookURL =$request->input('facebookURL');
        $twitterURL =$request->input('twitterURL');
        $googlePlusURL =$request->input('googlePlusURL');
        $youTubeURL =$request->input('youTubeURL');
        try{
            DB::table('settings')->where('settingName' ,'facebookURL')->update([ 'settingContent'=>$facebookURL]);
            DB::table('settings')->where('settingName' ,'twitterURL')->update([ 'settingContent'=>$twitterURL]);
            DB::table('settings')->where('settingName' ,'googlePlusURL')->update([ 'settingContent'=>$googlePlusURL]);
            DB::table('settings')->where('settingName' ,'youTubeURL')->update([ 'settingContent'=>$youTubeURL]);

            Session::flash("success" , "تم  التعديل بنجاح");        

        }catch(\Exception $ex){
            Session::flash("error" , $ex);
        }
     
        return  Redirect::back();


    }
    // =====================================================================
    public function connectUpdate(Request $request){
        $request->validate([
            'sitePhone1'=>'required|regex:/^[0-9]{12}$/',
            'sitePhone2'=>'required|regex:/^[0-9]{12}$/',
            'sitePhone3'=>'required|regex:/^[0-9]{12}$/',         
            'Email'=>'required|email',

            
          
        ]);
        $sitePhone1 =$request->input('sitePhone1');     
        $sitePhone2 =$request->input('sitePhone2');
        $sitePhone3 =$request->input('sitePhone3');
        $Email =$request->input('Email');
        try{
            DB::table('settings')->where('settingName' ,'sitePhone1')->update([ 'settingContent'=>$sitePhone1]);
            DB::table('settings')->where('settingName' ,'sitePhone2')->update([ 'settingContent'=>$sitePhone2]);
            DB::table('settings')->where('settingName' ,'sitePhone3')->update([ 'settingContent'=>$sitePhone3]);
            DB::table('settings')->where('settingName' ,'Email')->update([ 'settingContent'=>$Email]);

            Session::flash("success" , "تم  التعديل بنجاح");        

        }catch(\Exception $ex){
            Session::flash("error" , $ex);
        }
     
        return  Redirect::back();


    }
// =========================================================================
    public function saleNameUpdate(Request $request){
        $id=$request->input('saleName'); // value from select
        
        $sale=DB::table('names')->where('nameId' , $id)->first();
        $saleName=$sale->nameSale;
   

                try{
                    DB::table('settings')->where('settingName' ,'saleName')->update([ 'settingContent'=>$saleName ]);

                    Session::flash("success" , "تم  التعديل بنجاح");
                }catch(\Exception $ex){
                    Session::flash("error" , $ex);
                }

        return  Redirect::back();


    }
// ==========================================================

}
