@extends('layouts.app')

@section('content')
    <div class="card card-default card-profile">
        <div class="bg-light p-4 rounded">
            <h1>Update Eligibility</h1>
            <div class="lead">
                Enter your eligibility details
            </div>

            <div class="container">
                <form method="POST" action="{{ route('eligibility.update', $eligibilities['id']) }}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name" class="form-label">Checker Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $eligibilities['name'] }}"
                                autofocus required>

                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label for="income" class="form-label">Maximum Allowed Income</label>
                            <input type="number" class="form-control" name="income" value="{{ $eligibilities['income'] }}"
                                required>
                            @if ($errors->has('income'))
                                <span class="text-danger text-left">{{ $errors->first('income') }}</span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label for="minimumPercentage" class="form-label">Minimum Mark Percentage</label>
                            <input type="number" class="form-control" name="minimumPercentage"
                                value="{{ $eligibilities['minimumPercentage'] }}" required>

                            @if ($errors->has('minimumPercentage'))
                                <span class="text-danger text-left">{{ $errors->first('minimumPercentage') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">

                        <table class="table table-striped" id="conditionTable">
                            <thead>
                                <tr>
                                    <th scope="col">Minimum Mark Percentage</th>
                                    <th scope="col">Condition</th>
                                    <th scope="col">Maximum Mark Percentage</th>
                                    <th scope="col">Eligible Amount @lang('general.currency')</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (json_decode($eligibilities['minimumMarkPercentage'], true) as $key => $minimumMarkPercentage)
                                    <tr>
                                        <td><input type="number" class="form-control" value="{{ $minimumMarkPercentage }}"
                                                name="minimumMarkPercentage[]">
                                        </td>

                                        <td>
                                            <select name="percentageCondition[]" id="" class="form-control"
                                                required>
                                                <option value="">Select Condition</option>
                                                <option value="In Between" selected>In Between</option>
                                            </select>
                                        </td>
                                        @php
                                            $maximumMarkPercentage = json_decode($eligibilities['maximumMarkPercentage'], true);
                                        @endphp
                                        <td><input type="number" class="form-control"
                                                value="{{ $maximumMarkPercentage[$key] }}" name="maximumMarkPercentage[]">
                                        </td>
                                        @php
                                            $eligibleAmount = json_decode($eligibilities['eligibleAmount'], true);
                                        @endphp
                                        <td><input type="number" class="form-control" value="{{ $eligibleAmount[$key] }}"
                                                name="eligibleAmount[]">
                                        </td>
                                        <td>
                                            @if ($key != 1)
                                                <button type="button" id="addRowBtn"><i class='fa fa-plus-circle'
                                                        style='color:#188b2c; font-size:36px' data-toggle="tooltip"
                                                        data-placement="top" title="Add New Condition"></i></button>
                                            @endif
                                        </td>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div><br>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('eligibility.index') }}" class="btn btn-default">Back</a>
                </form>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Get the table element
            var table = $('#conditionTable').find('tbody');

            // Bind click event to the button
            $('#addRowBtn').click(function() {
                // Create a new row with three cells
                var newRow = $(
                    '<tr> <td><input type="number" class="form-control" placeholder="Minimum Mark %" name="minimumMarkPercentage[]"></td> <td> <select name="percentageCondition[]" id="" class="form-control" > <option value="">Select Condition</option> <option value="In Between">In Between</option></select> </td> <td><input type="number" class="form-control" placeholder="Maximum Mark %" name="maximumMarkPercentage[]"></td> <td><input type="number" class="form-control" placeholder="Amount in @lang('general.currency')" name="eligibleAmount[]"></td> <td> <button type="button" class="removeRowBtn"><i class="fa fa-minus-circle" style="color:red; font-size:36px" data-toggle="tooltip" data-placement="top" title="Remove The Condition"></i></button> </td> </tr>'
                );

                // Add the new row to the table
                table.append(newRow);

                // Bind click event to the "Remove" button of the new row
                newRow.find('.removeRowBtn').click(function() {
                    $(this).closest('tr').remove();
                });
            });

        });
    </script>
@endsection
