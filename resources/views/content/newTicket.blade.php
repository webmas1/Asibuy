@extends('master')


@section('content')


<!-- Card -->
<div class="card flex-fill mb-3 pb-5">
    <div class="card-body">

        <!-- Headline -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="card-title card-headline text-capitalize">add new ticket</h4>
        </div>

        <!-- Body -->
        <div>

            <!-- Customer form -->
            <form id="searchCustomers">
            @csrf
                <div class="row bg-light pt-3 pb-4 pb-lg-3 border-bottom">

                    <!-- headline -->
                    <div class="col-12 d-flex justify-content-between align-items-center border-bottom pb-2">
                        <h6>Customer</h6>
                        <a class="btn btn-primary btn-sm rounded-pill text-capitalize" href="{{url('customers/create')}}"><span class="mr-1" data-feather="plus"></span>add new customer</a>
                    </div>

                    <!-- page name -->
                    <div class="mt-3 d-none">
                        <input name="page_name" id="pageName" type="text" value="new ticket" class="form-control"> <!-- hidden page name -->
                    </div>

                    <!-- first name -->
                    <div class="col-12 col-lg mt-3">
                        <label class="sr-only" for="firstName">First Name</label>
                        <input name="first_name" id="firstName" type="text" value="{{ (!empty ($customer)) ? $customer->first_name : old('first_name') }}" placeholder="First Name" class="form-control rounded-pill text-capitalize" {{ (!empty ($customer)) ? 'disabled' : '' }}>
                    </div>

                    <!-- last name -->
                    <div class="col-12 col-lg mt-3">
                        <label class="sr-only" for="lastName">Last Name</label>
                        <input name="last_name" id="lastName" type="text" value="{{ (!empty ($customer)) ? $customer->last_name : old('last_name') }}" placeholder="Last Name" class="form-control rounded-pill text-capitalize" {{ (!empty ($customer)) ? 'disabled' : '' }}>
                    </div>

                    <!-- phone -->
                    <div class="col-12 col-lg mt-3">
                        <label class="sr-only" for="phone">Phone</label>
                        <input name="phone" id="phone" type="text" value="{{ (!empty ($customer)) ? $customer->phone : old('phone') }}" placeholder="Phone" class="form-control rounded-pill" {{ (!empty ($customer)) ? 'disabled' : '' }}>
                    </div>

                    <!-- id number -->
                    <div class="col-12 col-lg mt-3">
                        <label class="sr-only" for="idNumber">Id Number</label>
                        <input name="id_number" id="idNumber" type="text" value="{{ (!empty ($customer)) ? $customer->id_number : old('id_number') }}" placeholder="Id Number" class="form-control rounded-pill" {{ (!empty ($customer)) ? 'disabled' : '' }}>
                    </div>

                    <!-- if no customer has been chosen first -->
                    @if ( empty ($customer) )

                    <!-- find -->
                    <div class="d-flex col-12 col-lg mt-3 order-10 order-lg-0">
                        <button id="findButton" type="submit" class="btn btn-dark text-capitalize w-100 align-self-end rounded-pill">find</button>
                    </div>

                    <!-- clear -->
                    <div class="d-flex col-12 col-lg mt-3 order-10 order-lg-0">
                        <span id="clearCustomer" class="btn btn-secondary text-capitalize w-100 align-self-end rounded-pill">clear</span>
                    </div>

                    @endif

                    <!-- errors -->
                    <div class="col-12">
                        <p class="search-errors text-danger mt-5"></p>
                        <p class="text-danger mb-0 mt-n3">
                            @error('customer_id')
                            You need to find a customer first
                            @enderror
                        </p>
                    </div>

                </div>
            </form>

            <!-- Ticket form -->
            <form method="POST" action="{{ url('tickets') }}">
            @csrf

                <!-- previous page -->
                <input name="previous_page" id="previous_page" type="hidden" value="{{ $previous_page }}">

                <!-- customer id -->
                <div class="col-12 col-lg-2 mt-3 d-none">
                    <input name="customer_id" id="customerId" type="text" value="{{ (!empty ($customer)) ? $customer->id : old('customer_id') }}" class="form-control"> <!-- hidden id -->
                </div>

                <div class="row">

                    <!-- subject -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="subject">Subject</label>
                        <input name="subject" id="subject" type="text" value="{{ old('subject') }}" required class="form-control rounded-pill">
                        <p class="text-danger mb-0">
                            @error('subject')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <!-- the ticket -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="summernote">The Ticket</label>
                        <textarea id="summernote" class="form-control" name="ticket">{{ old('ticket') }}</textarea>
                        <p class="text-danger mb-0">
                            @error('ticket')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>

                <!-- submit -->
                <div class="row">
                    <div class="col-12 col-lg-4 mt-5 mt-lg-3 align-self-end">
                        <button name="submit" class="btn btn-primary w-100 rounded-pill" type="submit">Save Ticket</button>
                    </div>
                </div>

            </form>

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
                <table class="table table-striped table-hover">
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
