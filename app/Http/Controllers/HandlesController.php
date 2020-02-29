<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewHandleRequest;
use App\Http\Requests\UpdateHandleRequest;
use App\Http\Requests\FiltersRequest;
use App\User;
use App\Customer;
use App\Ticket;
use App\Handle;
use Carbon\Carbon;
use Session;


class HandlesController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return redirect(url()->previous());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->has('ticket_id')) {

            $ticket_id = $request->ticket_id;

            if (Ticket::find($ticket_id)) {
                self::$data['ticket'] = Ticket::find($ticket_id);

                self::$data['title'] .= 'Tickets - New Handle'; // add to broswer card title
                self::$data['headline'] = 'tickets - new handle'; // page headline
                self::$data['previous_page'] = url()->previous(); // previous page url

                return view('content.newHandle', self::$data);
            }

        }

        Session::flash('errMsg', 'Something went wrong, please try again');
        return redirect('tickets/');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewHandleRequest $request)
    {
        if (Handle::NewHandle($request)) {
            Session::flash('msg', 'Handle has been created successfully');
            if ( !empty($request->previous_page) ) { // if has previous page url, redirect to previous page
                $redirect = $request->previous_page;
            } else {
                $redirect = 'tickets/';
            }
        } else {
            Session::flash('errMsg', 'Something went wrong, please try again');
            $redirect = url()->previous();
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
        return redirect(url()->previous());
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        self::$data['previous_page'] = url()->previous(); // previous page url

        if (Handle::find($id)) {
            self::$data['handle'] = Handle::find($id);
            self::$data['title'] .= 'Tickets - Edit Handle'; // add to broswer card title
            self::$data['headline'] = 'tickets - edit handle'; // page headline
            return view('content.editHandle', self::$data);
        } else {
            Session::flash('errMsg', 'Handle does not exists');
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
    public function update(UpdateHandleRequest $request, $id)
    {
        if (Handle::find($id)) {
            if (Handle::UpdateHandle($request, $id)) {
                Session::flash('msg', 'Handle has been updated successfully');
                if ( !empty($request->previous_page) ) { // if has previous page url, redirect to previous page
                    $redirect = $request->previous_page;
                } else {
                    $redirect = 'tickets/';
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
        if (Handle::find($id)) {
            if (Handle::DeleteHandle($id)) {
                Session::flash('msg', 'Handle has been deleted successfully.');
            } else {
                Session::flash('errMsg', 'Something went wrong, try again.');
            }
        } else {
            Session::flash('errMsg', 'Something went wrong, try again.');
        }

        return redirect(url()->previous());
    }


}
