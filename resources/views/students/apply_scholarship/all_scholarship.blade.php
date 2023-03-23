@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">

        <div class="bg-light p-4 rounded">
            <h1>All Applied Scholarship List</h1>
            <div class="lead">
                Manage your applied scholarship here.
            </div>

            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Scholarship Name</th>
                        <th>Student Name</th>
                        <th>Year</th>
                        <th>Department</th>
                        <th>Course Name</th>
                        <th>Division Name</th>
                        <th>Annual Income</th>
                        <th>Mark Percentage</th>
                        <th>Submission Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appliedScholarship as $scholarship)
                        <tr>
                            <td>{{ $scholarship->id }}</td>
                            <td>{{ $scholarship->scholarshipName->name }}</td>
                            <td>{{ $scholarship->studentDetails->name }}</td>
                            <td>{{ $scholarship->studentEducationDetails->academicYear->year }}</td>
                            <td>{{ $scholarship->studentEducationDetails->departmentName->name }}</td>
                            <td>{{ $scholarship->studentEducationDetails->course->name }}</td>
                            <td>{{ $scholarship->studentEducationDetails->division->name }}</td>
                            <td>{{ $scholarship->annual_income }}</td>
                            <td>{{ $scholarship->mark_percentage }}</td>
                            <td>{{ $scholarship->submission_date }}</td>
                            <td> <span
                                    class="badge badge-{{ $scholarship->status == 'rejected' ? 'danger' : 'success' }}">{{ $scholarship->status }}</span>
                            </td>
                           
                            <td><a href="{{ route('apply-scholarship.edit', $scholarship->id) }}"
                                    class="btn btn-primary btn-sm btn-block mt-1">Edit</a> <button data-id="{{ $scholarship->id }}"
                                    class="btn btn-danger btn-sm btn-block mt-1 delete-scholarship">Delete</button></td>
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

    {{-- Export Section --}}

    {{-- <div class="btn-group mr-3 mb-4 float-right" role="group" aria-label="Button group with nested dropdown">

        <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Export
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start"
                style="position: absolute; transform: translate3d(0px, 42px, 0px); top: 0px; left: 0px; will-change: transform; background:#04c7e0; ">
                <a class="dropdown-item "
                    href="{{ route('scholarshiplistsingle.export.excel', $scholarshipName->id) }}">EXCEL</a>
                <a class="dropdown-item"
                    href="{{ route('scholarshiplistsingle.export.csv', $scholarshipName->id) }}">CSV</a>
                <a class="dropdown-item"
                    href="{{ route('scholarshiplistsingle.export.pdf', $scholarshipName->id) }}">PDF</a>
            </div>
        </div>
    </div> --}}

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
        $(document).on('click', '.delete-scholarship', function() {
            var student_id = $(this).data('id');

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
                        url: "/apply-scholarship/" + student_id,
                        type: 'POST',
                        data: {
                            _method: 'delete'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            $('.students-' + student_id).remove();
                            Swal.fire(
                                'Deleted!',
                                'The application has been deleted.',
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
