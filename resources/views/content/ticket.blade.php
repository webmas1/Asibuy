@extends('master')


@section('content')


<div class="d-flex flex-fill flex-column">

    <!-- buttons -->
    <div class="my-3">
        <div class="d-flex justify-content-end flex-wrap">

            <!-- change status -->
            <a class="btn {{ ($ticket->status == '0') ? 'btn-success' : 'btn-warning' }} btn-sm rounded-pill text-capitalize mr-2 my-1 text-center text-nowrap" href="{{url('ticket/'.$ticket->id.'/changeStatus')}}">{!! ($ticket->status == '0') ? '<span data-feather="book-open"></span> open ticket back' : '<span data-feather="x-circle"></span> close ticket' !!}</a>

            <!-- edit -->
            <a class="btn btn-dark btn-sm rounded-pill text-capitalize mr-2 my-1 text-nowrap" href="{{ url('tickets/'.$ticket->id.'/edit') }}"><span data-feather="edit"></span> edit ticket</a>

            <!-- delete -->
            <form class="delete-form d-inline text-nowrap mr-2" action="{{ url('tickets/'.$ticket->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm rounded-pill text-capitalize my-1 w-100" title="Delete">
                    <span data-feather="trash"></span> delete ticket
                </button>
            </form>

        </div>
    </div>

    <!-- Ticket card -->
    <div class="card my-3">

        <!-- Header -->
        <div class="card-header">
            <div class="row">
                <div class="col-12">

                    <div class="d-flex justify-content-between text-capitalize">

                        <!-- Customer -->
                        <div>
                            <p class="font-size-14 text-secondary text-nowrap mr-5">
                                <a href="{{url('customers/'.$ticket->customer->id)}}">
                                    <span data-feather="user"></span> {{ $ticket->customer->first_name . ' ' . $ticket->customer->last_name }}
                                </a>
                            </p>
                        </div>

                        <!-- Created & User -->
                        <div>
                            <p class="font-size-12">
                                {{ \Carbon\Carbon::parse($ticket->created_at)->diffForHumans() }} · <span
                                    class="text-secondary font-size-10">Updated
                                    {{ \Carbon\Carbon::parse($ticket->updated_at)->diffForHumans() }}</span><br>by
                                {{ $ticket->user->first_name . ' ' . $ticket->user->last_name }}</p>
                        </div>

                    </div>

                    <!-- Subject -->
                    <h3 class="card-title text-capitalize mb-0">{{ $ticket->subject }} <sup><span class="badge badge-danger font-size-12">{{ ($ticket->status == '0') ? 'closed' : '' }}</span></sup></h3>

                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="card-body">

            <div class="row">

                <!-- the ticket -->
                <div class="col-12">
                    {!! $ticket->ticket !!}
                </div>

            </div>

        </div>

    </div>


    <!-- if there is any handles -->
    @if ( $ticket->handles->count() )

    <!-- headline -->
    <h5 class="text-capitalize my-3">ticket handlings</h5>

    <div class="accordion mb-3" id="ticketHandlings">

        <!-- list each handle -->
        @foreach ($ticket->handles as $handle)

        <div class="card invisible-line">

            <!-- header -->
            <div class="card-header d-flex justify-content-between align-items-center" id="ticketHandlingHeading{{ $handle->id }}" data-toggle="collapse" data-target="#ticketHandling{{ $handle->id }}"
                        aria-expanded="true" aria-controls="ticketHandling{{ $handle->id }}">

                <!-- headline -->
                <h6 class="col-8 col-lg-10 pl-0 mb-0">{{ $handle->headline }}</h6>

                <!-- created at -->
                <p class="col-4 col-lg-2 text-capitalize font-size-12 mb-0">{{ \Carbon\Carbon::parse($handle->created_at)->diffForHumans() }} · <span class="text-secondary font-size-10">updated {{ \Carbon\Carbon::parse($handle->updated_at)->diffForHumans() }}</span> by {{ $handle->user->first_name . ' ' . $handle->user->last_name }}</p>

            </div>

            <!-- body -->
            <div id="ticketHandling{{ $handle->id }}" class="collapse" aria-labelledby="ticketHandlingHeading{{ $handle->id }}"
                data-parent="#ticketHandling{{ $handle->id }}" collapsed>
                <div class="card-body d-flex justify-content-between">

                    <!-- the handle -->
                    <div>
                    {!! $handle->handle !!}
                    </div>

                    <!-- buttons -->
                    <div class="invisible-btns invisible-lg text-nowrap">

                        <!-- edit -->
                        <a class="btn btn-link" href="{{ url('handles/'.$handle->id.'/edit') }}"><span data-feather="edit"></span></a>

                        <!-- delete -->
                        <form class="delete-form d-inline" action="{{ url('handles/'.$handle->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link p-0" title="Delete">
                                <span data-feather="trash"></span>
                            </button>
                        </form>

                    </div>

                </div>
            </div>

        </div>

        @endforeach

    </div>

    @endif

    <!-- Handle ticket -->
    <div class="d-flex justify-content-end">
        <a class="btn btn-primary btn-sm rounded-pill text-capitalize my-1 text-nowrap {{ ($ticket->status == '0') ? 'disabled' : '' }}" href="{{ url('handles\create?ticket_id=' . $ticket->id) }}"><span data-feather="corner-up-right"></span> handle ticket</a>
    </div>

</div>



@endsection('content')
