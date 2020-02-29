@extends('master')


@section('content')


<!-- Card -->
<div class="card flex-fill mb-3 pb-5">
    <div class="card-body">

        <!-- Headline -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="card-title card-headline text-capitalize">edit handle</h4>
        </div>

        <!-- Body -->
        <div>

            <!-- Form -->
            <form method="POST" action="{{url('handles/'.$handle->id)}}">
                @csrf
                @method('PUT')

                <!-- previous page -->
                <input name="previous_page" id="previous_page" type="hidden" value="{{ $previous_page }}">

                <div class="row">

                    <!-- headline -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="headline">Headline</label>
                        <input name="headline" id="headline" type="text" value="{{ $handle->headline }}" required class="form-control rounded-pill">
                        <p class="text-danger mb-0">
                            @error('headline')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <!-- the handle -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="summernote">The Handle</label>
                        <textarea id="summernote" class="form-control" name="handle">{{ $handle->handle }}</textarea>
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
