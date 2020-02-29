<?php

namespace App;
use DateTime;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    // Defines relationship
    public function handles() {
        return $this->hasMany('App\Handle', 'user_id');
    }

    // Defines relationship
    public function tickets() {
        return $this->hasMany('App\Ticket', 'user_id');
    }

    public static function Signin($email, $password){
        if ($user = self::where('email', '=', $email)->get()->toArray()){
            $user = $user[0];
            return $user;
        }
    }

    // Get users order by date and paginated
    public static function GetUsers() {
        $users = self::latest()->paginate(10);
        return $users;
    }

    // Save new user to DB
    public static function NewUser($request) {
        $user = new self();

        $user->first_name = strtolower($request->first_name);
        $user->last_name = strtolower($request->last_name);
        $user->role = $request->role;
        $user->email = strtolower($request->email);
        $user->password = bcrypt($request->password);

        $user->status = '1';
        $user->created_at = new DateTime();
        $user->updated_at = new DateTime();

        $user->save();

        if ($user->id) {
            return true;
        } else {
            return false;
        }
    }

    // save updated to user
    public static function UpdateUser($request, $id) {
        $user = self::find($id);

        $user->first_name = strtolower($request->first_name);
        $user->last_name = strtolower($request->last_name);
        $user->role = $request->role;

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->updated_at = new DateTime();

        if ($user->save()) {
            return true;
        }
    }

    // change user status
    public static function changeStatus($id) {

        if ($user = self::find($id)) {

            $current_status = $user->status;

            if ($current_status == 1) {
                $user->status = 0;
            } else if ($current_status == 0) {
                $user->status = 1;
            }

            $user->updated_at = new DateTime();

            if ($user->save()) {
                return true;
            }
        }
        return false;

    }


}
