<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Item;
use App\Color;
use App\Size;
use App\Imodel;
use DB;
use Session;
use Exception;
use Image;
use Redirect;
use File;

class itemCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index()
    {

        if(isset($_GET['q'])){
            $q=$_GET['q'];
            $items=DB::table('items')
            ->where('active' , 0)
            ->where(function($query) use($q){
                $query->where('items.itemDescription' ,'LIKE' ,'%'.$q.'%')
                ->orwhere('code' ,'=' , $q)           
                ->orwhere('materialType1' ,'LIKE' , '%'.$q.'%')
                ->orwhere('materialType2' ,'LIKE' , '%'.$q.'%');
              
            })
            ->paginate(7);

        }else{
            $items=DB::table('items')->where('active' , 0)->orderBy('created_at' , 'DESC')->paginate(7);
        }        
        // $items=array();
        return view ('backend.items.itemList')->withitems($items);
    }
#create ======================================================================
    public function create()
    {
        $cats=DB::table('categories')->get();
 
     
       return view('backend/items/create')->withcats($cats);
    }

#start ajax ==========================================================
  
    public function selectedData(Request $request)
    {
        $val = $request->val;
        $data = Imodel::where('categoryNo',$val)->get();
        $arr = array();
        foreach ($data as $val) {
            $arr[] = ['modelNo'=>$val->modelNo, 'modelName'=>$val->modelName];
        }
        return \Response::json(['data'=>$arr]);
    }
