<?php

namespace App\Http\Controllers;


use App\Models\Banner;
use App\Models\Post;

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

class BannerController extends Controller
{
    public $user_info;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $this->user_info=Auth::user(); 
            if ($user->role== 'editor'|| $user->role== 'user'){
                return redirect(route('dashboard.admin.index'))->with("danger", "Forbidden You don't have permission to access");
            } else {
                 return $next($request);
            }
        });
    }
    

    public function index()
    {
        return view('back.banner.index');
    }

    public function create()
    {
        return view('pages.banner.create');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|max:250',
            'banner' => 'required|max:250',
        ]);
        
        // dd($request);

        $banner = new Banner;
        $banner->user_id = Auth::user()->id;
        $banner->name = $request->name;
        $banner->banner = $request->banner;
        $banner->save();

        Session::flash('success', 'Successfully Added');

        return Redirect::back();

    }

    public function edit($id)
    {
        $edit = Banner::find($id);
        // dd($edit);
        return view('back.banner.edit', compact('edit'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:250',
            'banner' => 'required|max:250',
        ]);
        
        $banner = Banner::find($id);
        $banner->user_id = Auth::user()->id;
        $banner->name = $request->name;
        $banner->banner = $request->banner;
        $banner->save();

        Session::flash('success', 'Successfully Updated');

        return Redirect::to(route('banner.index'));
    }

    public function destroy($id)
    {
        Banner::find($id)->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::to(route('banner.index'));
    }
    
    public function banner_status_toggle(Request $request){
        $banner = Banner::find($request->id);
        $banner->status = $request->status;
        $banner->save();
        return response()->json(['success'=>'Banner status change successfully.']);
    }
    
}
