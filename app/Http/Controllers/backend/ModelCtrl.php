<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imodel;
use Session;
use App\category;
use DB;
use Redirect;

class ModelCtrl extends Controller
{

    public function index()

    {
        if(isset($_GET['q'])){
            $q=$_GET['q'];
            // $data=Imodel::where('modelName' , 'LIKE' ,'%'.$q.'%')->get();



            $data=DB::table('imodels')
            ->join('categories','categories.categoryNo', '=', 'imodels.categoryNo')
   
             ->where(function($query) use($q){
             $query->where('imodels.modelName' , 'LIKE' ,'%'.$q.'%')
             ->orwhere('categories.categoryName' , 'LIKE' ,'%'.$q.'%');
    
           
         })->get();

        }else{
            $data=Imodel::orderBy('active')->get();
        }
    //    $data=array();
    return view('backend.model.list')->withdata($data);
    }
#End Index-------------------------------------------------------#
#--------------------------------------------------------------------------#
    public function create()
    {
        return view('backend.model.create');
    }

#End Create-----------------------------------------------------##
    public function store(Request $request)
    {
        
        $request->validate(['modelName'=>'required|string|min:2|max:20|regex:/^[ءa-zA-Zأ-ي\s]*$/u',                            
        'category' =>'required']);                                     


        $categoryNo=$request->input('category');
        $modelName=$request->input('modelName');
   
        if(Imodel::where('modelName' , $modelName)->where('categoryNo'  , $categoryNo)->count()>0){
                        #check if this model is exixts for this category before

          Session::flash('foundForCat' , "هذا الموديل موجود لهذه المجموعة مسبقا");
            return Redirect::back()->withInput();
          }else{


        #-- works fine after change default date to current timestamp
        try{
            DB::table('imodels')->insert([

                'categoryNo' => $request->input('category'),
                'modelName' => $request->input('modelName')
                ]); 

                Session::flash("success" , "تمت  الاضافة بنجاح");        

                }catch(\Exception $ex ){
                    Session::flash("error" , " حدث خطأ اثناء الاضافة ");
                }

            return  Redirect::to('dashboard/models');

        }//else name


    
    }//store

#End Store-------------------------------------------------------#
#--------------------------------------------------------------------------#

        
    public function show($modelNo)
    { 

        if(!$modelNo||DB::table('imodels')->where('modelNo' , $modelNo)->count()==0){
            return \App::abort(404);
        }
        try{
        Imodel::where('modelNo' ,'=', $modelNo)->update(['active' => 0]);
        Session::flash("success" , "تم  الاعادة بنجاح");        

            }catch(\Exception $ex ){
                Session::flash("error" , "لم يتم الاعادة");
            }
            return  Redirect::to('dashboard/models');


    }//show
 


    public function edit($modelNo)
    {
        if(!$modelNo || Imodel::where('modelNo',$modelNo)->count() == 0) {
    		return \App::abort(404);
        }
        #----------------------------------------------------------------

        $model = DB::table('imodels')->where('modelNo', $modelNo)->first();
        return view ('backend.model.edit')->withmodel($model);
    }
#End Edit-------------------------------------------------------#
#--------------------------------------------------------------------------#

    public function update(Request $request, $modelNo)
    {
        if(!$modelNo || Imodel::where('modelNo',$modelNo)->count() == 0) {
    		return \App::abort(404);
        }
        #--------------------------------------------------------------
                
        $request->validate(['modelName'=>'required|string|min:2|max:20',                            
        'category' =>'required']);

        
        $modelName=$request->input('modelName');
        $categoryNo=$request->input('category');

        #gurantee  that name is string
        if (!preg_match("/^[a-zA-Zأ-ي\s]*$/u",$modelName)) { // if name
            Session::flash('errorName' , "اسم الموديل ينبغى ان يكون احرف فقط");
            return Redirect::back();

        }else {
                
            try{
        
            DB::table('imodels')
            ->where('modelNo', $modelNo)
            ->update(
                ['modelName' =>$request->input('modelName') ,
                 'categoryNo' =>$request->input('category')
                ]
                    );

            Session::flash("success" , "تم  التعديل بنجاح");        

            }catch(\Exception $ex ){
                Session::flash("error" , $ex);
            }

             return  Redirect::to('dashboard/models');

        }//else

    }

  #end Update-------------------------------------------------------#
  #---------------------------------------------------------------------#


    public function destroy($modelNo)
    { 

        if(!$modelNo||DB::table('imodels')->where('modelNo' , $modelNo)->count()==0){
            return \App::abort(404);
        }
        try{
        Imodel::where('modelNo' ,'=', $modelNo)->update(['active' => 1]);
        Session::flash("success" , "تم  الاخفاء بنجاح");        

            }catch(\Exception $ex ){
                Session::flash("error" , $ex);
            }
            return  Redirect::to('dashboard/models');


    }//destroy
}