#End select ajax  ==========================================================================
# end create =====================================================================
# stor ================================================================================
    public function store(Request $request)
    {
        $request->validate (
            ['itemDescription' =>'regex:/^[ء.,a-zA-Zأ-ي\s]*$/u|required|min:6|max:40',
            'materialType1' =>'regex:/^[ء.,a-zA-Zأ-ي\s]*$/u|required|min:3|max:12',
            'advice' =>'regex:/^[ء.,a-zA-Zأ-ي\s]*$/u|required|min:10|max:100',
            'wash' =>'regex:/^[ء.,a-zA-Zأ-ي\s]*$/u|required|min:4|max:40',
            'materialRatio1'=>'integer|min:0|max:100',
           'quantity'=>'required|integer|min:5',
            'price'=>'required',
         
                    
            ]
            );
       
       
        if(  ($request->input('materialRatio1') + $request->input('material2')  )>100){
            Session::flash('ratio' , "لا يجب ان يزيد مجموع نسبة النوع الاول ونسبة النوع الثانى عن 100");
            return Redirect::back()->withInput();
        }
        if(!$request->hasFile('file_image')){

            Session::flash('image' , " يجب اختيار صورة ");

            return Redirect::back()->withInput();
        }
        if(count($request->file('file_image'))<2 || count($request->file('file_image'))>4){
            Session::flash('imageCount' , "  عدد الصور يجب ان يكون من اثنين الى اربعة ");
            return Redirect::back()->withInput();
        }
  
        if(!$request->input('models')){
            Session::flash('model' , " يجب اختيار موديل ");
            return Redirect::back()->withInput();
        }

    
        if($request->input('material2') < 0 || $request->input('material2')> 100){
            Session::flash('materialRatio2' , " يجب ان لا تقل نسبة النوع الثانى ىعن صفر أو تزيد عن 100 ");
            return Redirect::back()->withInput();
        }
#-------------------------------------------------------------------------------------------------------------------


       if(  ($request->input('materialRatio1') + $request->input('material2')  )>100){
           Session::flash('ratio' , "لا يجب ان يزيد مجموع نسبة النوع الاول ونسبة النوع الثانى عن 100");
           return Redirect::back();
       }
        try {
            DB::beginTransaction();
            $item = new Item;
            $item->modelNo = $request->input('models');
            $item->itemDescription = $request->input('itemDescription');
            $item->quantity = $request->input('quantity');
            $item->price = $request->input('price');
            $item->wash = $request->input('wash');
            if($request->input('slider')){
                $item->slider=$request->input('slider');
            }
            $item->advice = $request->input('advice');
            $item->materialType1 = $request->input('materialType1');
            $item->materialRatio1 = $request->input('materialRatio1');
// -----------------------------------------------------------------------------------
            if($request->input('materialType2')){
                $item->materialType2 = $request->input('materialType2');
            }
            
            if($request->input('material2')){
                $item->materialRatio2 = $request->input('material2');    
            }
//   -------------------------------------------------------------------------- 
        
            $item->save();

            $code = DB::table('items')->max('code');

 #colors ----------------------------------------------
   $colorb=array("أبيض" ,"أسود" , "أحمر"  , "بيج"    ,"أزرق" , "بني" , "أخضر" , "رصاصي");
//    $sizes=array("xxl" ,"xl" , "l"  , "m"  ,"s" ); 
$check=0;
$Rsizes=array();
// $colors=array();
foreach($colorb as $key =>$color){
    $sizee=array();

    if ($request->has('color'.$key) ){
        $check +=1;
        $color=$request->input('color'.$key);
        DB::table('colors')->insert([
                'code' => $code,
                'color' =>$color,
                'count' => $request->input('quantity')
                ]);
        $row = DB::table('colors')->where('code', $code)->where('color' , $color)->first();

                if ($request->has('size'.$key) ){

                    $Rsizes= $request->input('size'.$key);

                        foreach ($Rsizes as $arr_zise ){                
                            DB::table('sizes')->insert([
                            'id_color' => $row->id ,    
                            'size' => $arr_zise ,              
                            'count' => $request->input('quantity')
                            ]); 
                        } //size
                }else{
                    //size
                    Session::flash('error' , " جقل المقاس مطلوب");
                    return Redirect::back()->withInput();
                }

            // dd($Rsizes);

    }//if color


}//foreach

if($check == 0){
    Session::flash('error' , " جقل اللون مطلوب");
    return Redirect::back()->withInput();
}


#End Coloes and its sizes---------------------------------
#Begin Images---------------------------


if($request->hasFile('file_image')){
$files=$request->file('file_image');

$allowedExtensions=['png' , 'jpg' ,'jpeg'];
    foreach($files as  $key => $file){
        $path="uploads/items/";
        $fileName=$file->getClientOriginalName();
        $extension=$file->getClientOriginalExtension();
        $check=in_array($extension , $allowedExtensions);
            if($check){                 //------------if extension allowed
            $fileName=$code.$key.$fileName;
// -------------------------- Resize ---------------- image invention
        Image::make($file)->resize(254, 375)->save(public_path().'/'.$path.$fileName , 90);
// -------------------------- Resize ---------------- image invention
//save in image table -------------------------
          DB::table('itemimages')->insert([
            'code' => $code ,    
            'image_url' => $path.$fileName ,
            'modelNo' => $request->input('models')

          ]);

            }//if  file extension is allowed 

    }//for each file 
}//if  request has files
#End Images-----------------------------

            DB::commit();
             
             Session::flash('success',"تمت الاضافة بنجاح");
            } catch (Exception $e) {
               throw $e;
          }
          return  Redirect::to('dashboard/items');
    }//store
#End store ========================================================================

#start edit=======================================================================
    public function edit($id)
    {
        $item=Item::where('code' , $id)->first();
        
      $cats=DB::table('categories')->get();

        return view('backend.items.edit')->withitem($item)->withcats($cats);
    }

