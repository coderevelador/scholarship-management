@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">
        <div class="bg-light p-4 rounded">
            <h1>Scholarship List</h1>
            <div class="lead">
                Manage your scholarship here.
            </div>
            @if (sizeof($scholarshiplists) == 0)
                <div class="alert alert-info" role="alert">
                    Scholarshiplist not found! Please come back later or <a
                        href="{{ route('student.education') }}"><b>Update your educational details!</b></a>
                </div>
            @endif
            @if (!empty($scholarshiplists))
                <div class="row col-sm-8 col-lg-12 col-xl-12">

                    @foreach ($scholarshiplists as $scholarshiplist)
                        @if ($scholarshiplist->status == 0)
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
                                                <p>{{ $scholarshiplist->yearname }}</p>
                                            </div>
                                            <div class="col-md-5">
                                                <p>{{ $scholarshiplist->department }}</p>
                                            </div>
                                            <div class="col-md-3">
                                                <p>{{ $scholarshiplist->course }}</p>
                                            </div>
                                        </div>

                                        <div style="display: flex; justify-content: center;">

                                            <a href="{{ route('apply.scholarship', $scholarshiplist->id) }}"
                                                class="btn btn-outline-info btn-pill mt-2 mx-auto"
                                                style="width:; display: inline-block; ">Apply Now</a>
                                        </div>
                                        <p
                                            style="text-align: center; padding-top:10px;margin-bottom:-20px; color:{{ Carbon\Carbon::today()->toDateString() == $scholarshiplist->deadline ? 'red' : 'green' }}">
                                            Deadline: {{ $scholarshiplist->deadline }}</p>

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
                <div class="float-end">
                    {{ $scholarshiplists->links() }}
                </div>
            @else
                <div class="alert alert-secondary alert-icon col-md-6" role="alert">
                    <i class="mdi mdi-alert"></i> Please fill out your educational details and come back
                </div>
                <div class="col-md-6">
                    <a href="{{ route('student.education') }}" class="btn btn-block btn-outline-success">Update Your
                        Educational
                        Details</a>
                </div>
            @endif

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
