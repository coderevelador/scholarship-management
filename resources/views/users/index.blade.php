@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">

        <div class="bg-light p-4 rounded">
            <h1>Users</h1>
            <div class="lead">
                Manage your users here.
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Add new user</a>

            </div>


            <table id="productsTable" class="table table-hover table-product" style="width:100%">

                <thead>

                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Show</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @if (!$user->hasRole('Super-Admin') && !$user->hasRole('Student'))
                            <tr class="user-{{ $user->id }}">
                                <th scope="row">{{ $user->id }}</th>
                                <td class="py-0">
                                    <img src="{{ asset('/images/user/' . $user->image) }}" alt="Product Image">
                                </td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-primary">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td> <button class="btn btn-primary btn-sm view-page"
                                        data-url="/users/show/{{ $user->id }}">View</button></td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm delete-user"
                                        data-id="{{ $user->id }}">Delete</button>
                                </td>

                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>


            {{-- model user details --}}

            <div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content user-show">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
                        </div>
                        <div class="modal-body">


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- end model user details --}}

        </div>
    </div>
    
    {{-- Export Section --}}

    <div class="btn-group mr-3 mb-4 float-right" role="group" aria-label="Button group with nested dropdown">

        <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Export
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start"
                style="position: absolute; transform: translate3d(0px, 42px, 0px); top: 0px; left: 0px; will-change: transform; background:#04c7e0; ">
                <a class="dropdown-item " href="{{ route('users.export.excel') }}">EXCEL</a>
                <a class="dropdown-item" href="{{ route('users.export.csv') }}">CSV</a>
                <a class="dropdown-item" href="{{ route('users.export.pdf') }}">PDF</a>
            </div>
        </div>
    </div>


    <script>
        // Show User Information
        $(document).on('click', '.view-page', function() {
            var url = $(this).data('url');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    var secondArray = response['roles'];
                    var role_name = secondArray[0];
                    var html =
                        '<div class="container user-details mt-4">' +
                        '<div>' +
                        '<b>Name:</b>     ' + response.name +
                        '</div>' +
                        '<div>' +
                        '<b>Email:</b>    ' + response.email +
                        '</div>' +
                        '<div>' +
                        '<b>Username:</b> ' + response.username +
                        '</div>' +
                        '<div>' +
                        '<b>Role:</b>     ' + role_name['name'] +
                        '</div>' +
                        '<div>' +
                        '<img src="/images/user/' + response.image +
                        '" alt="User Image" width="50px">' +
                        '</div>' +
                        '</div>'



                    $('#view-modal .modal-body').html(html);
                    $('#view-modal').modal('show');
                }
            });
        });


        // delete user
        $(document).on('click', '.delete-user', function() {
            var user_id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/users/delete/' + user_id,
                        type: 'GET',
                        success: function(data) {
                            $('.user-' + user_id).remove();
                            Swal.fire(
                                'Deleted!',
                                'The user has been deleted.',
                                'success'
                            )
                        }
                    });
                }
            });
        });
    </script>
@endsection
