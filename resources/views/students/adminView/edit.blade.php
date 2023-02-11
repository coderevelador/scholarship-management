@extends('layouts.app')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Update Student</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">
            <form method="post" action="{{ route('students.update', $students->id) }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ $students->name }}" type="text" class="form-control" name="name"
                        placeholder="Name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ $students->email }}" type="email" class="form-control" name="email"
                        placeholder="Email address" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input value="{{ $students->username }}" type="text" class="form-control" name="username"
                        placeholder="Username" required>
                    @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" name="password"
                        placeholder="Password" >
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="file" name="image" id="image-input" class="form-control">
                    @if ($errors->has('image'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <img src="{{ asset('images/user/' . $students->image) }}" id="image-preview" alt="user-image"
                        width="200px">
                </div><br>
                <button type="submit" class="btn btn-primary">Update Student</button>
                <a href="{{ route('students.index') }}" class="btn btn-default">Cancel</button>
            </form>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $("#image-input").on("change", function() {
                var input = this;
                var url = URL.createObjectURL(input.files[0]);
                $("#image-preview").attr("src", url);
            });
        });
    </script>
@endsection
