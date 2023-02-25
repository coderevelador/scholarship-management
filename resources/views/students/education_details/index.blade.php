@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">

        <div class="bg-light p-4 rounded">
            <h1>Educational Details</h1>
            <div class="lead">
                Fill your educational details here.
            </div>
            <div class="row mt-6">



                <!-- First Inbox -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default bg-secondary">
                        <div class="d-flex p-5 align-items-center flex-column">
                            <div class="icon-md bg-white rounded-circle mb-2">
                                <i class="mdi mdi-calendar-check text-secondary"></i>
                            </div>
                            <div class="text-center">
                                <span class="h2 d-block text-white">
                                    @if (!empty($educations->year_id))
                                        {{ $educations->academicYear->year }}
                                    @else
                                        ****
                                    @endif
                                </span>
                                <p class="text-white">Academic Year</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second Inbox -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default bg-success">
                        <div class="d-flex p-5 align-items-center flex-column">
                            <div class="icon-md bg-white rounded-circle mb-2">

                                <i class="fa fa-university text-success"></i>
                            </div>
                            <div class="text-center">
                                <span class="h2 d-block text-white">
                                    @if (!empty($educations->department_id))
                                        {{ $educations->departmentName->name }}
                                    @else
                                        ****
                                    @endif
                                </span>
                                <p class="text-white">Department</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Third Inbox -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default bg-primary">
                        <div class="d-flex p-5 align-items-center flex-column">
                            <div class="icon-md bg-white rounded-circle mb-2">
                                <i class="mdi mdi-school text-primary"></i>
                            </div>
                            <div class="text-center">
                                <span class="h2 d-block text-white">
                                    @if (!empty($educations->course_id))
                                        {{ $educations->course->name }}
                                    @else
                                        ****
                                    @endif
                                </span>
                                <p class="text-white">Course/Class</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fourth Inbox -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default bg-info">
                        <div class="d-flex p-5 align-items-center flex-column">
                            <div class="icon-md bg-white rounded-circle mb-2">
                                <i class="mdi mdi-view-list text-info"></i>
                            </div>
                            <div class="text-center">
                                <span class="h2 d-block text-white">
                                    @if (!empty($educations->division_id))
                                        {{ $educations->division->name }}
                                    @else
                                        ****
                                    @endif
                                </span>
                                <p class="text-white">Division/Section</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (empty($educations->id))
                <button type="submit" class="mb-1 btn btn-secondary float-end" data-target="#educationModalForm"
                    data-toggle="modal">
                    <i class=" mdi mdi-star-outline mr-1"></i>
                    Add Details
                </button>
            @else
                <a href="{{ route('student.education.edit', $educations->id) }}" class="mb-1 btn btn-primary float-end">
                    <i class=" mdi mdi-star-outline mr-1"></i>
                    Update
                </a>
            @endif


        </div>
    </div>

    <div class="modal fade" id="educationModalForm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFormTitle">Add Your Education</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('student.education.store') }}" id="educationFormSubmit">
                        @csrf
                        <div class="form-group">
                            <label for="year_id">Academic Year</label>
                            <select name="year_id" class="form-control" required>
                                <option value="">Select Year</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year->id }}">{{ $year->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="department_id">Department</label>
                            <select name="department_id" class="form-control" required>
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="course_id">Course</label>
                            <select name="course_id" class="form-control" required>
                                <option value="">Select Course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="division_id">Division</label>
                            <select name="division_id" class="form-control" required>
                                <option value="">Select Division</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-pill">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Show Form Information
        $('#educationModalForm').click(function() {
            $.ajax({
                type: 'get',
                success: function(data) {

                }
            });
        });

        // store data
        $(document).ready(function() {
            $('#educationFormSubmit').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('student.education.store') }}",
                    data: $('#educationFormSubmit').serialize(),
                    success: function(response) {
                        toastr.success('Form submitted successfully!');
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    },
                    error: function(response) {
                        toastr.error('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection
