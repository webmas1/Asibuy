<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\FiltersRequest;
use App\User;
use App\Customer;
use App\Ticket;
use Carbon\Carbon;
use Session;
use Validator;


class CustomersController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FiltersRequest $request)
    {
        self::$data['title'] .= 'Customers'; // add to broswer card title
        self::$data['headline'] = 'customers'; // page headline

        if ($request->has('created_at')) { // if filter by created at

            $created_at = $request->created_at;

            switch($created_at) { // query editing by value
                case 'week': // this week
                    $customers = Customer::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->latest()->paginate(10)->appends('created_at', $created_at);
                    break;
                case 'month': // this month
                    $customers = Customer::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->latest()->paginate(10)->appends('created_at', $created_at);
                    break;
                case 'year': // this year
                    $customers = Customer::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->latest()->paginate(10)->appends('created_at', $created_at);
                    break;
                default:
                $customers = Customer::GetCustomers();
            }

        } else if ($request->has('updated_at')) { // if filter by updated at

            $updated_at = $request->updated_at;

            switch($updated_at) { // query editing by value
                case 'week': // this week
                    $customers = Customer::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->latest()->paginate(10)->appends('updated_at', $updated_at);
                    break;
                case 'month': // this month
                    $customers = Customer::whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->latest()->paginate(10)->appends('updated_at', $updated_at);
                    break;
                case 'year': // this year
                    $customers = Customer::whereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->latest()->paginate(10)->appends('updated_at', $updated_at);
                    break;
                default:
                $customers = Customer::GetCustomers();
            }

        } else {
            $customers = Customer::GetCustomers();
        }

        if ( !empty($customers[0]) ) {
            self::$data['customers'] = $customers;
        }

        return view('content.customers', self::$data);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::$data['title'] .= 'Customers - New Customer'; // add to broswer card title
        self::$data['headline'] = 'customers - new customer'; // page headline
        self::$data['previous_page'] = url()->previous(); // previous page url

        return view('content.newCustomer', self::$data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewCustomerRequest $request)
    {
        if (Customer::NewCustomer($request)) {
            Session::flash('msg', 'Customer has been added successfully');
            if ( !empty($request->previous_page) ) { // if has previous page url, redirect to previous page
                $redirect = $request->previous_page;
            } else {
                $redirect = 'customers/';
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
        self::$data['previous_page'] = url()->previous(); // previous page url

        if (Customer::find($id)) {
            self::$data['customer'] = Customer::find($id);
            self::$data['users'] = User::all();
            self::$data['title'] .= 'Customers - Customer File'; // add to broswer card title
            self::$data['headline'] = 'customers - customer file'; // page headline
            return view('content.customerFile', self::$data);
        } else {
            Session::flash('errMsg', 'Customer does not exists');
            return redirect(url()->previous()); // redirect to previous page
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
        self::$data['previous_page'] = url()->previous(); // previous page url

        if (Customer::find($id)) {
            self::$data['customer'] = Customer::find($id);
            self::$data['title'] .= 'Customers - Edit Customer'; // add to broswer card title
            self::$data['headline'] = 'customers - edit customer'; // page headline
            return view('content.editCustomer', self::$data);
        } else {
            Session::flash('errMsg', 'Customer does not exists');
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
    public function update(UpdateCustomerRequest $request, $id)
    {
        if (Customer::find($id)) {
            if (Customer::UpdateCustomer($request, $id)) {
                Session::flash('msg', 'Customer has been updated successfully');
                if ( !empty($request->previous_page) ) { // if has previous page url, redirect to previous page
                    $redirect = $request->previous_page;
                } else {
                    $redirect = 'customers/';
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
        return redirect(url()->previous());
    }



    // Search customers //

    public function searchCustomers(Request $request) {

        $validator = Validator::make($request->all(), [ // validates values
            'first_name' => 'nullable|alpha|min:2|max:20',
            'last_name' => 'nullable|alpha|min:2|max:20',
            'phone' => [
                "nullable",
                "regex:/^\(?([0-9]{3})\)?[- ]?([0-9]{7})$|^\(?([0-9]{2})\)?[- ]?([0-9]{7})$/"
            ],
            'id_number' => 'nullable|digits:9|integer'
        ]);

        if ($validator->passes()) { // if validated

            $query = Customer::query();
            $data = $request->except('_token'); // all values but token
            $data_empty = true;

            foreach ($data as $key => $value) {
                if ($data[$key] != null) { // if there is any value from request - add them to query
                    $query->where($key, $value);
                    $data_empty = false;
                }
            }

            if (!$data_empty) { // if there is any value

                $customers = $query->get();

                if (empty($customers[0])) { // if has not found any customer
                    return response()->json(['empty'=>'No customer has found, please try again']);
                } else { // if has found a customer
                    return response()->json(['customers'=>($customers)]);
                }
            } else { // if there is no value
                return response()->json(['empty'=>'Fields are empty, please try again...']);
            }

        } else { // if there is validation errors
            return response()->json(['error'=>$validator->errors()->all()]);
        }

    }

}
