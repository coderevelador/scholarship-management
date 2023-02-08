@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">

        <div class="bg-light p-4 rounded">
            <h1>Department</h1>
            <div class="lead">
                Manage your departments here.
                <a href="{{ route('department.create') }}" class="btn btn-primary btn-sm float-right">Add new department</a>
            </div>

            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Department Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($department as $depart)
                        <tr class="department-{{ $depart->id }}">
                            <td>{{ $depart->id }}</td>
                            <td>{{ $depart->name }}</td>
                            <td>
                                <a href="{{ route('department.edit', $depart->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm delete-department"
                                    data-id="{{ $depart->id }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // delete user
        $(document).on('click', '.delete-department', function() {
            var department_id = $(this).data('id');
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
                        url: "/department/" + department_id,
                        type: 'POST',
                        data: {
                            _method: 'delete'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            $('.department-' + department_id).remove();
                            Swal.fire(
                                'Deleted!',
                                'The department has been deleted.',
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
