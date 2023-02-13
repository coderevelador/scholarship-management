@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">
        <div class="bg-light p-4 rounded">
            <h1>Add Academic Year</h1>
            <div class="lead">
                Enter your year details
            </div>

            <div class="container">
                <form method="POST" action="{{ route('academic-year.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" class="form-control" name="year" placeholder="Year" autofocus>

                            @if ($errors->has('year'))
                                <span class="text-danger text-left">{{ $errors->first('year') }}</span>
                            @endif
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('academic-year.index') }}" class="btn btn-default">Back</a>
                </form>
            </div>

        </div>
    </div>
@endsection
