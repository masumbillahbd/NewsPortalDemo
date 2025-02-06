<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

use DateTime;
use Auth;
use Image;
use File;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class SubCategoryController extends Controller
{

    public $user_info;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $this->user_info=Auth::user(); 
            if ($user->role == 'manager admin' || $user->role== 'editor'|| $user->role== 'user'){
                return redirect(route('dashboard.admin.index'))->with("danger", "Forbidden You don't have permission to access");
            } else {
                 return $next($request);
            }
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderby('name','asc')->get();
        return view('back.sub_category.sub_category_index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::orderby('name','asc')->get();
        return view('back.sub_category.sub_category_create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
        ]);

        $sub_cat =  new SubCategory();

        $sub_cat->user_id = Auth::user()->id;
        $sub_cat->category_id = $request->category_id;
        $sub_cat->name = $request->name;
        
        if($request->slug == null){
            $sub_cat->slug = make_slug($request->name);
        }else{
            $sub_cat->slug = make_slug($request->slug);
        }

        if($request->position == null){
            $id = SubCategory::orderby('id','desc')->first();
            if(!empty($id)){
                $sub_cat->position = $id->position+1;
            }else{
                $sub_cat->position = 1;
            }
        }else{
            $sub_cat->position = $request->position;
        }
        $sub_cat->save();

        return Redirect()->back()->with('success',  'Subcategory inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show( $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {   
        $categories = Category::orderby('name','asc')->get();
        $sub_cat = SubCategory::find($id);
        // dd($sub_cat);
        return view('back.sub_category.sub_category_edit', compact('categories', 'sub_cat'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $sub_cat = SubCategory::find($id);
        
        // dd($request->position );
        $sub_cat->user_id = Auth::user()->id;
        $sub_cat->category_id = $request->category_id;
        $sub_cat->name = $request->name;
        
        if($request->slug == null){
            $sub_cat->slug = make_slug($request->name);
        }else{
            $sub_cat->slug = make_slug($request->slug);
        }
        
        if($request->position == null){
            $sub_cat->position = $sub_cat->id;
        }else{
            $sub_cat->position = $request->position;
        }
        
        $sub_cat->save();

        return Redirect()->route('sub_category.index')->with('success',  'Subcategory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_cat = SubCategory::find($id);
        $sub_cat->delete();
        Session::flash('success', 'Sub Category deleted successfully');
   
        return Redirect()->back();
    }
}
