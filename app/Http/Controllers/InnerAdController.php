<?php

namespace App\Http\Controllers;

use App\Models\InnerAd;
use Illuminate\Http\Request;
use DateTime;
use Auth;
use Image;
use File;
use Carbon\Carbon;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Pagination\CursorPaginator;

class InnerAdController extends Controller
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
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ad = InnerAd::orderBy('id','desc')->first();
        return view('back.innerAd.create', compact('ad'));
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
        $ad = new  InnerAd();

        $ad->status     = $request->status;
        $ad->url     = $request->url;
        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('/ads/'), $fileName);
            $ad->photo = $fileName;
        }
        $ad->save();
        return Redirect()->back()->with('success',  'Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InnerAd  $innerAd
     * @return \Illuminate\Http\Response
     */
    public function show(InnerAd $innerAd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InnerAd  $innerAd
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $ad = InnerAd::find($id);
        return view('back.innerAd.edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InnerAd  $innerAd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $ad = InnerAd::find($id);

        $ad->status     = $request->status;
        $ad->url     = $request->url;
        if($request->hasfile('photo')){
            $prev_image = public_path("/ads/").$ad->photo;
            if(File::exists($prev_image)) {
                File::delete($prev_image);
            }
            $file = $request->file('photo');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('/ads/'), $fileName);
            $ad->photo = $fileName;
        }

        $ad->save();
        return Redirect()->route('innerAd.index')->with('success',  'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InnerAd  $innerAd
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $ad = InnerAd::find($id);
//        $file = 'ads/'.$ad->photo;
        $file = public_path("/ads/").$ad->photo;
        if(File::exists($file)) {
            File::delete($file);
        }
        $ad->delete();
        return Redirect()->route('innerAd.index')->with('success','Successfully Deleted');
    }
}
