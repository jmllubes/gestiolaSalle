<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Page;

class HomeController extends Controller {

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
        
        
        foreach($incidence_process as $inc){
            $inc_prc = $inc->inc_count;
        }
        foreach($incidence_pending as $inc){
            $inc_pen = $inc->inc_count;
        }
        foreach($incidence_success as $inc){
            $inc_suc = $inc->inc_count;
        }
        
        return response()->json(
                [
                    'result' => 'success',
                    'category' => $category,
                    'users' => $users,
                    'incidence_total' => $incidence,
                    'incidence_process' => $inc_prc,
                    'incidence_pending' => $inc_pen,
                    'incidence_success' => $inc_suc,
                 ]);
    }

}