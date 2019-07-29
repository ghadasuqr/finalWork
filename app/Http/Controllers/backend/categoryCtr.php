<?php

namespace App\Http\Controllers\backend;
use Session;
use Redirect;
use App\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class categoryCtr extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=category::get();
        return  view ('backend.category.categoryList')->withdata($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view ('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoryName=$request->input('categoryName');
        $request->validate(['categoryName'=>'required|min:2|max:20|regex:/^[a-zA-Zأ-ي\s]*$/u' ]);
     

        $found=DB::table('categories')->where('categoryName' , $request->input('categoryName'))->get();


        if( count($found) >0) {
        Session::flash('msgCategory','هذا الاسم موجود مسبقا');
        return Redirect::back();
        }else{
                        try {
                            $row = new category;
                            $row->categoryName = $request->input('categoryName');
                            $row->save();
                            Session::flash('success', 'تمت الاضافة بنجاخ');
                            return Redirect::to('category');
                        } catch (\Exception $e) {
                            Session::flash('error', 'حدث خطأ');
                            return Redirect::back();
                        }//catch
                            
            }//last else
    }
 
    public function edit( $categoryNo)
    {
        $row=category::where('categoryNo' , $categoryNo)->first();
        return view ('backend.category.edit')->withrow($row);
    }


    public function update($categoryNo , Request $request)
    {
        $categoryName=$request->input('categoryName');
        $found=DB::table('categories')->where('categoryName' , $request->input('categoryName'))->get();
        $request->validate(['categoryName'=>'required|min:2|max:20']);

        if (!preg_match("/^[a-zA-Zأ-ي\s]*$/u",$categoryName))
         { // if name
            Session::flash('msgCategory' , "اسم الفئة ينبغى ان يكون احرف فقط");        
            return Redirect::back();
        }elseif    ( count($found) >0) {
            Session::flash('msgCategory','هذا الاسم موجود مسبقا');
            return Redirect::back();
        }else{

            try{
                DB::table('categories')
                    ->where('categoryNo', $categoryNo)
                    ->update(
                        ['categoryName' =>$request->input('categoryName')]
                            );

                Session::flash('success', 'تم التعديل بنجاخ');
                return Redirect::to('category');
            } catch (\Exception $e) {
                Session::flash('error',"حدث خطأ أثناءالتعديل");
                return Redirect::to('category');
            }//catch



        }//else

    }

    public function show($categoryNo)
    {
                try{
                    category::where('categoryNo',$categoryNo)->update(['active'=>0]);
                    Session::flash("success" , "تم الاعادة بنجاح");

                }catch(\Exception $ex ){
                    Session::flash("error" , "لم يتم الاعادة");
                }

        return   Redirect::back() ;//to return to tha same page -- categoryList here 

      
    }
    public function destroy($categoryNo)
    {
                try{
                    category::where('categoryNo',$categoryNo)->update(['active'=>1]);
                    Session::flash("success" , "تم الحذف بنجاح");

                }catch(\Exception $ex ){
                    Session::flash("error" , "لم يتم الحذف");
                }

        return   Redirect::back() ;//to return to tha same page -- categoryList here 

      
    }
}
