<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function modifyUsersIndex() {

        $users = $this->fetchAll();

        return view('users/modify', ['users' => $users]);
    }

    public function modifyUser(Request $request) {
        $id = $request['id'];
        $username = $request['username'];
        $email = $request['email'];
        
        DB::table('users')->where('id', $id)->update(['type' => $type,'email' => $email, 'username' => $username]);
        return json_encode(array(
            "status" => 200,
        ));
    }
    
    public function checkAdmin(Request $request) {
        
        $id = $request['id'];
        $type = $request['type'];
        
        DB::table('users')->where('id', $id)->update(['type' => $type]);
        
        return json_encode(array(
            "status" => 200,
            "type" => $type
        ));
    }

    public function deleteUser(Request $request) {

        $id = $request['id'];
        DB::table('users')->where('id', '=', $id)->update(['unsuscribe' => true, 'type' => "Professor"]);
        DB::table('assigned_rols')->where('user_id', '=', $id)->delete();
        
        return json_encode(array(
            "status" => 200, "message" => "User unsuscribed successfully"
        ));
    }
    
    public function suscribeUser(Request $request){
        $id = $request['id'];
        DB::table('users')->where('id', '=', $id)->update(['unsuscribe' => false]);
        
        return json_encode(array(
            "status" => 200, "message" => "User suscribed successfully"
        ));
    }

    public function fetchAll() {

        $users = DB::table('users')->get();

        return $users;
    }

    public function createIndex() {
        return view('users/createusers');
    }

    public function insertManual(Request $request) {

        $type;

        $email = $request->input('email');
        $pass = $request->input('password');
        $password = Hash::make($pass);
        $name = $request->input('name');
        $username = $request->input('username');
        $check = $request->input('role');

        if ($check) {
            $type = User::ADMIN_TYPE;
        } else {
            $type = User::DEFAULT_TYPE;
        }

        $timezone = "Europe/Madrid";
        $timestamp = date('Y-m-d H:i:s');
        $date = date_create($timestamp, timezone_open($timezone));

        if (!empty($email) && !empty($password) && !empty($name) && !empty($username) && !empty($date)) {
            $data = array('type' => $type, "name" => $name, "email" => $email, "username" => $username, "password" => $password, "created_at" => $date);
            DB::table('users')->insert($data);
        }

        return redirect(url('/createuser'));
    }

    public function importFile(Request $request) {
        if ($request->input('submit') != null) {

            $file = $request->file('file');

            // File Details 
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");

            // 2MB in Bytes
            $maxFileSize = 2097152;

            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {

                // Check file size
                if ($fileSize <= $maxFileSize) {

                    // File upload location
                    $location = 'uploads';

                    // Upload file
                    $file->move($location, $filename);

                    // Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);

                    // Reading file
                    $file = fopen($filepath, "r");

                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);

                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata [$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    foreach ($importData_arr as $importData) {
                        $user = User::where('email', '=', $importData[2])->first();
                        if ($user === null) {
                            $timezone = "Europe/Madrid";
                            $timestamp = date('Y-m-d H:i:s');
                            $date = date_create($timestamp, timezone_open($timezone));

                            $insertData = array(
                                "type" => $importData[0],
                                "name" => $importData[1],
                                "email" => $importData[2],
                                "username" => $importData[3],
                                "password" => Hash::make($importData[4]),
                                "created_at" => $date);
                            Page::insertData($insertData);
                        }
                    }
                }
            }
        }

        return view('users/createusers');
    }

}
