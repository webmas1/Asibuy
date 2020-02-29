@extends('master')


@section('content')

<!-- Add Customer button -->
<div class="d-flex justify-content-center justify-content-sm-end my-3">
    <a class="btn btn-primary btn-sm rounded-pill text-capitalize" href="{{url('customers/create')}}"><span class="mr-1" data-feather="plus"></span>add customer</a>
</div>

<!-- Card -->
<div class="card flex-fill mb-3">
    <div class="card-body">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-3">

            <!-- Headline -->
            <h4 class="card-title flex-shrink-0 card-headline text-capitalize mr-sm-4">all customers</h4>

            <!-- Filters -->
            <div class="form-inline justify-content-center justify-content-sm-end">

                <!-- created at -->
                <select name="created_at" class="table-filter form-control form-control-sm my-1 my-sm-0">
                    <option selected disabled>Created At</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                    <option value="year">This Year</option>
                </select>

                <!-- updated at -->
                <select name="updated_at" class="table-filter form-control form-control-sm ml-sm-1 my-1 my-sm-0">
                    <option selected disabled>Updated At</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                    <option value="year">This Year</option>
                </select>

                <!-- reset button -->
                <a class="btn btn-sm btn-outline-secondary ml-sm-3 my-2 my-sm-0" href="{{ url()->current() }}">reset filters</a>

            </div>
        </div>

        <!-- if there is customers to show -->
        @if( !empty ($customers) )

        <!-- Customers list -->
        <div class="table-responsive">
            <table id="customersTable" class="table table-hover">
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
                    @foreach ($customers as $customer)
                    <tr>
                        <!-- view or edit -->
                        <td class="align-middle bg-light">
                            <a class="btn btn-link p-1" href="{{ url('customers/'.$customer->id) }}"><span data-feather="eye"></span></a>
                            <a class="btn btn-link p-1" href="{{ url('customers/'.$customer->id.'/edit') }}"><span data-feather="edit"></span></a>
                        </td>

                        <!-- first name -->
                        <td class="text-capitalize align-middle">{{ $customer->first_name }}</td>

                        <!-- last name -->
                        <td class="text-capitalize align-middle">{{ $customer->last_name }}</td>

                        <!-- id number -->
                        <td class="align-middle">{{ $customer->id_number }}</td>

                        <!-- email -->
                        <td class="text-lowercase align-middle"><a href="mailto:{{ $customer->email}}">{{ $customer->email }}</a></td>

                        <!-- phone -->
                        <td class="align-middle"><a href="tel:{{ $customer->phone }}">{{ $customer->phone }}</a></td>

                        <!-- created & updated -->
                        <td class="align-middle text-nowrap">{{ \Carbon\Carbon::parse($customer->created_at)->diffForHumans() }} <span class="text-secondary font-size-10">| Updated {{ \Carbon\Carbon::parse($customer->updated_at)->diffForHumans() }}</span></td>

                    </tr>
                    @endforeach

                </tbody>
            </table>

            <!-- paginate links -->
            <div class="mt-5">
            {{ $customers->links() }}
            </div>

        </div>


        <!-- if there is NO customers to show -->
        @else

        <p>No results...</p>

        @endif
    </div>
</div>

@endsection('content')
