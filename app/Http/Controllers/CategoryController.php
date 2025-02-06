<?php

namespace App\Http\Controllers;


use App\Models\ParentCategory;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Image;
use File;
use Auth;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\Response;


class CategoryController extends Controller
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
        return view('back.category.category_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.category.category_index');
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
            'name' => 'required|max:100',
        ]);

        $category = new Category();

        $category->user_id  = Auth::user()->id;
        $category->name = $request->name;
        
        if($request->slug == null){
            $category->slug = make_slug($request->name);
        }else{
            $category->slug = make_slug($request->slug);
        }
        
        if($request->position == null){
            $id = Category::orderby('id','desc')->first();
            if(!empty($id)){
             $category->position = $id->position+1;
            }else{
                $category->position = 1;
            }
        }else{
            $category->position = $request->position;
        }

        $category->save();
        return Redirect()->back()->with('success',  'Category inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
       $category = Category::find($id);
       // dd($category);
       return view('back.category.category_edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $category = Category::find($id);

        $request->validate([
            'name' => 'required|max:100',
        ]);

        $category->user_id = Auth::user()->id;
        $category->name = $request->name;
        
        if($request->slug == null){
            $category->slug = make_slug($request->name);
        }else{
            $category->slug = make_slug($request->slug);
        }
        
        if($request->position == null){
            $category->position = $category->id;
        }else{
            $category->position = $request->position;
        }
        $category->save();
        return Redirect()->route('category.index')->with('success',  'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {   

        $total_post = Category::find($id)->Posts()->count();
        if($total_post == 0){
            Category::find($id)->delete();
            Session::flash('message', 'Successfully Deleted the Category');

        } else {
            Session::flash('danger', 'Sorry, You have some posts related with this Category');
        }
        
        return Redirect()->route('category.index');

    }

    public function changeHomePage(Request $request){
        $category = Category::find($request->id);
        $category->home_page = $request->home_page;
        $category->save();
        return response()->json(['success'=>'Home page status change successfully.']);
    }

    
}
