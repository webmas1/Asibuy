<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Requests\FiltersRequest;
use App\User;
use App\Customer;
use App\Ticket;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Str;


class TicketsController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FiltersRequest $request)
    {
        self::$data['title'] .= 'Tickets'; // add to broswer card title
        self::$data['headline'] = 'Tickets'; // page headline

        if ($request->has('created_at')) { // if filter by created at

            $created_at = $request->created_at;

            switch($created_at) { // query editing by value
                case 'week': // this week
                    $tickets = Ticket::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->latest()->paginate(5)->appends('created_at', $created_at);
                    break;
                case 'month': // this month
                    $tickets = Ticket::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->latest()->paginate(5)->appends('created_at', $created_at);
                    break;
                case 'year': // this year
                    $tickets = Ticket::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->latest()->paginate(5)->appends('created_at', $created_at);
                    break;
                default:
                $tickets = Ticket::GetTickets();
            }

        } else if ($request->has('updated_at')) { // if filter by updated at

            $updated_at = $request->updated_at;

            switch($updated_at) { // query editing by value
                case 'week': // this week
                    $tickets = Ticket::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->latest()->paginate(5)->appends('updated_at', $updated_at);
                    break;
                case 'month': // this month
                    $tickets = Ticket::whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->latest()->paginate(5)->appends('updated_at', $updated_at);
                    break;
                case 'year': // this year
                    $tickets = Ticket::whereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->latest()->paginate(5)->appends('updated_at', $updated_at);
                    break;
                default:
                $tickets = Ticket::GetTickets();
            }

        } else if ($request->has('status')) { // if filter by status

            $status_filter = $request->status;

            switch($status_filter) { // query editing by value
                case 'closed':
                    $tickets = Ticket::where('status', '0')->latest()->paginate(10)->appends('status', $status_filter);
                    break;
                case 'open':
                    $tickets = Ticket::where('status', '1')->latest()->paginate(10)->appends('status', $status_filter);
                break;
                default:
                $tickets = Ticket::GetTickets();
            }

        } else {
            $tickets = Ticket::GetTickets();
        }

        if (!empty($tickets[0])){
            self::$data['tickets'] = $tickets;
        }

        return view('content.tickets', self::$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->has('customer_id')) { // if opened from customer file - put customer data in

            $customer_id = $request->customer_id;

            if (Customer::find($customer_id)) {
                self::$data['customer'] = Customer::find($customer_id);
            }
        }

        self::$data['title'] .= 'Tickets - New Ticket'; // add to broswer card title
        self::$data['headline'] = 'tickets - new ticket'; // page headline
        self::$data['previous_page'] = url()->previous(); // previous page url

        return view('content.newTicket', self::$data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewTicketRequest $request)
    {
        if (Ticket::NewTicket($request)) {
            Session::flash('msg', 'Ticket has been added successfully');
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
        if (Ticket::find($id)) {
            self::$data['ticket'] = Ticket::find($id);
            self::$data['title'] .= 'Tickets - Ticket #' . $id; // add to broswer card title
            self::$data['headline'] = 'Ticket Details'; // page headline
            return view('content.ticket', self::$data);
        } else {
            Session::flash('errMsg', 'Ticket does not exists');

            return redirect(url()->previous());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Ticket::find($id)) {
            self::$data['ticket'] = Ticket::find($id);
            self::$data['title'] .= 'Tickets - Edit Ticket'; // add to broswer card title
            self::$data['headline'] = 'tickets - edit ticket'; // page headline
            self::$data['previous_page'] = url()->previous(); // previous page url

            return view('content.editTicket', self::$data);
        } else {
            Session::flash('errMsg', 'Ticket does not exists');
            return redirect(url()->previous()); // redirect to previous page
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, $id)
    {
        if (Ticket::find($id)) {
            if (Ticket::UpdateTicket($request, $id)) {
                Session::flash('msg', 'Ticket has been updated successfully');
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
        if (Ticket::find($id)) {
            if (Ticket::DeleteTicket($id)) {
                Session::flash('msg', 'Ticket has been deleted successfully.');
                if (Str::contains((url()->previous()), 'tickets')) {
                    $redirect = 'tickets';
                } else {
                    $redirect = url()->previous();
                }
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
        if (Ticket::find($id)) {
            if (Ticket::changeStatus($id)) {
                Session::flash('msg', 'Status has been changed successfully');
            } else {
                Session::flash('errMsg', 'Something went wrong, try again.');
            }

        } else {
            Session::flash('errMsg', 'Something went wrong, try again.');
        }

        return redirect(url()->previous());
    }

}