# end  edit=======================================================================
#start updatet=======================================================================
    public function update(Request $request, $code)
    {
   #-------------------------------------------------------------------------- validation
        if(  ($request->input('materialRatio1') + $request->input('material2')  )>100){
            Session::flash('ratio' , "لا يجب ان يزيد مجموع نسبة النوع الاول ونسبة النوع الثانى عن 100");
            return Redirect::back();
        }
        if($request->hasFile('file_image')){
       
            if(count($request->file('file_image'))<2 || count($request->file('file_image'))>4){
                Session::flash('imageCount' , "  عدد الصور يجب ان يكون من اثنين الى اربعة ");
                return Redirect::back();
        }}//count if uploaded
        if(!$request->input('models')){
            Session::flash('image' , " يجب اختيار موديل ");
            return Redirect::back();
        }

        if($request->input('material2') < 0 || $request->input('material2')> 100){
            Session::flash('materialRatio2' , " نسبة النوع الثانى يجب ان لا  تقل عن صفر أو تزيد عن 100  ");
            return Redirect::back();
        }

        $request->validate (
        ['itemDescription' =>'regex:/^[ء.,a-zA-Zأ-ي\s]*$/u|required|min:6|max:60',
        'materialType1' =>'regex:/^[ء.,a-zA-Zأ-ي\s]*$/u|required|min:3|max:12',
        'advice' =>'regex:/^[ء.,a-zA-Zأ-ي\s]*$/u|required|min:10|max:500',
        'wash' =>'regex:/^[ء.,a-zA-Zأ-ي\s]*$/u|required|min:4|max:50',
        'materialRatio1'=>'integer|min:0|max:100',
       'quantity'=>'required|integer|min:5',
        'price'=>'required',
        
        
]
);
        #----------------------------------

        try {

            $item =  Item::where('code' , $code)->first();
            // dd($item);
            $code=$item->code;
            DB::table('items')->where('code' , $code)->update([

                'modelNo' => $request->input('models'),
                'itemDescription' =>$request->input('itemDescription'),
               'quantity' => $request->input('quantity'),
               'price' => $request->input('price'),
               'wash' => $request->input('wash'),
                'advice' => $request->input('advice'),
                'materialType1' => $request->input('materialType1'),
                'materialType2' => $request->input('materialType2'),
              'materialRatio1' => $request->input('materialRatio1'),
                'materialRatio2' => $request->input('material2')               

            ]);

            if($request->input('slider')){
                DB::table('items')->where('code' , $code)->update(['slider'=> $request->input('slider')]);
                }

//  #colors ----------------------------------------------
//         // delete old one 
        // dlete old ones
$check=0;
        DB::table('colors')->where('code' , $code)->delete();

        $colorb=array("أبيض" ,"أسود" , "أحمر"  , "بيج"    ,"أزرق" , "بني" , "أخضر" , "رصاصي");
        //    $sizes=array("xxl" ,"xl" , "l"  , "m"  ,"s" ); 
         
        $Rsizes=array();
        // $colors=array();
        foreach($colorb as $key =>$color){
            $sizee=array();
        
            if ($request->has('color'.$key) ){
                $check +=1;

                $color=$request->input('color'.$key);
                DB::table('colors')->insert([
                        'code' => $code,
                        'color' =>$color,
                        'count' => $request->input('quantity')
                        ]);
                $row = DB::table('colors')->where('code', $code)->where('color' , $color)->first();
        
                        if ($request->has('size'.$key) ){
        
                            $Rsizes= $request->input('size'.$key);
        
                                foreach ($Rsizes as $arr_zise ){                
                                    DB::table('sizes')->insert([
                                    'id_color' => $row->id ,    
                                    'size' => $arr_zise ,              
                                    'count' => $request->input('quantity')
                                    ]); 
                                }//forsize
                        }else{
                            //size
                            Session::flash('error' , " جقل المقاس مطلوب");
                            return Redirect::back()->withInput();
                        }
        
                    // dd($Rsizes);
        
       
          }//if color
            
        
        
        }//foreach


  if($check == 0){
      Session::flash('error' , " جقل اللون مطلوب");
      return Redirect::back()->withInput();
  }

//         $colors=$request->input('color');    
//             if( count ($colors) >0 ){
//                 DB::table('colors')->where('code' , $code)->delete();

//                 foreach( $colors as $selected){
//                            DB::table('colors')->insert([
//                               'code' => $code,
//                               'color' =>$selected,
//                               'count' => $request->input('quantity')
//                               ]);
//                       }//foreach
//                   }//if
                  

//  # Begin sizes--
      
//         $data = DB::table('colors')->where('code', $code)->get();
//         foreach($data as $row){

//                     $sizes=array('xxL' , 'XL' , 'L' , 'M' ,'S');                
            
//                     foreach ($sizes as $arr_zise ){                
//                         DB::table('sizes')->where('id_color' , $row->id)->insert([
//                             'id_color' => $row->id ,  
//                         'size' => $arr_zise ,
                     
//                         'count' => $request->input('quantity')
//                         ]);                 

//                     }//inner foreach for sizes of ecah color

//         }//outer foreach for colors

#End Coloes and its sizes---------------------------------
#Begin Images---------------------------


if($request->hasFile('file_image')){
// delete the old

        $images=DB::table('itemimages')->where('code' , $code)->where('modelNo' ,  $request->input('models'))->get()    ;
        foreach($images as $key =>$image){
            File::Delete($image->image_url); //delete files in public Folder

        DB::table('itemimages')->where('imageId' , $image->imageId)->delete();
        }//foreach 

//delete the old ones


$files=$request->file('file_image');
$allowedExtensions=['png' , 'jpg' ,'jpeg'];
    foreach($files as  $key => $file){
        $path="uploads/items/";
        $fileName=$file->getClientOriginalName();
        $extension=$file->getClientOriginalExtension();
        $check=in_array($extension , $allowedExtensions);
            if($check){
                $fileName=$code.$key.$fileName;
                    Image::make($file)->resize(254, 375)->save(public_path().'/'.$path.$fileName , 90);
                                           //save in image table    
                    DB::table('itemimages')              
                    ->insert([
                        'code' => $code ,    
                        'image_url' => $path.$fileName ,
                        'modelNo' => $request->input('models')
                    ]);
            }//if  file extension is allowed 

    }//for each file 
}//if  request has files
#End Images-----------------------------

             
             Session::flash('success'," تم  التعديل بنجاح");
            } catch (Exception $e) {
               throw $e;
          }
          return  Redirect::to('dashboard/items');
    }

