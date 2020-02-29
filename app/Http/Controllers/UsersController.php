<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\FiltersRequest;
use App\User;
use Carbon\Carbon;
use Session;


class UsersController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FiltersRequest $request)
    {
        self::$data['title'] .= 'Admin Panel - Users'; // add to broswer card title
        self::$data['headline'] = 'admin panel - users'; // page headline

        if ($request->has('created_at')) { // if filter by created at

            $created_at = $request->created_at;

            switch($created_at) { // query editing by value
                case 'week': // this week
                    $users = User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->latest()->paginate(10)->appends('created_at', $created_at);
                    break;
                case 'month': // this month
                    $users = User::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->latest()->paginate(10)->appends('created_at', $created_at);
                    break;
                case 'year': // this year
                    $users = User::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->latest()->paginate(10)->appends('created_at', $created_at);
                    break;
                default:
                $users = User::GetUsers();
            }

        } else if ($request->has('updated_at')) { // if filter by updated at

            $updated_at = $request->updated_at;

            switch($updated_at) { // query editing by value
                case 'week': // this week
                    $users = User::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->latest()->paginate(10)->appends('updated_at', $updated_at);
                    break;
                case 'month': // this month
                    $users = User::whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->latest()->paginate(10)->appends('updated_at', $updated_at);
                    break;
                case 'year': // this year
                    $users = User::whereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->latest()->paginate(10)->appends('updated_at', $updated_at);
                    break;
                default:
                $users = User::GetUsers();
            }

        } else if ($request->has('role')) { // if filter by role

            $role_filter = $request->role;

            switch($role_filter) { // query editing by value
                case 'admin':
                    $users = User::where('role', '1')->latest()->paginate(10)->appends('role', $role_filter);
                    break;
                case 'user':
                    $users = User::where('role', '2')->latest()->paginate(10)->appends('role', $role_filter);
                break;
                default:
                $users = User::GetUsers();
            }

        } else if ($request->has('status')) { // if filter by status

            $status_filter = $request->status;

            switch($status_filter) { // query editing by value
                case 'suspended':
                    $users = User::where('status', '0')->latest()->paginate(10)->appends('status', $status_filter);
                    break;
                case 'activate':
                    $users = User::where('status', '1')->latest()->paginate(10)->appends('status', $status_filter);
                break;
                default:
                $users = User::GetUsers();
            }

        } else {
            $users = User::GetUsers();
        }

        if ( !empty($users[0]) ) {
            self::$data['users'] = $users;
        }

        return view('admin.users', self::$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$data['title'] .= 'Admin Panel - New User'; // add to broswer card title
        self::$data['headline'] = 'admin panel - new user'; // page headline
        self::$data['previous_page'] = url()->previous(); // previous page url

        return view('admin.newUser', self::$data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewUserRequest $request)
    {
        if (User::NewUser($request)) {
            Session::flash('msg', 'User has been added successfully');
            if ( !empty($request->previous_page) ) { // if has previous page url, redirect to previous page
                $redirect = $request->previous_page;
            } else {
                $redirect = 'admin/users';
            }
        } else {
            Session::flash('errMsg', 'Something went wrong, please try again');
            $redirect = 'admin/users';
        }
        return redirect($redirect);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('admin/users');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (User::find($id)) {
            self::$data['user'] = User::find($id);
            self::$data['title'] .= 'Admin Panel - Edit User'; // add to broswer card title
            self::$data['headline'] = 'admin panel - edit user'; // page headline
            self::$data['previous_page'] = url()->previous(); // previous page url

            return view('admin.editUser', self::$data);
        } else {
            Session::flash('errMsg', 'User does not exists');
            return redirect(url()->previous());
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        if (User::find($id)){
            if (User::UpdateUser($request, $id)) {
                Session::flash('msg', 'User has been updated successfully');
                if ( !empty($request->previous_page) ) { // if has previous page url, redirect to previous page
                    $redirect = $request->previous_page;
                } else {
                    $redirect = 'admin/users';
                }
            } else {
                Session::flash('errMsg', 'Something went wrong, please try again');
                $redirect = url()->previous();
            }
        } else {
            Session::flash('errMsg', 'Something went wrong, please try again');
            $redirect = url()->previous();
        }

        return redirect($redirect);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (User::find($id)) {
            if (User::DeleteUser($id)) {
                Session::flash('msg', 'User has been deleted successfully.');
                $redirect = 'admin/users';
            } else {
                Session::flash('errMsg', 'Something went wrong, try again.');
                $redirect = url()->previous();
            }
        } else {
            Session::flash('errMsg', 'Something went wrong, try again.');
            $redirect = url()->previous();
        }

        return redirect($redirect);
    }


    public function changeStatus($id)
    {
        if (User::find($id)) {
            if (User::ChangeStatus($id)) {
                Session::flash('msg', 'User status has been changed successfully.');
                $redirect = 'admin/users';
            } else {
                Session::flash('errMsg', 'Something went wrong, try again.');
                $redirect = url()->previous();
            }
        } else {
            Session::flash('errMsg', 'Something went wrong, try again.');
            $redirect = url()->previous();
        }

        return redirect($redirect);
    }
}
