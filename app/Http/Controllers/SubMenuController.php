<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\SubMenu;

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

class SubMenuController extends Controller
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
    {
        $menus = Menu::orderby('id','desc')->get();
        $submenus = SubMenu::orderby('position','asc')->get();
        return view('back.sub_menu.submenu_create', compact('menus','submenus'));
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
            'menu_id' => 'required',
            'url_text' => 'required|max:250',
            'url_path' => 'required|max:250',
        ]);

        $menu = new SubMenu();
        $menu->user_id  = Auth::user()->id;
        $menu->menu_id = $request->menu_id;
        $menu->url_text = $request->url_text;
        $menu->url_path = $request->url_path;

        if($request->position == null){
            $id = Menu::orderby('id','desc')->first();
            $menu->position = $id->position+1;
        }else{
            $menu->position = $request->position;
        }
        $menu->save();
        return Redirect()->back()->with('success',  'Sub Menu inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubMenu  $subMenu
     * @return \Illuminate\Http\Response
     */
    public function show(SubMenu $subMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubMenu  $subMenu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   

        $menus = Menu::orderby('id','desc')->get();
        $submenu = SubMenu::find($id);
        $submenus = SubMenu::orderby('position','asc')->get();
        return view('back.sub_menu.submenu_edit', compact('menus', 'submenu', 'submenus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubMenu  $subMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'menu_id' => 'required',
            'url_text' => 'required|max:250',
            'url_path' => 'required|max:250',
        ]);
        
        $sub_menu = SubMenu::find($id);
        
        $sub_menu->user_id  = Auth::user()->id;
        $sub_menu->menu_id = $request->menu_id;
        $sub_menu->url_text = $request->url_text;
        $sub_menu->url_path = $request->url_path;

        if($request->position == null){
            $id = Menu::orderby('id','desc')->first();
            $sub_menu->position = $id->position+1;
        }else{
            $sub_menu->position = $request->position;
        }
        $sub_menu->save();
        return Redirect()->route('submenu.index')->with('success',  'Sub Menu updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubMenu  $subMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_menu = SubMenu::find($id);
        $sub_menu->delete();
        Session::flash('success', 'Sub Menu deleted successfully');
        
        return Redirect()->back();
    }
}
