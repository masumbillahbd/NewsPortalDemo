<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $permissions = Permission::orderby('id','asc')->get();
        return view('back.permission.permission_index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $permissions = Permission::orderby('id','asc')->get();

        return view('back.permission.permission_create');
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
            'name' => 'required|max:100',
        ]);

        $permission = new Permission();

        $permission->name = strtolower($request->name);
        $permission->product = $request->product;
        $permission->website_setup = $request->website_setup;
        $permission->save();
        return Redirect()->route('permission.index')->with('success',  'Permission setup successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
         $permission =  Permission::find($id);
        return view('back.permission.permission_edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permission =  Permission::find($id);
        // dd($permission);
        $request->validate([
            'name' => 'required|max:100',
        ]);

        $permission->name = strtolower($request->name);
        $permission->product = $request->product;
        $permission->website_setup = $request->website_setup;
        $permission->save();
        return Redirect()->route('permission.index')->with('success',  'Permission setup successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $permission =  Permission::find($id);
        $permission->delete();

        return Redirect()->route('permission.index')->with('success',  'Permission deleted successfully');
    }
}
