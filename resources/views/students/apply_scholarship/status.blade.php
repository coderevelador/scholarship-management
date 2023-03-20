@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">

        <div class="bg-light p-4 rounded">
            <h1>Applied Scholarships Status</h1>
            <div class="lead">
                Complete details for your scholarship applications.
            </div>

            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Scholarship Name</th>
                        <th>Year</th>
                        <th>Department</th>
                        <th>Course</th>
                        <th>Division</th>
                        <th>Annual Income</th>
                        <th>Mark Percentage</th>
                        <th>Submission Date</th>
                        <th>Status</th>
                        <th>Payment Receipt</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appliedStatus as $status)
                        <tr>
                            <th scope="row">{{ $status->id }}</th>
                            <td>{{ $status->scholarshipName->name }}</td>
                            <td>{{ $status->studentEducationDetails->academicYear->year }}</td>
                            <td>{{ $status->studentEducationDetails->departmentName->name }}</td>
                            <td>{{ $status->studentEducationDetails->course->name }}</td>
                            <td>{{ $status->studentEducationDetails->division->name }}</td>
                            <td>{{ $status->annual_income }}</td>
                            <td>{{ $status->mark_percentage }}</td>
                            <td>{{ $status->submission_date }}</td>
                            <td><span
                                    class="badge badge-{{ $status->status == 'rejected' ? 'danger' : 'success' }}">{{ $status->status }}</span>
                            </td>
                            <td>
                                @if ($status->payment_receipt != null)
                                    <a href="{{ asset('payment-receipt/' . $status->payment_receipt) }}" target="_blank"
                                        class="btn btn-primary btn-sm">Download Receipt</a>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
@endsection
