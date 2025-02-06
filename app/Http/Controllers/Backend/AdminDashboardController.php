<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\Color;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Tag;

use DateTime;

use Image;

use Carbon\Carbon;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Pagination\CursorPaginator;


class AdminDashboardController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view_dashboard()
    {
        if (Auth::check()) {
            if(Auth::user()->role == 'admin' || Auth::user()->role == 'editor' || Auth::user()->role == 'user' || Auth::user()->role == 'manager admin'){
                return view('back.index');
            }
        }
    }

    // public function index()
    // {
    //     return view('back.index');
    // }
}
