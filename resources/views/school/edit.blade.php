@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">
        <div class="bg-light p-4 rounded">
            <h1>Update School/College</h1>
            <div class="lead">
                Update your institution details
            </div>

            <div class="container">
                <form method="POST" action="{{ route('school.update', $school->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $school->name }}" autofocus>

                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Place</label>
                            <input type="text" class="form-control" name="place" value="{{ $school->place }}">
                            @if ($errors->has('place'))
                                <span class="text-danger text-left">{{ $errors->first('place') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="district" class="form-label">District</label>
                            <input type="text" class="form-control" name="district" value="{{ $school->district }}"
                                autofocus>

                            @if ($errors->has('district'))
                                <span class="text-danger text-left">{{ $errors->first('district') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Pincode</label>
                            <input type="number" class="form-control" name="pincode" value="{{ $school->pincode }}">
                            @if ($errors->has('pincode'))
                                <span class="text-danger text-left">{{ $errors->first('pincode') }}</span>
                            @endif
                        </div>
                    </div><br>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('school.index') }}" class="btn btn-default">Back</a>
                </form>
            </div>

        </div>
    </div>

@endsection
