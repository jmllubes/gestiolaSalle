<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $process = "En procés";
        $success = "Resolta";
        $notAttend = "Pendent";
        
        $category = DB::table('category')->count();
        $users = DB::table('users')->count();
        $incidence = DB::table('incidence')->count();
        
        $incidence_process = DB::table('incidence')
                                ->select(DB::raw('count(*) as inc_count'))
                                ->where('status','LIKE', $process)
                                ->get();
        
        $incidence_pending = DB::table('incidence')
                                ->select(DB::raw('count(*) as inc_count'))
                                ->where('status','LIKE', $notAttend)
                                ->get();
        
        $incidence_success = DB::table('incidence')
                                ->select(DB::raw('count(*) as inc_count'))
                                ->where('status','LIKE', $success)
                                ->get();
        
        return view('home',['category' => $category, 'users' => $users,
                            'incidence' => $incidence, 'inc_process' => $incidence_process, 'inc_pend' => $incidence_pending, 'inc_succ' => $incidence_success]);
    }
}
