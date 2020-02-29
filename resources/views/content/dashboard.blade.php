@extends('master')


@section('content')


<!-- Buttons -->
<div class="d-flex justify-content-end my-3 flex-wrap text-nowrap">
    <a class="btn btn-primary btn-sm rounded-pill text-capitalize mr-1 my-1" href="{{url('customers/create')}}"><span class="mr-1" data-feather="plus"></span>add customer</a>
    <a class="btn btn-primary btn-sm rounded-pill text-capitalize my-1" href="{{url('tickets/create')}}"><span class="mr-1" data-feather="plus"></span>open new ticket</a>
</div>

<div class="d-flex flex-fill flex-column">
    <div class="d-flex flex-md-row flex-column mb-3">

        <!-- Search Customers card -->
        <div class="card mr-md-3 mb-3 mb-md-0">
            <div class="card-body">

                <!-- Headline -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title card-headline text-capitalize">search for customers</h4>
                </div>

                <!-- Form -->
                <form id="searchCustomers" class="my-3">
                @csrf

                    <!-- page name -->
                    <div class="mt-3 d-none">
                        <input name="page_name" id="pageName" type="text" value="dashboard" class="form-control"> <!-- hidden page name -->
                    </div>

                    <!-- customer id -->
                    <div class="mt-3 d-none">
                        <input name="customer_id" id="customerId" type="text" value="{{ old('customer_id') }}" class="form-control"> <!-- hidden id -->
                    </div>

                    <!-- first name -->
                    <div class="mt-3">
                        <label class="sr-only" for="firstName">First Name</label>
                        <input name="first_name" id="firstName" type="text" value="{{ old('first_name') }}" placeholder="First Name" class="form-control rounded-pill text-capitalize">
                    </div>

                    <!-- last name -->
                    <div class="mt-3">
                        <label class="sr-only" for="lastName">Last Name</label>
                        <input name="last_name" id="lastName" type="text" value="{{ old('last_name') }}" placeholder="Last Name" class="form-control rounded-pill text-capitalize">
                    </div>

                    <!-- phone -->
                    <div class="mt-3">
                        <label class="sr-only" for="phone">Phone</label>
                        <input name="phone" id="phone" type="text" value="{{ old('phone') }}" placeholder="Phone" class="form-control rounded-pill">
                    </div>

                    <!-- id number -->
                    <div class="mt-3">
                        <label class="sr-only" for="idNumber">Id Number</label>
                        <input name="id_number" id="idNumber" type="text" value="{{ old('id_number') }}" placeholder="Id Number" class="form-control rounded-pill">
                    </div>

                    <!-- errors -->
                    <div>
                        <p class="search-errors text-danger mt-5"></p>
                    </div>

                    <!-- search -->
                    <div class="mt-3">
                        <button id="searchButton" type="submit" class="btn btn-dark text-capitalize w-100 align-self-end form-control rounded-pill">search</button>
                    </div>

                    <!-- clear -->
                    <div class="mt-3">
                        <span id="clearCustomer" class="btn btn-secondary text-capitalize w-100 align-self-end rounded-pill">clear</span>
                    </div>

                </form>
            </div>
        </div>

        <!-- Recent Customers card -->
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">

                    <!-- headline -->
                    <h4 class="card-title card-headline text-capitalize">customers added recently</h4>

                    <!-- view all button -->
                    <a href={{ url('customers') }} class="btn btn-sm btn-outline-dark text-capitalize">view all</a>

                </div>

                <!-- if there is customers to show -->
                @if ( !empty ($customers) )

                <!-- Customers list -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-capitalize">
                                <th></th>
                                <th>first name</th>
                                <th>last name</th>
                                <th>id number</th>
                                <th><span data-feather="mail"></span> email</th>
                                <th><span data-feather="phone-outgoing"></span> phone</th>
                                <th>created</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- list each customer -->
                            @foreach ( $customers as $customer )

                            <tr>
                                <!-- view & edit -->
                                <td class="align-middle bg-light"><a class="btn btn-link p-1" href="{{ url('customers/'.$customer->id) }}"><span data-feather="eye"></span></a></td>

                                <!-- first name -->
                                <td class="text-capitalize align-middle">{{ $customer->first_name }}</td>

                                <!-- last name -->
                                <td class="text-capitalize align-middle">{{ $customer->last_name }}</td>

                                <!-- id number -->
                                <td class="align-middle">{{ $customer->id_number }}</td>

                                <!-- email -->
                                <td class="text-lowercase align-middle"><a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></td>

                                <!-- phone -->
                                <td class="align-middle"><a href="tel:{{ $customer->phone }}">{{ $customer->phone }}</a></td>

                                <!-- created -->
                                <td class="align-middle text-nowrap">{{ \Carbon\Carbon::parse($customer->created_at)->diffForHumans() }} <span class="text-secondary font-size-10">| Updated {{ \Carbon\Carbon::parse($customer->updated_at)->diffForHumans() }}</span></td>

                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>

                <!-- if there is NO customers to show -->
                @else

                <p>No new customers...</p>

                @endif

            </div>
        </div>

    </div>
</div>


<!-- Search results modal -->
<div class="modal fade customers-results" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-4">

        <!-- headline -->
        <div class="modal-header">
            <h5 class="modal-title text-capitalize">choose customer from results:</h5>
        </div>

        <!-- body -->
        <div class="modal-body">

            <!-- results list -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-capitalize">
                            <th>first name</th>
                            <th>last name</th>
                            <th>id number</th>
                            <th><span data-feather="mail"></span> email</th>
                            <th><span data-feather="phone-outgoing"></span> phone</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>

    </div>
  </div>
</div>
@endsection('content')
