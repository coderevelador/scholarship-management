@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">
        <div class="bg-light p-4 rounded">
            <h1>Apply Scholarship</h1>
            <div class="lead">
                Enter your scholarship details
            </div>

            <div class="container">
                <form method="POST" action="{{ route('apply.store.scholarship', $applyScholarship->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $applyScholarship->name }}"
                                readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Academic Year</label>
                            <input type="text" class="form-control" name="year"
                                value="{{ $applyScholarship->yearname->year }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Department</label>
                            <input type="text" class="form-control" name="department"
                                value="{{ $applyScholarship->department->name }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Course/Class</label>
                            <input type="text" class="form-control" name="course"
                                value="{{ $applyScholarship->course->name }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Division/Section</label>
                            <input type="text" class="form-control" name="division"
                                value="{{ $applyScholarship->division->name }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Remarks</label>
                            <input type="text" class="form-control" name="remark"
                                value="{{ $applyScholarship->remark }}" readonly>
                        </div>
                    </div>
                    {{-- custom field --}}
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Annual Income</label>
                            <input type="number" class="form-control" name="annual_income" id="annual_income"
                                placeholder="Enter your annual income">
                            @if ($errors->has('annual_income'))
                                <span class="text-danger text-left">{{ $errors->first('annual_income') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Mark Percentage</label>
                            <input type="text" class="form-control" name="mark_percentage" id="mark_percentage"
                                placeholder="Enter your mark percentage">
                            @if ($errors->has('mark_percentage'))
                                <span class="text-danger text-left">{{ $errors->first('mark_percentage') }}</span>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" value="{{ Auth::user()->id }}" name="student_id">
                    <br>
                    <button type="submit" class="btn btn-primary">Apply Now</button>
                    <a href="{{ route('apply-scholarship.index') }}" class="btn btn-default">Back</a>
                </form>
            </div>

        </div>
    </div>

    <script>
        $('#annual_income').change(function(e) {
            e.preventDefault();
            var annualIncome = $('#annual_income').val();

            $.ajax({
                url: '/apply-scholarship/eligibility-checking/income',
                type: 'GET',
                data: {
                    annual_income: annualIncome
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 400) {
                        Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'You are not eligible for this scholarship',
                                customClass: {
                                    icon: 'error-icon-class',
                                    title: 'error-title-class',
                                    content: 'error-content-class',
                                    confirmButton: 'error-confirm-button-class'
                                },
                                background: '#f5f5f5',
                                confirmButtonColor: '#e31e43',
                                confirmButtonText: 'OK',
                                heightAuto: false,
                                allowOutsideClick: false,
                            }),
                            setTimeout(() => {
                                window.location = "{{ route('apply-scholarship.index') }}";
                            }, 3000);
                    }
                }
            });
        });
        // mark percentage checking
        $('#mark_percentage').change(function(e) {
            e.preventDefault();
            var markPercentage = $('#mark_percentage').val();

            $.ajax({
                url: '/apply-scholarship/eligibility-checking/mark-percentage',
                type: 'GET',
                data: {
                    mark_percentage: markPercentage
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 400) {
                        Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'You are not eligible for this scholarship',
                                customClass: {
                                    icon: 'error-icon-class',
                                    title: 'error-title-class',
                                    content: 'error-content-class',
                                    confirmButton: 'error-confirm-button-class'
                                },
                                background: '#f5f5f5',
                                confirmButtonColor: '#e31e43',
                                confirmButtonText: 'OK',
                                heightAuto: false,
                                allowOutsideClick: false,
                            }),
                            setTimeout(() => {
                                window.location = "{{ route('apply-scholarship.index') }}";
                            }, 3000);
                    }
                }
            });
        });
    </script>
@endsection
