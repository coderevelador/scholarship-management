@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">
        <div class="bg-light p-4 rounded">
            <h1>Scholarship List</h1>
            <div class="lead">
                Manage your scholarship here.
                <a href="{{ route('scholarship-list.create') }}" class="btn btn-primary btn-sm float-right my-3">Add new
                    scholarship</a>
            </div>
            <div class="row col-sm-8 col-lg-12 col-xl-12">
                @foreach ($scholarshiplists as $scholarshiplist)
                    <div class="col-lg-6 col-xl-3 scholarshiplist-{{ $scholarshiplist->id }}">

                        <div class="card mb-4">
                            <img class="card-img-top"
                                src="{{ asset('/images/scholarship_list/' . $scholarshiplist->cover_image) }}"
                                height="230px">
                            <div class="card-body">
                                <h5 class="card-title ">{{ $scholarshiplist->name }}</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>{{ $scholarshiplist->yearname->year }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>{{ $scholarshiplist->department->name }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>{{ $scholarshiplist->course->name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('scholarship-list.show', $scholarshiplist->id) }}"
                                            class="btn btn-outline-info btn-pill mt-2"
                                            style="width: 110px; display: inline-block;">Show</a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('scholarship-list.edit', $scholarshiplist->id) }}"
                                            class="btn btn-outline-primary btn-pill mt-2"
                                            style="width: 110px;  display: inline-block;">Edit</a>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($scholarshiplist->status == 0)
                                            <a href="{{ route('disable.studentlist', $scholarshiplist->id) }}"
                                                class="btn btn-outline-secondary btn-pill mt-2 "
                                                style="width: 110px;display: inline-block;">Disable</a>
                                        @else
                                            <a href="{{ route('disable.studentlist', $scholarshiplist->id) }}"
                                                class="btn btn-outline-success btn-pill mt-2 "
                                                style="width: 110px; display: inline-block;">Enable</a>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-outline-danger btn-pill mt-2 delete-schoalrshiplist"
                                            style="width: 110px; display: inline-block;"
                                            data-id="{{ $scholarshiplist->id }}">Delete</button>
                                    </div>
                                    @if (Carbon\Carbon::today()->toDateString() <= $scholarshiplist->deadline)
                                        <p style="text-align: center; padding-top:10px;margin-bottom:-20px; ">
                                            <span
                                                class="badge badge-{{ Carbon\Carbon::today()->toDateString() >= $scholarshiplist->deadline ? 'warning' : 'primary' }}">Deadline:
                                                {{ $scholarshiplist->deadline }}</span>
                                        </p>
                                    @else
                                        <p style="text-align: center; padding-top:10px;margin-bottom:-20px; color:red">
                                            <span class="badge badge-danger">Expired</span>
                                        </p>
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
            <div class="float-end">
                {{ $scholarshiplists->links() }}
            </div>
        </div>



        <script>
            // delete user
            $(document).on('click', '.delete-schoalrshiplist', function() {
                var scholarshiplist_id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "The related scholarship application also deleted",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "/scholarship-list/" + scholarshiplist_id,
                            type: 'POST',
                            data: {
                                _method: 'delete'
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                $('.scholarshiplist-' + scholarshiplist_id).remove();
                                Swal.fire(
                                    'Deleted!',
                                    'The scholarshiplist and related application has been deleted.',
                                    'success'
                                )

                            }
                        });
                    }
                });
            });
        </script>
    @endsection
