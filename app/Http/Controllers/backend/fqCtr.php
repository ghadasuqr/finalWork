<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Fq;
use Session;

use Redirect;
class fqCtr extends Controller
{
    public function index()
    { 
    #  search first  ----------------------------------

        if(isset($_GET['q'])){
            $q=$_GET['q'];
            $data=Fq::where('question' , 'LIKE','%'.$q.'%')
                    ->orwhere('answer','LIKE','%'.$q.'%')
                    ->get();
        }else{
            $data=Fq::get();
        } 
        // $data=array()       ;
    return view('backend.fq.fqList' , compact('data'));
    }
    # End index ----------------------------------

    public function create()
    {
        return view('backend.fq.fqCreate');
    }

    #End Create------------------------------------
    public function store(Request $request)
    {
        # validation ----------------------------------

        $request->validate([
            'question' => 'required|regex:/^[0-9ء,.a-zA-Zأ-ي\s]*$/u|min:5|max:140',
            'answer'   => 'required|regex:/^[0-9,ء.a-zA-Zأ-ي\s]*$/u|min:2|max:500'
        ]);
        # add  ----------------------------------

        try{

        $fq=new Fq;
        $fq->question=$request->input('question');
        $fq->answer=$request->input('answer');
        $fq->save();
        Session::flash('success' , 'تمت الاضافة بنجاح');
         }catch(Exception $ex){
            Session::flash('error','حدث خطأ اثناء الاضافة');
         }
         return Redirect::to('dashboard/fq');
    }
    # End store ----------------------------------

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if(!$id||Fq::where('id' , $id)->count()== 0){
            return \App::abort(404);
       }
     #-------------------------------------------------  

        $fq=Fq::where('id' , $id)->first();
        return view('backend.fq.fqEdit' , compact('fq')) ; 
    }
    #End Edit------------------------------------------
    public function update(Request $request, $id)
    {
        ##--- if id is not found at all or if id is not in database---##

        if(!$id||Fq::where('id' , $id)->count()== 0){
             return \App::abort(404);
        }
        # validation ----------------------------------
       
        $request->validate([
            'question' => 'required|regex:/^[0-9,.ءa-zA-Zأ-ي\s]*$/u|min:5|max:140',
            'answer'   => 'required|regex:/^[0-9,.ءa-zA-Zأ-ي\s]*$/u|min:2|max:500'
        ]);

        #update----------------------------------------
        try{

        $fq=Fq::where('id' , $id)->first();
        $fq->question=$request->input('question');
        $fq->answer=$request->input('answer');
        $fq->save();
        Session::flash('success' , 'تم التعديل بنجاح');
         }catch(Exception $ex){
            Session::flash('error','حدث خطأ اثناء التعديل');
         }
         return Redirect::to('dashboard/fq');

    }
#END Update---------------------------------------------##
   
    public function destroy($id)
    {  
        if(!$id||Fq::where('id' , $id)->count()== 0){
        return \App::abort(404);  }   
        #----------------------------------
        try{
            Fq::where('id' , $id)->delete();
            Session::flash('success' , 'تم الحذف بنجاح');
        }catch(Exception $ex){
           Session::flash('error','حدث خطأ اثناء الحذف');
        }
        return Redirect::to('dashboard/fq');

    }//destroy
}//ctrl
