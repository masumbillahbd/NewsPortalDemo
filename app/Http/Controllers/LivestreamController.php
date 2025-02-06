<?php

namespace App\Http\Controllers;

use App\Models\Livestream;
use Illuminate\Http\Request;

class LivestreamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = Livestream::orderBy('id','desc')->first();
        return view('back.video.livestream',compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        
        $item = new Livestream();
        $item->content = $request->content;
        $item->save();
        return Redirect()->back()->with('success',  'Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Livestream $livestream)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Livestream $livestream)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Livestream::find($id);
        $item->content = $request->content;
        $item->save();
        return Redirect()->back()->with('success',  'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livestream $livestream)
    {
        //
    }
    
    public function changeLivestreamStatus(Request $request){
        $item = Livestream::find($request->id);
        $item->status = $request->status;
        $item->save();
        return response()->json(['success'=>'Status Change successfully']);
    }
    
}
