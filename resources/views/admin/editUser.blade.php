@extends('master')


@section('content')


<!-- Card -->
<div class="card col-12 col-lg-6 col-xl-4 mb-3 pb-5 mx-auto">
    <div class="card-body">

        <!-- Headline -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="card-title card-headline text-capitalize">edit user details</h4>
        </div>

        <!-- Body -->
        <div>

            <!-- Form -->
            <form method="POST" action="{{url('admin/users/'.$user->id)}}">
                @csrf
                @method('PUT')
                <div class="row">

                    <!-- First Name -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="firstName">First Name</label>
                        <input name="first_name" id="firstName" type="text" required value="{{ $user->first_name }}" class="form-control rounded-pill">
                        <p class="text-danger mb-0">
                            @error('first_name')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <!-- Last Name -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="lastName">Last Name</label>
                        <input name="last_name" id="lastName" type="text" required value="{{ $user->last_name }}" class="form-control rounded-pill">
                        <p class="text-danger mb-0">
                            @error('last_name')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <!-- Select Role -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="role">Role</label>
                        <select name="role" id="role" required class="form-control rounded-pill">
                            <option {{ ($user->role == '1') ? 'selected' : '' }} value="1">Admin</option>
                            <option {{ ($user->role == '2') ? 'selected' : '' }} value="2">User</option>
                        </select>
                        <p class="text-danger mb-0">
                            @error('role')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <!-- Email Address -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="email">Email Address</label>
                        <input name="email" id="email" type="email" value="{{ $user->email }}" readonly class="form-control rounded-pill">
                    </div>

                    <!-- Password -->
                    <div class="col-12 mt-3">
                        <label class="font-weight-bold" for="password">Password</label>
                        <input name="password" id="password" type="password" placeholder="********" class="form-control rounded-pill">
                        <p class="text-danger mb-0">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <!-- Submit button -->
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
