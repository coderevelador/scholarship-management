@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">

        <div class="bg-light p-4 rounded">
            <h1>School/College</h1>
            <div class="lead">
                Manage your institute here.
                <a href="{{ route('school.create') }}" class="btn btn-primary btn-sm float-right">Add new institute</a>
            </div>

            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>School/College</th>
                        <th>Location</th>
                        <th>District</th>
                        <th>Pincode</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($school as $institute)
                        <tr class="school-{{ $institute->id }}">
                            <th scope="row">{{ $institute->id }}</th>
                            <td>{{ $institute->name }}</td>
                            <td>{{ $institute->place }}</td>
                            <td>{{ $institute->district }}</td>
                            <td>{{ $institute->pincode }}</td>
                            <td>
                                <a href="{{ route('school.edit', $institute->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm delete-school"
                                    data-id="{{ $institute->id }}">Delete</button>
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

    <script>
        // delete user
        $(document).on('click', '.delete-school', function() {
            var school_id = $(this).data('id');
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
                        url: "/school/" + school_id,
                        type: 'POST',
                        data: {
                            _method: 'delete'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            $('.school-' + school_id).remove();
                            Swal.fire(
                                'Deleted!',
                                'The institute has been deleted.',
                                'success'
                            )

                        }
                    });
                }
            });
        });


        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
@endsection
