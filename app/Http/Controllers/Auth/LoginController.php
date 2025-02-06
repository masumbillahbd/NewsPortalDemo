<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    
     // protected $redirectTo = '/';


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }


    public function authenticated(){
        if (Auth::check()) {
            
            if(Auth::user()->role == 'admin' || auth()->user()->role == 'editor' || auth()->user()->role == 'user' || auth()->user()->role == 'manager admin'){
                DB::table('login_info')->insert(['user_id' => Auth::user()->id, 'user_name' => Auth::user()->name,'login_time' => Carbon::now()]);
                return redirect()->route('dashboard.admin.index')->with('success','Welcome to Dashboard');
            }else{
                return redirect('/');
            }
        }
        
        else{
            return view('auth/login');
        }   
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
