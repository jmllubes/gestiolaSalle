<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    const ADMIN_TYPE = 'Admin';
    const DEFAULT_TYPE = 'Professor';

    public function isAdmin(){
        return $this->type === self::ADMIN_TYPE;
    }
    
    public function hasRols(){
        $id = $this->id;
        $rol = DB::table('assigned_rols')->where('user_id', '=', $id)->count();
        
        return $rol;
    }
    
    public function notUnsuscribed(){
        return $this->unsuscribe === 0;
    }
    
    protected $fillable = [
        'unsuscribe','type', 'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
