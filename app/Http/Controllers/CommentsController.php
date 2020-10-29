<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\IncidenceController;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function insert(Request $request, $id) {
        date_default_timezone_set('Europe/Madrid');
        $date = date('Y/m/d H:i:s', time());
        $comment = $request->input('comment');
        $user = auth()->user();
        $author_id = $user->id;
        
        if(empty($comment)) {
            return redirect()->back();
        }
        
        $data = array("incidence_id" => $id, "user_id" => $author_id, "description" => $comment, "created_at" => $date);
        DB::table('comments')->insert($data);
        
        return redirect()->back();
    }
}
