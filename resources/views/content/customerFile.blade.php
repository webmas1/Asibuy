@extends('master')


@section('content')


<div class="d-flex flex-fill flex-column">

    <div class="d-flex flex-column flex-xl-row mb-3">

        <!-- Contact Info card -->
        <div class="card flex-shrink-0 mr-xl-3 mb-3 mb-xl-0 pb-xl-5">
            <div class="card-body">

                <!-- Headline -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title card-headline text-capitalize">contact info</h4>
                </div>

                <!-- Body -->
                <div class="d-flex flex-column flex-sm-row flex-xl-column">

                    <!-- name -->
                    <h5 class="text-capitalize mr-3 mr-xl-0 mb-4">
                        <strong>{{ $customer->first_name . ' ' . $customer->last_name }}</strong>
                    </h5>

                    <!-- phone -->
                    <p class="text-capitalize mr-3 mr-xl-0">
                        <span data-feather="mail"></span> <a
                            href="tel:{{ $customer->phone }}"><strong>{{ $customer->phone }}</strong></a>
                    </p>

                    <!-- email -->
                    <p>
                        <span data-feather="phone-outgoing"></span> <a
                            href="mailto:{{ $customer->email }}"><strong>{{ $customer->email }}</strong></a>
                    </p>

                    <!-- edit -->
                    <div class="d-flex justify-content-end flex-wrap mt-4">
                        <a class="btn btn-dark btn-sm rounded-pill text-capitalize mr-2 my-1 text-nowrap"
                            href="{{ url('customers/'.$customer->id.'/edit') }}"><span data-feather="edit"></span> edit</a>
                    </div>

                </div>

            </div>
        </div>

        <!-- Tickets card -->
        <div class="card flex-fill pb-xl-5">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">

                    <!-- Headline -->
                    <h4 class="card-title card-headline text-capitalize">tickets</h4>

                    <!-- Open new ticket -->
                    <a class="btn btn-primary btn-sm rounded-pill text-capitalize ml-2"
                        href="{{url('tickets/create?customer_id='.$customer->id) }}"><span class="mr-1"
                            data-feather="plus"></span>open new ticket</a>

                </div>

                <!-- if customer have tickets -->
                @if( $customer->tickets->count() )

                <!-- Body -->
                <div class="d-flex flex-column flex-fill">

                    <div class="card my-3">

                        <!-- Filters -->
                        <div class="card-header">
                            <div class="form-inline justify-content-center justify-content-sm-end">

                                <!-- created at -->
                                <select name="created_at"
                                    class="table-filter form-control form-control-sm my-1 my-sm-0">
                                    <option selected disabled>Created At</option>
                                    <option value="week">This Week</option>
                                    <option value="month">This Month</option>
                                    <option value="year">This Year</option>
                                </select>

                                <!-- updated at -->
                                <select name="updated_at"
                                    class="table-filter form-control form-control-sm ml-sm-1 my-1 my-sm-0">
                                    <option selected disabled>Updated At</option>
                                    <option value="week">This Week</option>
                                    <option value="month">This Month</option>
                                    <option value="year">This Year</option>
                                </select>

                                <!-- reset -->
                                <a class="btn btn-sm btn-outline-secondary ml-sm-3 my-2 my-sm-0"
                                    href="{{ url()->current() }}">reset filters</a>

                            </div>
                        </div>

                        <!-- list each ticket -->
                        @foreach ( $customer->tickets as $ticket )

                        <div class="card-body invisible-line">
                            <div class="row">

                                <!-- ticket details -->
                                <div class="col-12 col-md-8">
                                    <p class="mb-1">

                                        <!-- subject -->
                                        <a href="{{url('tickets/'.$ticket->id)}}">{{ $ticket->subject }}</a>

                                        <!-- status -->
                                        <span
                                            class="badge badge-danger">{{ ($ticket->status == '0') ? 'closed' : '' }}</span>

                                        <!-- if new -->
                                        <span
                                            class="badge badge-success">{{ (\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($ticket->created_at))) < 3 ? 'new' : '' }}</span>

                                    </p>

                                    <!-- created at -->
                                    <p class="text-secondary font-size-10">Opend
                                        {{ \Carbon\Carbon::parse($ticket->created_at)->diffForHumans() }}</p>
                                </div>

                                <!-- more ticket details -->
                                <div class="col-12 col-md-4">
                                    <div class="row">

                                        <!-- edit/delete (invisible) -->
                                        <div class="col-4 invisible-btns invisible-lg text-nowrap">

                                            <!-- edit -->
                                            <a class="btn btn-link"
                                                href="{{ url('tickets/'.$ticket->id.'/edit') }}"><span
                                                    data-feather="edit"></span></a>

                                            <!-- delete -->
                                            <form class="delete-form d-inline"
                                                action="{{ url('tickets/'.$ticket->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0" title="Delete">
                                                    <span data-feather="trash"></span>
                                                </button>
                                            </form>

                                        </div>

                                        <!-- updated at & user -->
                                        <div class="col-8">

                                            <!-- updated at -->
                                            <p class="text-capitalize font-size-12 mb-1">updated
                                                {{ \Carbon\Carbon::parse($ticket->updated_at)->diffForHumans() }}</p>

                                            <!-- user -->
                                            <p class="text-capitalize font-size-10">by
                                                {{ $ticket->user->first_name . ' ' . $ticket->user->last_name }}</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- seperating line -->
                        <hr class="my-1">

                        @endforeach

                    </div>


                </div>

                <!-- if customer doesn't have tickets -->
                @else

                <p>Customer has no open tickets...</p>

                @endif

            </div>
        </div>

    </div>

</div>





@endsection('content')
