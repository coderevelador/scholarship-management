@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">

        <div class="bg-light p-4 rounded">
            <h1>Course/Class</h1>
            <div class="lead">
                Manage your course/classs here.
                <a href="{{ route('course.create') }}" class="btn btn-primary btn-sm float-right">Add new course/class</a>
            </div>


            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Course/Class Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($course as $courses)
                        <tr class="course-{{ $courses->id }}">
                            <td>{{ $courses->id }}</td>
                            <td>{{ $courses->name }}</td>
                            <td>
                                <a href="{{ route('course.edit', $courses->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm delete-course"
                                    data-id="{{ $courses->id }}">Delete</button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // delete user
        $(document).on('click', '.delete-course', function() {
            var course_id = $(this).data('id');
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
                        url: "/course/" + course_id,
                        type: 'POST',
                        data: {
                            _method: 'delete'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            $('.course-' + course_id).remove();
                            Swal.fire(
                                'Deleted!',
                                'The course has been deleted.',
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
