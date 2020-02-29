@extends('master')


@section('content')


<!-- Card -->
<div class="card col-12 col-lg-6 col-xl-4 mb-3 pb-5 mx-auto">
    <div class="card-body">

        <!-- Headline -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="card-title card-headline text-capitalize">edit customer details</h4>
        </div>

        <!-- Body -->
        <div>

            <!-- Form -->
            <form method="POST" action="{{url('customers/'.$customer['id'])}}">
                @csrf
                @method('PUT')

                <!-- previous page -->
                <input name="previous_page" id="previous_page" type="hidden" value="{{ $previous_page }}">

                <div class="row">

                    <!-- first name -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="firstName">First Name</label>
                        <input name="first_name" id="firstName" type="text" required value="{{ $customer['first_name'] }}" class="form-control rounded-pill text-capitalize">
                        <p class="text-danger mb-0">
                            @error('first_name')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <!-- last name -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="lastName">Last Name</label>
                        <input name="last_name" id="lastName" type="text" required value="{{ $customer['last_name'] }}" class="form-control rounded-pill text-capitalize">
                        <p class="text-danger mb-0">
                            @error('last_name')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <!-- id number -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="idNumber">Id Number</label>
                        <input name="id_number" id="idNumber" type="text" required value="{{ $customer['id_number'] }}" class="form-control rounded-pill">
                        <p class="text-danger mb-0">
                            @error('id_number')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <!-- email address -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="email">Email Address</label>
                        <input name="email" id="email" type="email" value="{{ $customer['email'] }}" readonly class="form-control rounded-pill">
                    </div>

                    <!-- phone -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="phone">Phone</label>
                        <input name="phone" id="phone" type="text" required value="{{ $customer['phone'] }}" class="form-control rounded-pill">
                        <p class="text-danger mb-0">
                            @error('phone')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <!-- submit -->
                    <div class="col-12 mt-5">
                        <button name="submit" class="btn btn-primary w-100 rounded-pill" type="submit"><span
                                data-feather="save"></span> Save</button>
                    </div>

                </div>

            </form>

        </div>

    </div>
</div>

@endsection('content')
