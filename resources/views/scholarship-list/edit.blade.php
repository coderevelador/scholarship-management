@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">
        <div class="bg-light p-4 rounded">
            <h1>Update Scholarship</h1>
            <div class="lead">
                Enter your scholarship details
            </div>

            <div class="container">
                <form method="POST" action="{{ route('scholarship-list.update', $scholarshiplists->id) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $scholarshiplists->name }}"
                                autofocus>
                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Academic Year</label>
                            <select name="year" id="" required class="form-control">
                                <option value="">Select Year</option>
                                @foreach ($year as $years)
                                    <option value="{{ $years->id }}"
                                        {{ $scholarshiplists->academic_year_id == $years->id ? 'selected' : '' }}>
                                        {{ $years->year }}</option>
                                @endforeach
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
                                    <option value="{{ $school->id }}"
                                        {{ $scholarshiplists->institution_id == $school->id ? 'selected' : '' }}>
                                        {{ $school->name }}</option>
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
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ $scholarshiplists->department_id == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}</option>
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
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ $scholarshiplists->course_id == $course->id ? 'selected' : '' }}>
                                        {{ $course->name }}</option>
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
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}"
                                        {{ $scholarshiplists->division_id == $division->id ? 'selected' : '' }}>
                                        {{ $division->name }}</option>
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
                                @foreach ($eligibilities as $eligibility)
                                    <option value="{{ $eligibility->id }}"
                                        {{ $scholarshiplists->eligibility_id == $eligibility->id ? 'selected' : '' }}>
                                        {{ $eligibility->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('eligibility'))
                                <span class="text-danger text-left">{{ $errors->first('eligibility') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Upload Cover Image</label>
                            <input type="file" name="cover_image" id="image-input" class="form-control">
                            @if ($errors->has('cover_image'))
                                <span class="text-danger text-left">{{ $errors->first('cover_image') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="eligibility" class="form-label">Deadline</label>
                            <input type="date" class="form-control" name="deadline"
                                value="{{ $scholarshiplists->deadline }}">
                            @if ($errors->has('deadline'))
                                <span class="text-danger text-left">{{ $errors->first('deadline') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="0" {{ $scholarshiplists->status == 0 ? 'selected' : '' }}>Active
                                </option>
                                <option value="1" {{ $scholarshiplists->status == 1 ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            @if ($errors->has('cover_image'))
                                <span class="text-danger text-left">{{ $errors->first('cover_image') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="" class="form-label">Remarks</label>
                            <textarea name="remark" id="" rows="4" class="form-control">{{ $scholarshiplists->remark }}</textarea>
                            @if ($errors->has('remark'))
                                <span class="text-danger text-left">{{ $errors->first('remark') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Cover Image</label><br>
                            <img src="{{ asset('/images/scholarship_list/'. $scholarshiplists->cover_image) }}"
                                alt="Cover Image" id="image-preview" width="150px">
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('scholarship-list.index') }}" class="btn btn-default">Back</a>
                </form>
            </div>

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
