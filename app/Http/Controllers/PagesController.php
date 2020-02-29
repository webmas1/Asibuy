<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SigninRequest;
use Session;
use App\User;
use App\Customer;

class PagesController extends MainController {



// PAGES FUNCTIONS


    public static function Dashboard() {
        self::$data['title'] .= 'Dashboard'; // add to broswer card title
        self::$data['headline'] = 'dashboard'; // page headline

        $customers = Customer::GetNewCustomers();

        if ($customers){
            self::$data['customers'] = $customers;
        }

        return view('content.dashboard', self::$data);
   }



// USER FUNCTIONS



    public static function Signin() {
        if (!Session::has('user_id')) {

            self::$data['title'] .= 'Sign in'; // add to broswer card title
            self::$data['headline'] = 'sign in'; // page headline
            self::$data['previous_page'] = url()->previous(); // previous page url

            return view('user.signin', self::$data);

        } else {
            return redirect('/');
        }
    }

    public static function SigninRequest(SigninRequest $request) {
        $email = $request->email;
        $password = $request->password;

        $user = User::Signin($email, $password);

        if ($user){
            if (Hash::check($password, $user['password'])){

                if ($user['status'] == 1) {
                    if ($user['role'] == 1) { // is admin
                        Session::put('user_role', 'admin');
                    } elseif ($user['role'] == 2) { // is user
                        Session::put('user_role', 'user');
                    }

                    Session::put('user_id', $user['id']);

                    if ( !empty($request->previous_page) ) { // if has previous page url, redirect to previous page
                        $redirect = $request->previous_page;
                    } else {
                        $redirect = '/';
                    }
                } else {
                    $errmsg = 'Your account has been suspended, please contact admin.';
                    Session::flash('errMsg', $errmsg);
                    $redirect = 'user/signin';
                }
            }
        } else {
            $errmsg = 'Your account name or password is incorrect.';
            Session::flash('errMsg', $errmsg);
            $redirect = 'user/signin';
        }


        return redirect($redirect);
    }


    public static function Signout() {
        Session::flush();

        $msg = 'You have sign out successfully';
        Session::flash('msg', $msg);

        // Session::put('previous_page',url()->previous());
        return redirect('user/signin');
    }



}
