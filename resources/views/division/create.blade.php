@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">
        <div class="bg-light p-4 rounded">
            <h1>Add Division or Section</h1>
            <div class="lead">
                Enter your division or section details
            </div>

            <div class="container">
                <form method="POST" action="{{ route('division.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name" autofocus>
                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('division.index') }}" class="btn btn-default">Back</a>
                </form>
            </div>

        </div>
    </div>
@endsection
