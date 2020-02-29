@extends('master')


@section('content')


<!-- Add User button -->
<div class="d-flex justify-content-center justify-content-sm-end my-3">
    <a class="btn btn-primary btn-sm rounded-pill text-capitalize" href="{{url('admin/users/create')}}"><span class="mr-1" data-feather="plus"></span>add user</a>
</div>

<!-- Card -->
<div class="card flex-fill mb-3">
    <div class="card-body">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-3">

            <!-- Headline -->
            <h4 class="card-title flex-shrink-0 card-headline text-capitalize mr-sm-4">all users</h4>

            <!-- Filters -->
            <div class="form-inline justify-content-center justify-content-sm-end">

                <!-- status -->
                <select name="status_filter" class="table-filter form-control form-control-sm my-1 my-sm-0">
                    <option selected disabled>Status</option>
                    <option value="suspended">Suspended</option>
                    <option value="activate">Activate</option>
                </select>

                <!-- role -->
                <select name="role_filter" class="table-filter form-control form-control-sm ml-sm-1 my-1 my-sm-0">
                    <option selected disabled>Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
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

                <!-- reset button -->
                <a class="btn btn-sm btn-outline-secondary ml-sm-3 my-2 my-sm-0" href="{{ url()->current() }}">reset filters</a>

            </div>
        </div>

        <!-- if there is users to show -->
        @if( !empty ($users) )

        <!-- Users list -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="text-capitalize">
                        <th></th>
                        <th>#</th>
                        <th>first name</th>
                        <th>last name</th>
                        <th>email</th>
                        <th>role</th>
                        <th>status</th>
                        <th>created</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- list each user -->
                    @foreach ($users as $user)
                    <tr>
                        <!-- view or edit -->
                        <td class="align-middle bg-light text-nowrap">
                            <a class="btn btn-link p-1  {!! (Session::get('user_id') != $user->id) ? '' : 'invisible' !!}" href="{{url('admin/users/'.$user->id.'/changeStatus')}}" title="{!! ($user->status == '0') ? 'Activate' : 'Suspend' !!}">{!! ($user->status == '0') ? '<span data-feather="circle"></span>' : '<span data-feather="slash"></span>' !!}</a>
                            <a class="btn btn-link p-1" href="{{url('admin/users/'.$user->id.'/edit')}}" title="Edit"><span data-feather="edit"></span></a>
                        </td>

                        <!-- id -->
                        <td class="align-middle text-muted"><small>{{ $user->id }}</small></td>

                        <!-- first name -->
                        <td class="text-capitalize align-middle">{{ $user->first_name }}</td>

                        <!-- last name -->
                        <td class="text-capitalize align-middle">{{ $user->last_name }}</td>

                        <!-- email -->
                        <td class="text-lowercase align-middle">{{ $user->email }}</td>

                        <!-- role -->
                        <td class="text-capitalize align-middle">
                            @if ($user->role == '1')
                            <span class="font-weight-bold text-danger">admin</span>
                            @elseif ($user->role == '2')
                            user
                            @endif
                        </td>

                        <!-- status -->
                        <td>{!! ($user->status == '0') ? '<span class="badge badge-danger">Suspended</span>' : '<span class="badge badge-success">Activate</span>' !!}</td>

                        <!-- created & updated -->
                        <td class="align-middle text-nowrap">{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }} <span class="text-secondary font-size-10">| Updated {{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}</span></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            <!-- paginate links -->
            <div class="mt-5">
            {{ $users->links() }}
            </div>

        </div>

        <!-- if there is NO users to show -->
        @else

        <p>No users found...</p>

        @endif

    </div>
</div>

@endsection('content')
