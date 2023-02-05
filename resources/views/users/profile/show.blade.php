@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-xl-9">
            <div class="card card-default">
                <div class="card-header mx-auto">
                    <h2 class="">Profile Settings</h2>
                </div>

                <div class="card-body mx-auto">
                    <div>
                        <img src="{{ asset('/images/user/' . $user->image) }}" alt="User Image" width="100px">
                    </div><br>
                    <div class="media media-sm ">
                        <div class="media-body">
                            <span class="title h3">Name: {{ $user->name }}</span>
                            @foreach ($user->roles as $item)
                                <p>Role: {{ $item['name'] }}</p>
                            @endforeach
                            <p>Email: {{ $user->email }}</p>
                            <p>Username: {{ $user->username }}</p>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userProfileModal"
                        data-id="{{ $user->id }}">
                        Edit Profile
                    </button>


                </div>
            </div>
            {{-- model update details --}}

            <div class="modal fade" id="userProfileModal" tabindex="-1" role="dialog"
                aria-labelledby="userProfileModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content user-information">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userProfileModalLabel">Update Your Profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="update-form" action="{{ route('profile.update', $user->id) }}" method="post"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group row mb-6">
                                    <label for="name" class="col-sm-4 col-lg-2 col-form-label">Name</label>
                                    <div class="col-sm-8 col-lg-10">
                                        <div class="custom-file mb-1">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $user->name }}" required>
                                        </div>

                                    </div>
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="form-group row mb-6">
                                    <label for="email" class="col-sm-4 col-lg-2 col-form-label">Email</label>
                                    <div class="col-sm-8 col-lg-10">
                                        <input type="text" class="form-control" name="email"
                                            value="{{ $user->email }}" required>
                                    </div>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="form-group row mb-6">
                                    <label for="username" class="col-sm-4 col-lg-2 col-form-label">Username</label>
                                    <div class="col-sm-8 col-lg-10">
                                        <input type="text" class="form-control" name="username"
                                            value="{{ $user->username }}" required>
                                    </div>
                                </div>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="form-group row mb-6">
                                    <label for="current_password" class="col-sm-4 col-lg-2 col-form-label">Current
                                        Password</label>
                                    <div class="col-sm-8 col-lg-10">
                                        <input type="text" class="form-control" name="current_password"
                                            placeholder="Current Password">
                                    </div>
                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group row mb-6">
                                    <label for="password" class="col-sm-4 col-lg-2 col-form-label">New Password</label>
                                    <div class="col-sm-8 col-lg-10">
                                        <input type="text" class="form-control" id="password" placeholder="New Password"
                                            name="password">
                                    </div>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="form-group row mb-6">
                                    <label for="confirm_password" class="col-sm-4 col-lg-2 col-form-label">Confirm
                                        Password</label>
                                    <div class="col-sm-8 col-lg-10">
                                        <input type="text" class="form-control" name="password_confirmation"
                                            placeholder="Confirm Password">
                                    </div>
                                </div>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="form-group row mb-6">
                                    <label for="image" class="col-sm-4 col-lg-2 col-form-label">Image</label>
                                    <div class="col-sm-8 col-lg-10">
                                        <input type="file" class="form-control" id="image" name="image"> <br>
                                        <img src="{{ asset('/images/user/' . $user->image) }}" id="preview-image"
                                            alt="Image" width="100px">
                                    </div>
                                </div>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- end model update details --}}



        </div>

    </div>

    <script>
        // update user

        $(document).on('submit', '#update-form', function(e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var formData = new FormData($(this)[0]);
            console.log(_token: $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                type: 'PATCH',
                url: url,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    formData: formData,
                },
                async: false,
                success: function(response) {
                    if (response.info) {
                        location.reload();
                    }
                    toastr.info(response.info);
                },
                cache: false,
                contentType: true,
                processData: false,
                error: function(xhr, status, error) {
                    toastr.error(xhr.responseJSON.message);

                },
            });
        });


        // Edit User Information
        $('#userProfileModal').click(function() {

            $.ajax({
                type: 'get',
                success: function(data) {

                }
            });
        });


        // image preview
        $(document).ready(function() {
            $('#image').change(function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
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