#end  update=======================================================================
    public function destroy($code)
    {
        
// we do not delete items because  it have records in sales and orders tables  , this will make troubles 
        try{

            // $images=DB::table('itemimages')->where('code' , $code)->get()    ;
            //     foreach($images as $key =>$image){
            //         File::Delete($image->image_url); //delete files in public Folder
            Item::where('code' ,'=', $code)->update(['active' => 1]);
            Session::flash("success" , "تم  الاخفاء بنجاح");

              
       
               

            }catch(\Exception $ex ){
                Session::flash("error" , $ex);
            }
      return  Redirect::to('dashboard/items');
    }
    //get heddinlist====================================================
    public function getHidden()
    {
        if(isset($_GET['q'])){
            $q=$_GET['q'];
            $items=DB::table('items')
            ->where('active' , 1)
            ->where(function($query) use($q){
                $query->where('items.itemDescription' ,'LIKE' ,'%'.$q.'%')
                ->orwhere('code' ,'=' , $q)
                ->orwhere('itemDescription' ,'LIKE' ,'%'.$q.'%')
                ->orwhere('materialType1' ,'LIKE' , '%'.$q.'%')
                ->orwhere('materialType2' ,'LIKE' , '%'.$q.'%');
              
            })
            ->paginate(7);

        }else{
            $items=DB::table('items')->where('active' , 1)->paginate(7);
        }        
        // $items=array();
        return view ('backend.items.itemsHidden')->withitems($items);
 
    }
    // retyurn heddin list=============================================
    public function showHidden($id)
    {
        try{

            
            Item::where('code' ,'=', $id)->update(['active' => 0]);
            Session::flash("success" , "تم  الاعادة  بنجاح");
            }catch(\Exception $ex ){
                Session::flash("error" , $ex);
            }
      return  Redirect::to('dashboard/items');
    
    }
}
