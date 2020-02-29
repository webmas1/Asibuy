@extends('master')


@section('content')


<!-- New ticket -->
<div class="d-flex justify-content-center justify-content-sm-end my-3">
    <a class="btn btn-primary btn-sm rounded-pill text-capitalize" href="{{url('tickets/create')}}"><span class="mr-1" data-feather="plus"></span>open new ticket</a>
</div>

<div class="d-flex flex-column flex-fill">

    <!-- Card -->
    <div class="card my-3">

        <!-- Filters -->
        <div class="card-header">
            <div class="form-inline justify-content-center justify-content-sm-end">

                <!-- status -->
                <select name="status_filter" class="table-filter form-control form-control-sm my-1 my-sm-0">
                    <option selected disabled>Status</option>
                    <option value="closed">Closed</option>
                    <option value="open">Open</option>
                </select>

                <!-- created at -->
                <select name="created_at" class="table-filter form-control form-control-sm ml-sm-1 my-1 my-sm-0">
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

                <!-- reset -->
                <a class="btn btn-sm btn-outline-secondary ml-sm-3 my-2 my-sm-0" href="{{ url()->current() }}">reset filters</a>

            </div>
        </div>

        <!-- if there is tickets -->
        @if( !empty ($tickets) )

        <!-- list each ticket -->
        @foreach ( $tickets as $ticket )

        <div class="card-body invisible-line">
            <div class="row">

                <div class="col-12 col-md-8">

                    <!-- subject -->
                    <p class="mb-1"><a href="{{url('tickets/'.$ticket->id)}}">{{ $ticket->subject }}</a> <span class="badge badge-danger">{{ ($ticket->status == '0') ? 'closed' : '' }}</span> <span class="badge badge-success">{{ (\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($ticket->created_at))) < 3 ? 'new' : '' }}</span></p>

                    <!-- customer -->
                    <p class="text-secondary font-size-10"><span class="text-capitalize font-weight-bold">{{ $ticket->customer->first_name . ' ' . $ticket->customer->last_name }}</span> · Opend {{ \Carbon\Carbon::parse($ticket->created_at)->diffForHumans() }}</p>

                </div>

                <div class="col-12 col-md-4">
                    <div class="row">

                        <!-- buttons (invisible) -->
                        <div class="col-4 invisible-btns invisible-lg text-nowrap">

                            <!-- edit -->
                            <a class="btn btn-link" href="{{ url('tickets/'.$ticket->id.'/edit') }}"><span data-feather="edit"></span></a>

                            <!-- delete -->
                            <form class="delete-form d-inline" action="{{ url('tickets/'.$ticket->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-0" title="Delete">
                                    <span data-feather="trash"></span>
                                </button>
                            </form>

                        </div>

                        <div class="col-8">

                            <!-- updated at -->
                            <p class="text-capitalize font-size-12 mb-1">updated {{ \Carbon\Carbon::parse($ticket->updated_at)->diffForHumans() }}</p>

                            <!-- user -->
                            <p class="text-capitalize font-size-10">by {{ $ticket->user->first_name . ' ' . $ticket->user->last_name }}</p>

                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- seperating line -->
        <hr class="my-1">

        @endforeach

        <!-- paginating links -->
        <div class="mx-4">
        {{ $tickets->links() }}
        </div>

        <!-- if there is no tickets -->
        @else
        <div class="card-body">
           <p>No tickets available...</p>
        </div>

        @endif

    </div>

</div>



@endsection('content')
