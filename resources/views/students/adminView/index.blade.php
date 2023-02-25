@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">

        <div class="bg-light p-4 rounded">
            <h1>Students</h1>
            <div class="lead">
                Manage your students here.
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
                    @foreach ($students as $student)
                        <tr class="students-{{ $student->id }}">
                            <th scope="row">{{ $student->id }}</th>
                            <td class="py-0">
                                <img src="{{ asset('/images/user/' . $student->image) }}" alt="Product Image">
                            </td>
                            <td>{{ $student->username }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>
                                <span class="badge bg-primary">{{ $student->roles[0]->name }}</span>
                            </td>
                            <td> <button class="btn btn-primary btn-sm view-page"
                                    data-url="/students/{{ $student->id }}">View</button></td>
                            <td>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm delete-students"
                                    data-id="{{ $student->id }}">Delete</button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- model user details --}}

            <div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content user-show">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Student Details</h5>
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
                        '<b>Student Name:</b>     ' + response.name +
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
        $(document).on('click', '.delete-students', function() {
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
                        url: "/students/" + user_id,
                        type: 'POST',
                        data: {
                            _method: 'delete'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            $('.students-' + user_id).remove();
                            Swal.fire(
                                'Deleted!',
                                'The division has been deleted.',
                                'success'
                            ).then((result) => {
                                // Reload the Page
                                location.reload();
                            });

                        }
                    });
                }
            });
        });


        
    </script>
@endsection
