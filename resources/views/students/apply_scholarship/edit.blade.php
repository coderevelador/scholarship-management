@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">
        <div class="bg-light p-4 rounded">
            <h1>Edit Scholarship Applied by <strong>{{ $appliedScholarship->studentDetails->name }}</strong></h1>
            <div class="lead">
                Update scholarship details
            </div>

            <div class="container">
                <form method="POST" action="{{ route('apply-scholarship.update', $appliedScholarship->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Scholarship Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ $appliedScholarship->scholarshipName->name }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Academic Year</label>
                            <input type="text" class="form-control" name="year"
                                value="{{ $appliedScholarship->studentEducationDetails->academicYear->year }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Department</label>
                            <input type="text" class="form-control" name="department"
                                value="{{ $appliedScholarship->studentEducationDetails->departmentName->name }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Course/Class</label>
                            <input type="text" class="form-control" name="course"
                                value="{{ $appliedScholarship->studentEducationDetails->course->name }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Division/Section</label>
                            <input type="text" class="form-control" name="division"
                                value="{{ $appliedScholarship->studentEducationDetails->division->name }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Remarks</label>
                            <input type="text" class="form-control" name="remark"
                                value="{{ $appliedScholarship->scholarshipName->remark }}" readonly>
                        </div>
                    </div>
                    {{-- custom field --}}
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Annual Income</label>
                            <input type="number" class="form-control" name="annual_income" id="annual_income"
                                value="{{ $appliedScholarship->annual_income }}">
                            @if ($errors->has('annual_income'))
                                <span class="text-danger text-left">{{ $errors->first('annual_income') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Mark Percentage</label>
                            <input type="text" class="form-control" name="mark_percentage" id="mark_percentage"
                                value="{{ $appliedScholarship->mark_percentage }}" required>
                            @if ($errors->has('mark_percentage'))
                                <span class="text-danger text-left">{{ $errors->first('mark_percentage') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Submission Date</label>
                            <input type="text" class="form-control" name="submission" id="submission"
                                value="{{ $appliedScholarship->created_at }}" readonly>
                            @if ($errors->has('submission'))
                                <span class="text-danger text-left">{{ $errors->first('submission') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Updated Date</label>
                            <input type="text" class="form-control" name="updation" id="updation"
                                value="{{ $appliedScholarship->updated_at }}" readonly>
                            @if ($errors->has('updation'))
                                <span class="text-danger text-left">{{ $errors->first('updation') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="pending" {{ $appliedScholarship->status == 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="inprogress"
                                    {{ $appliedScholarship->status == 'inprogress' ? 'selected' : '' }}>
                                    In
                                    Progress</option>
                                <option value="approved" {{ $appliedScholarship->status == 'approved' ? 'selected' : '' }}>
                                    Approved</option>
                                <option value="payment_done"
                                    {{ $appliedScholarship->status == 'payment_done' ? 'selected' : '' }}>Payment Deposited
                                </option>
                                <option value="rejected"
                                    {{ $appliedScholarship->status == 'rejected' ? 'selected' : '' }}>
                                    Rejected</option>
                            </select>
                            @if ($errors->has('submission'))
                                <span class="text-danger text-left">{{ $errors->first('submission') }}</span>
                            @endif
                        </div>

                        <div class="col-md-6" id="payment_receipt1">
                            <label for="name" class="form-label">Payment Receipt</label>
                            <input type="file" class="form-control" name="payment_receipt">
                            @if ($errors->has('payment_receipt'))
                                <span class="text-danger text-left">{{ $errors->first('payment_receipt') }}</span>
                            @endif

                        </div>
                        <div class="col-md-6 mt-6">
                            @if ($appliedScholarship->payment_receipt != '')
                                <a href="{{ asset('payment-receipt/' . $appliedScholarship->payment_receipt) }}"
                                    class="btn btn-info" class="form-control" target="_blank">Download Receipt</a>
                            @endif
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
                    console.log(xhr);
                    if (xhr.status === 400) {
                        Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: xhr.responseJSON.message,
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
                                window.location = "{{ route('scholarship-list.index') }}";
                            }, 1000);
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
                                text: xhr.responseJSON.message,
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
                                window.location = "{{ route('scholarship-list.index') }}";
                            }, 1000);
                    } else if (xhr.status === 406) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Check the mark percentage',
                            text: xhr.responseJSON.message,
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
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Set the text value to zero
                                $('#mark_percentage').val('');
                            }
                        });

                    }
                }
            });
        });

        // Receipt Upload option

        $(document).ready(function() {
            $('#payment_receipt1').hide();
            $('#status').change(function() {
                if ($(this).val() === 'payment_done') {
                    $('#payment_receipt1').show();
                } else {
                    $('#payment_receipt1').hide();
                }
            });
        });
    </script>
@endsection
