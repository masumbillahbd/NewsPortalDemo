<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;

use DateTime;
use Auth;
use Image;

use Carbon\Carbon;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Pagination\CursorPaginator;

class AdController extends Controller
{   
    public $user_info;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $this->user_info=Auth::user(); 
            if ( $user->role== 'editor'|| $user->role== 'user'){
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
        return view('back.ad.ad_index');
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
            'name' => 'required|max:200',
            'photo' => 'required|max:300',
        ]);

        $ad =  new Ad();

        $ad->user_id     = Auth::user()->id;
        $ad->name     = $request->name;
        $ad->url     = $request->url;
        $ad->position     = $request->position;

        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/ads/'), $fileName);
            $ad->photo = $fileName;
        }


        $ad->save();
        return Redirect()->back()->with('success',  'Advertisement inserted successfully');

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $ad = Ad::find($id);
        // dd($ad);
        return view('back.ad.ad_edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required|max:300',
        ]);
        $ad =   Ad::find($id);

        $ad->user_id     = Auth::user()->id;
        $ad->name     = $request->name;
        $ad->url     = $request->url;
        $ad->position     = $request->position;

        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/ads/'), $fileName);
            $ad->photo = $fileName;
        }

        $ad->save();
        return Redirect()->route('ad.index')->with('success',  'Advertisement updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad =   Ad::find($id);   
        $ad->delete();
        return Redirect()->route('ad.index')->with('success',  'Advertisement deleted successfully');
    }
}
