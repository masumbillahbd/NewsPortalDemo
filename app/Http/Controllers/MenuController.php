<?php

namespace App\Http\Controllers;

use App\Models\SubMenu;
use App\Models\Menu;



use DateTime;
use Auth;
use Image;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Pagination\CursorPaginator;
class MenuController extends Controller
{
    public $user_info;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $this->user_info=Auth::user(); 
            if ($user->role== 'user'){
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
    {   $menus = Menu::orderBy('position','asc')->get();
        return view('back.menu.menu_create', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'url_text' => 'required|max:250',
            'url_path' => 'required|max:250',
        ]);

        $menu = new Menu();

        $menu->user_id  = Auth::user()->id;
        $menu->url_text = $request->url_text;
        $menu->url_path = $request->url_path;

        if($request->position == null){
            $id = Menu::orderby('id','desc')->first();
            $menu->position = $id->position+1;
        }else{
            $menu->position = $request->position;
        }
        $menu->save();
        return Redirect()->back()->with('success',  'Menu inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $menu = Menu::find($id);
        $menus = Menu::orderby('position','asc')->get();
        return view('back.menu.menu_edit', compact('menu','menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $menu = Menu::find($id);
        $menu->user_id  = Auth::user()->id;
        $menu->url_text = $request->url_text;
        $menu->url_path = $request->url_path;

        if($request->position == null){
            $id = Menu::orderby('id','desc')->first();
            $menu->position = $id->position+1;
        }else{
            $menu->position = $request->position;
        }
        $menu->save();
        return Redirect()->route('menu.index')->with('success',  'Menu updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $menu = Menu::find($id);
        $total = $menu->subMenu->count();
        
        if($total == 0) {
            $menu->delete();
            Session::flash('success', 'Successfully Deleted');
        }else{
            Session::flash('danger', 'don\'t Deleted. This record related another records');
        }
        return Redirect()->back();
    }
}
