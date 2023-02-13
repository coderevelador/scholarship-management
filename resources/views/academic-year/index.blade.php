@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">

        <div class="bg-light p-4 rounded">
            <h1>Academic Year</h1>
            <div class="lead">
                Manage your year here.
                <a href="{{ route('academic-year.create') }}" class="btn btn-primary btn-sm float-right">Add Academic Year</a>
            </div>

            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Academic Year</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($years as $year)
                        <tr class="year-{{ $year->id }}">
                            <th scope="row">{{ $year->id }}</th>
                            <td>{{ $year->year }}</td>

                            <td>
                                <a href="{{ route('academic-year.edit', $year->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm delete-year"
                                    data-id="{{ $year->id }}">Delete</button>
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
        $(document).on('click', '.delete-year', function() {
            var year_id = $(this).data('id');
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
                        url: "/academic-year/" + year_id,
                        type: 'POST',
                        data: {
                            _method: 'delete'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            $('.year-' + year_id).remove();
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
    </script>
@endsection
