@extends('master')


@section('content')


<!-- Card -->
<div class="card flex-fill mb-3 pb-5">
    <div class="card-body">

        <!-- Headline -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="card-title card-headline text-capitalize">add new handle</h4>
        </div>

        <!-- Body -->
        <div>

            <!-- Form -->
            <form method="POST" action="{{ url('handles') }}">
                @csrf

                <!-- previous page -->
                <input name="previous_page" id="previous_page" type="hidden" value="{{ $previous_page }}">

                <!-- ticket id -->
                <div class="col-12 col-lg-2 mt-3 d-none">
                    <input name="ticket_id" id="ticketId" type="text" value="{{ (!empty ($ticket)) ? $ticket->id : old('ticket_id') }}" class="form-control"> <!-- hidden id -->
                </div>
                <p class="text-danger mb-0">
                    @error('ticket_id')
                    {{ $message }} Please try again.
                    @enderror
                </p>

                <div class="row">

                    <!-- headline -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="headline">Headline</label>
                        <input name="headline" id="headline" type="text" value="{{ old('headline') }}" required class="form-control rounded-pill">
                        <p class="text-danger mb-0">
                            @error('headline')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <!-- the handle -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="summernote">The Handle</label>
                        <textarea id="summernote" class="form-control" name="handle">{{ old('handle') }}</textarea>
                        <p class="text-danger mb-0">
                            @error('handle')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                </div>

                <!-- submit -->
                <div class="row">
                    <div class="col-12 col-lg-4 mt-5 mt-lg-3 align-self-end">
                        <button name="submit" class="btn btn-primary w-100 rounded-pill" type="submit">Save Handle</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>


@endsection('content')
