<?php

namespace App\Http\Controllers;

use App\Models\Prayertime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Auth;
class PrayertimeController extends Controller
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
        $prayertime = Prayertime::orderBy('id','desc')->first();
        return view('back.prayertime.index', compact('prayertime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prayertime  $prayertime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $prayertime = Prayertime::orderBy('id','desc')->first();
        $request->validate([
            'fajr' => 'max:30',
            'zuhr' => 'max:30',
            'asr' => 'max:30',
            'maghrib' => 'max:30',
            'isha' => 'max:30',
        ]);
        
        $prayertime->fajr    = $request->fajr;
        $prayertime->zuhr    = $request->zuhr;
        $prayertime->asr    = $request->asr;
        $prayertime->maghrib    = $request->maghrib;
        $prayertime->isha    = $request->isha;
        $prayertime->sun_rise    = $request->sun_rise;
        $prayertime->sun_set    = $request->sun_set;
        $prayertime->save(); 
        return Redirect()->back()->with('success','Update successfully');
    }

}
