@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">
        <div class="bg-light p-4 rounded">
            <h1>Update Academic Year</h1>
            <div class="lead">
                Update your year here
            </div>

            <div class="container">
                <form method="POST" action="{{ route('academic-year.update', $years->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="year" class="form-label">Academic Year</label>
                            <input type="text" class="form-control" name="year" value="{{ $years->year }}" autofocus>

                            @if ($errors->has('year'))
                                <span class="text-danger text-left">{{ $errors->first('year') }}</span>
                            @endif
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('academic-year.index') }}" class="btn btn-default">Back</a>
                </form>
            </div>

        </div>
    </div>
@endsection
