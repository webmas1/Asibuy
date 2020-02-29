@extends('master')


@section('content')


<!-- Card -->
<div class="col-12 col-sm-7 col-md-5 col-xl-4 card text-center my-2 my-lg-5 p-3 p-lg-5">
    <div class="card-body">

        <!-- Headlines -->
        <h2 class="card-title card-headline font-size-30 font-weight-normal">Welcome back</h2>
        <h3 class="text-secondary h6">Please sign in to your account below</h3>

        <!-- Form -->
        <form class="signin-form mt-5" method="POST" action="{{url('user/signin')}}">
            @csrf

            <!-- previous page -->
            <input name="previous_page" id="previous_page" type="hidden" value="{{ $previous_page }}">

            <!-- email -->
            <div class="position-relative form-group row">
                <label class="font-weight-bold" for="email">Email Address</label>
                <input name="email" id="email" value="" type="email" class="form-control rounded-pill">
                <p class="text-danger mb-0">
                @error('email')
                {{ $message }}
                @enderror
                </p>
            </div>

            <!-- password -->
            <div class="position-relative form-group row">
                <label class="font-weight-bold" for="password">Password</label>
                <input name="password" id="password" type="password" class="form-control rounded-pill">
                <p class="text-danger mb-0">
                @error('password')
                {{ $message }}
                @enderror
                </p>
            </div>

            <!-- submit -->
            <div class="form-group row mt-5">
                <button name="submit" class="btn btn-primary w-100 mt-1 rounded-pill" type="submit"><span
                        data-feather="log-in"></span> Login</button>
            </div>

        </form>

    </div>
</div>

@endsection('content')
