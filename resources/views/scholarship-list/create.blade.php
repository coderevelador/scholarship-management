@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">
        <div class="bg-light p-4 rounded">
            <h1>Add Scholarship</h1>
            <div class="lead">
                Enter your scholarship details
            </div>

            <div class="container">
                <form method="POST" action="{{ route('school.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name" autofocus>

                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Academic Year</label>
                            <select name="year" id="" required class="form-control">
                                <option value="">Select Year</option>
                            </select>
                            @if ($errors->has('year'))
                                <span class="text-danger text-left">{{ $errors->first('year') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="school" class="form-label">Institution</label>
                            <select name="school" id="" required class="form-control">
                                <option value="">Select Institution</option>
                                @foreach ($schools as $school)
                                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('school'))
                                <span class="text-danger text-left">{{ $errors->first('school') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Department</label>
                            <select name="department" id="" required class="form-control">
                                <option value="">Select Department</option>
                                <option value="">Select All</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('department'))
                                <span class="text-danger text-left">{{ $errors->first('department') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="course" class="form-label">Course/Class</label>
                            <select name="course" id="" required class="form-control">
                                <option value="">Select Course/Class</option>
                                <option value="">Select All</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('course'))
                                <span class="text-danger text-left">{{ $errors->first('course') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Division/Section</label>
                            <select name="division" id="" required class="form-control">
                                <option value="">Select Division/Section</option>
                                <option value="">Select All</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('division'))
                                <span class="text-danger text-left">{{ $errors->first('division') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="eligibility" class="form-label">Scholarship Eligibility</label>
                            <select name="eligibility" id="" required class="form-control">
                                <option value="">Select Eligibility</option>
                            </select>

                            @if ($errors->has('eligibility'))
                                <span class="text-danger text-left">{{ $errors->first('eligibility') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Upload Cover Image</label>
                            <input type="file" src="" name="image" class="form-control">
                            @if ($errors->has('image'))
                                <span class="text-danger text-left">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="" class="form-label">Remarks</label>
                            <textarea name="remark" id="" rows="4" class="form-control"></textarea>
                            @if ($errors->has('remark'))
                                <span class="text-danger text-left">{{ $errors->first('remark') }}</span>
                            @endif
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('scholarship-list.index') }}" class="btn btn-default">Back</a>
                </form>
            </div>

        </div>
    </div>
@endsection
