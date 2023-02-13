@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">
        <div class="bg-light p-4 rounded">
            <h1>Scholarship List</h1>
            <div class="lead">
                Manage your scholarship here.
                <a href="{{ route('scholarship-list.create') }}" class="btn btn-primary btn-sm float-right">Add new scholarship</a>
            </div>
            <div class="col-lg-6 col-xl-3">
                <div class="card mb-4">
                    <img class="card-img-top" src="images/elements/cc1.jpg">
                    <div class="card-body">
                        <h5 class="card-title ">Card Title</h5>
                        <p class="card-text pb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod
                            tempor </p>
                        <a href="#" class="btn btn-outline-info btn-pill mt-2"
                            style="width: 110px;
                        display: inline-block;">Show</a>
                        <a href="#" class="btn btn-outline-primary btn-pill mt-2"
                            style="width: 110px;
                        display: inline-block;">Edit</a>
                        <a href="#" class="btn btn-outline-secondary btn-pill mt-2 "
                            style="width: 110px;
                        display: inline-block;">Disable</a>
                        <a href="#" class="btn btn-outline-danger btn-pill mt-2 "
                            style="width: 110px;
                    display: inline-block;">Delete</a>
                    </div>
                </div>
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
