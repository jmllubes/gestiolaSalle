<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Controllers\IncidenceController;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {

    private $incidence;

    public function fetchEmail($response) {
        $catid = $response['category_id'];
        $emails = array();
        $user = DB::table('users')
                ->select('email')
                ->where('type', 'LIKE', 'Admin')
                ->get();

        $category = DB::table('category')
                        ->select('description')
                        ->where("id", '=', $catid)->get();

        $rol_email = DB::table('assigned_rols')
                        ->join('users', 'assigned_rols.user_id', '=', 'users.id')
                        ->select('email')
                        ->where('category', '=', $catid)->get();
        
        foreach ($category as $cat) {
            $catdesc = $cat->description;
        }
        
        $response['categoryname'] = $catdesc;

        foreach ($user as $email) {
            array_push($emails, $email->email);
        }
        
        foreach($rol_email as $email){
            array_push($emails,$email->email);
        }
        
         Mail::send('mail', $response, function($message) use($emails) {
          $message->to($emails)->subject
          ('La Salle - Incidència nova');
          $message->from('nokiahammer@nokiahammer.cat', 'La Salle');
          }); 

        return redirect(url('/incidence'));
    }

}
