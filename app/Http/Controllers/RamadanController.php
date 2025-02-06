<?php

namespace App\Http\Controllers;

use App\Models\Ramadan;
use Illuminate\Http\Request;
use Auth;

class RamadanController extends Controller
{
   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $ramadans = Ramadan::orderby('division','asc')->get();
        return view('back.ramadan.create',compact('ramadans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');
        $request->validate([
            'division' => 'required|max:50',
            'ramadan_no' => 'required|integer',
            'date' => 'required',
            'sehri' => 'required',
            'iftar' => 'required',
        ]);

        $ramadan =  new Ramadan();
        $ramadan->user_id     = Auth::user()->id;
        $ramadan->division     = $request->division;
        $ramadan->ramadan_no     = $request->ramadan_no;
        $ramadan->date     = $request->date;
        $ramadan->sehri     = $request->sehri;
        $ramadan->iftar     = $request->iftar;
        $ramadan->save();
        return Redirect()->back()->with('success',  'inserted successfully');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = Ramadan::findOrFail($id);
        $ramadans = Ramadan::orderby('division','asc')->get();
        return view('back.ramadan.edit',compact('ramadans','edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Dhaka');
        $ramadan = Ramadan::findOrFail($id);
        $request->validate([
            'division' => 'required|max:50',
            'ramadan_no' => 'required|integer',
            'date' => 'required',
            'sehri' => 'required',
            'iftar' => 'required',
        ]);
        $ramadan->user_id     = Auth::user()->id;
        $ramadan->division     = $request->division;
        $ramadan->ramadan_no     = $request->ramadan_no;
        $ramadan->date     = $request->date;
        $ramadan->sehri     = $request->sehri;
        $ramadan->iftar     = $request->iftar;
        $ramadan->save();
        return Redirect()->route('ramadan.create')->with('success',  'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Ramadan::findOrFail($id)->delete();
        return Redirect()->route('ramadan.create')->with('success',  'deleted successfully');
    }
}
