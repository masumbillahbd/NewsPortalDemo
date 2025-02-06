<?php

namespace App\Http\Controllers;

use App\Models\Reporter;
use Illuminate\Http\Request;

class ReporterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.reporter.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.reporter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'designation' => 'required|string|max:100',
            'position' => 'integer|max:1000',
        ]);
        $reporter = new Reporter();
        $reporter->name   = $request->name;
        $reporter->email   = $request->email;
        $reporter->designation   = $request->designation;
        $reporter->position   = $request->position;
        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/reporter/'), $fileName);
            $reporter->photo = $fileName;
        }
        $reporter->save();
        return Redirect()->back()->with('success',  'inserted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reporter $reporter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reporter = Reporter::find($id);
        return view('back.reporter.edit',compact('reporter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $reporter = Reporter::find($id);
        $request->validate([
            'name' => 'required|string|max:100',
            'designation' => 'required|string|max:100',
            'position' => 'integer|max:1000',
        ]);
    
        $reporter->name   = $request->name;
        $reporter->email   = $request->email;
        $reporter->designation   = $request->designation;
        $reporter->position   = $request->position;
        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/reporter/'), $fileName);
            $reporter->photo = $fileName;
        }
        $reporter->save();
        return Redirect()->route('reporter.index')->with('success',  'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reporter = Reporter::find($id);
        $post = $reporter->post()->count();
        
        if($post == 0){
            $reporter->delete();
            return Redirect()->back()->with('success',  'Deleted successfully');
        }
        return Redirect()->back()->with('danger',  'Reporter related some other tables');
    }
}
