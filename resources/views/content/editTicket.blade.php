@extends('master')


@section('content')


<!-- Card -->
<div class="card flex-fill mb-3 pb-5">
    <div class="card-body">

        <!-- Headline -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="card-title card-headline text-capitalize">edit ticket</h4>
        </div>

        <!-- Body -->
        <div>

            <!-- Form -->
            <form method="POST" action="{{url('tickets/'.$ticket->id)}}">
                @csrf
                @method('PUT')

                <!-- previous page -->
                <input name="previous_page" id="previous_page" type="hidden" value="{{ $previous_page }}">

                <!-- Customer -->
                <div class="row bg-light py-3 border-bottom">

                    <!-- headline -->
                    <div class="col-12">
                        <h6 class="pb-1 border-bottom">Customer</h6>
                    </div>

                    <!-- first name -->
                    <div class="col-12 col-lg-3 mt-3">
                        <label for="firstName">First Name</label>
                        <input name="first_name" id="firstName" type="text" value="{{ $ticket->customer->first_name }}" class="form-control rounded-pill text-capitalize" disabled>
                    </div>

                    <!-- last name -->
                    <div class="col-12 col-lg-3 mt-3">
                        <label for="lastName">Last Name</label>
                        <input name="last_name" id="lastName" type="text" value="{{ $ticket->customer->last_name }}" class="form-control rounded-pill text-capitalize" disabled>
                    </div>

                    <!-- phone -->
                    <div class="col-12 col-lg-3 mt-3">
                        <label for="phone">Phone</label>
                        <input name="phone" id="phone" type="text" value="{{ $ticket->customer->phone }}" class="form-control rounded-pill" disabled>
                    </div>

                    <!-- id number -->
                    <div class="col-12 col-lg-3 mt-3">
                        <label for="idNumber">Id Number</label>
                        <input name="id_number" id="idNumber" type="text" value="{{ $ticket->customer->id_number }}" class="form-control rounded-pill" disabled>
                    </div>

                </div>

                <div class="row">

                    <!-- subject -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="subject">Subject</label>
                        <input name="subject" id="subject" type="text" value="{{ $ticket->subject }}" required class="form-control rounded-pill">
                        <p class="text-danger mb-0">
                            @error('subject')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <!-- the ticket -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="summernote">The Ticket</label>
                        <textarea id="summernote" class="form-control" name="ticket">{{ $ticket->ticket }}</textarea>
                        <p class="text-danger mb-0">
                            @error('ticket')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                </div>

                <div class="row">

                    <!-- submit -->
                    <div class="col-12 col-lg-4 mt-5 mt-lg-3 align-self-end">
                        <button name="submit" class="btn btn-primary w-100 rounded-pill" type="submit">Save Ticket</button>
                    </div>

                </div>

            </form>
        </div>

    </div>
</div>

@endsection('content')
