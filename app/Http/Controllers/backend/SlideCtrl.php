<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Slider;
use App\Itemimage;
use Session;
use Exception;
use Redirect;
use DB;
use Image;
use File;

class SlideCtrl extends Controller
{

    public function index()

    {
        if(isset($_GET['q'])){
            $q=$_GET['q'];
            $slider=DB::table('sliders')
                    ->where(function($query) use($q){
                    $query->where('title1' , 'LIKE' , '%'.$q.'%')
                    ->orwhere('title2' , 'LIKE' , '%'.$q.'%')
                    ->orwhere('content' , 'LIKE' , '%'.$q.'%');
                     })
                    
                    ->get();
                             
        }else{
        $slider=Slider::orderBy('sort' , 'DESC')->get(); 
        // $slider=array()       ;
        }
        return view('backend.slides.list')->withslider($slider);
    }

#End Index-------------------------------------------------------#

#--------------------------------------------------------------------------#
    public function create()
    {
        return view('backend.slides.create');
    
    }
#End create-------------------------------------------------------#

public function itemCode(Request $request){

    $itemCode=$request->Code;

    $src=Itemimage::getImagesForItem($itemCode)[0] ;
    // dd($src);
//    $imageSource= App\Itemimage::getImagesForItem($itemCode) [0];
   return \Response::json(['data'=>$src]);

}



#--------------------------------------------------------------------------#

    public function store(Request $request)
    {
        $request->validate(['title1' =>'regex:/^[.,ءa-zA-Zأ-ي\s]*$/u|required|min:6|max:15',
                            'title2' =>'regex:/^[.,ءa-zA-Zأ-ي\s]*$/u|required|min:10|max:50',
                            'content' =>'regex:/^[.,ءa-zA-Zأ-ي\s]*$/u|required|min:10|max:100',
                             'sort'=>'integer|min:0|max:10',                      
                             'itemCode' =>'required'
        ]);

  
            // Image::make($file)->resize(254, 375)->save(public_path().'/'.$path.$fileName , 90);


            #--------------------
try{
            #set value of sort
            $slider=new Slider;
           $slider->itemCode =$request->input('itemCode');
           $slider->title1=$request->input('title1');
           $slider->title2=$request->input('title2');
           $slider->content=$request->input('content');
           if($request->input('active')){
               $slider->active=$request->input('active');
           }
           $slider->sort=$request->input('sort');
           $slider->save();
        
           Session::flash('success' , "تمت الإضافة بنجاح");
           return Redirect::to('dashboard/slides');


    
        
        }catch(Exception $ex){
            // Session::flash('error' , $ex."حدث خطأ أثناء الإضافة");
            throw($ex);
        }
        return Redirect::to('dashboard/slides');

  
 

    }//store
#End Store-------------------------------------------------------#
#--------------------------------------------------------------------------#

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        if(!$id || Slider::where('sliderNo',$id)->count() == 0) {
    		return \App::abort(404);
    	}
        $slider=Slider::where('sliderNo' , $id)->first();
        return view('backend.slides.edit')->withslider($slider);
    }//edit

#End Edit-------------------------------------------------------#
#--------------------------------------------------------------------------#

    public function update($id ,Request $request )
    {
       if(!$id||Slider::where('sliderNo' , $id)->count()==0){
                  return \App::abort(404);
       }
       $request->validate(['title1' =>'regex:/^[.,ءa-zA-Zأ-ي\s]*$/u|required|min:6|max:15',
       'title2' =>'regex:/^[.,ءa-zA-Zأ-ي\s]*$/u|required|min:10|max:50',
       'content' =>'regex:/^[.,ءa-zA-Zأ-ي\s]*$/u|required|min:10|max:100',
        'sort'=>'integer|min:0|max:10',
        'itemCode' =>'required'
        ]);
        try{  
        DB::table('sliders')
        ->where('sliderNo' , $id)
        ->update([
            'title1' => $request->input('title1'),
            'title2' => $request->input('title2'),
            'content' => $request->input('content'),
            'sort' => $request->input('sort'),
            'active' => $request->input('active'),
            'itemCode' => $request->input('itemCode')
                ]);
#---------------- -------------------------------add image if selected             
  

#-------------------------------------------------- add image if selected
           
                Session::flash('success' , "تم التعديل بنجاح   ");
                return Redirect::to('dashboard/slides');
                     
                }catch(Exception $ex){
                Session::flash('error' ,$ex."حدث خطأ أثناء التعديل" );  
                return Redirect::to('dashboard/slides');
                }
   


    }//update

  #end Update-------------------------------------------------------#
  #---------------------------------------------------------------------#

    public function destroy($id)
    {
        if(!$id || Slider::where('sliderNo',$id)->count() == 0) {
    		return \App::abort(404);
    	}
        try{
       
                // $slider= DB::table('sliders')->where('sliderNo' , $id)->first();
                //delete file from public folder
                // File::Delete( $slider->sliderImage);

                //delete row from database
                
                Slider::where('sliderNo' , $id)->delete();
                Session::flash('success' ,"تم الحذف بنجاح");

            }catch(Exception  $ex){
                Session::flash('error' ,$ex."حدث خطأ أثناء الحذف");
            }
     
    return Redirect::back();
    }//destroy
#End Edit Destroy-------------------------------------------------------#
#--------------------------------------------------------------------------#
}//ctrl



