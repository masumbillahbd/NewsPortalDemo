<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;

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

class DistrictController extends Controller
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
    
    
    public function create()
    {
        $divisions = Division::all();
        $districts = District::orderBy('division_id','asc')->Paginate(22);
        return view('back.district.create', compact('divisions','districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'slug' => 'required|max:100',
            'division_id' => 'required',
        ]);

        if ($validator->fails()) {
            if (request()->ajax()) {
                return Response::json($validator);
            }

            return Redirect::back()->withErrors($validator);
        }

        if ($request->slug) {
            $slug = $request->slug;
            $slug = strtolower($slug);
        } else {
            $slug = str_replace(' ', '-', $request->name);
            $slug = strtolower($slug);
        }

        $district = new District;
        $district->division_id = $request->division_id;
        $district->name = $request->name;
        $district->slug = $slug;
        $district->save();
        Session::flash('message', 'Successfully Added');

        return Redirect::to(route('district.create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = District::find($id);

        $divisions = Division::all();
        $districts = District::orderBy('division_id','asc')->Paginate(22);
        return view('back.district.edit', compact('edit', 'divisions', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'slug' => 'required|max:100',
            'division_id' => 'required'
        ]);

        if ($validator->fails()) {
            if (request()->ajax()) {
                return Response::json($validator);
            }

            return Redirect::back()->withErrors($validator);
        }

        if ($request->slug) {
            $slug = $request->slug;
            $slug = strtolower($slug);
        } else {
            $slug = str_replace(' ', '-', $request->name);
            $slug = strtolower($slug);
        }

        $district = District::find($id);
        $district->division_id = $request->division_id;
        $district->name = $request->name;
        $district->slug = $slug;
        $district->save();
        Session::flash('message', 'Successfully Added');

        return Redirect::to(route('district.create'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $district = District::find($id);
        $upazila = $district->upazila->count();
        
        $post = $district->posts()->count();
        $total =  $upazila + $post;
        if($total == 0) {
            $district->posts()->detach();
            $district->delete();
            Session::flash('success', 'Successfully Deleted');
        }else{
            Session::flash('danger', 'don\'t Deleted. This record related another records');
        }
        

        return Redirect::to(route('district.create'));

    }
}
