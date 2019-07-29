<?php

namespace App;
use DB;
use Auth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    static public  function getNameById($id){
        $user=DB::table('users')->where('id' , $id)->first();
        $name=$user->name;
        return $name;
    }
    
    static public  function getShipperById($id){
        $user=DB::table('users')->where('id' , $id)->where('Role' , 2)->first();
        if($user){
            $name=$user->name;
            return $name;

        }else
        return ' لم يتم اسناده ';
     
    }


    static public  function getSippers(){
        $shippers=DB::table('users')->where('Role' , 2)->where('blocked' , 0)->get();
        return $shippers;
      
    }
    static public function groupUser($role){
        $info="";
        switch ($role) {
            case 0:
            $info=" مستخدم";
                break;
            case 1:
            $info="أدمن";
            break;
            case 2:
            $info="توصيل";
            break;
       
            
            default:
            $info="";

        } 
return $info;
        
    }//fn

    
}
