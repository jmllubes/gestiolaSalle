<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller {

    public function markAsRead() {

        auth()->user()->unreadNotifications->markAsRead();

        return json_encode(array(
            "result" => 200
        ));
    }

}
