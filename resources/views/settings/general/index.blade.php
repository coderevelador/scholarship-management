@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-9">
            <div class="card card-default">
                <div class="card-header">
                    <h2 class="mb-5">Change Logo</h2>
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-xl-4">
                            <div class="card card-default">
                                <div class="card-header align-items-center flex-column">
                                    <h3 class="h2 mb-2">Favicon</h3>
                                    <p class="text-center">It will appear in the browser tab </p>
                                </div>
                                
                                <div class="card-body d-flex flex-column" style="min-height: 150px">
                                    <form action="{{ route('general.update.details') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="favicon" class="form-control mb-2 mr-sm-2">
                                        @error('favicon')
                                            <span class="badge badge badge-danger ">{{ $message }}</span>
                                        @enderror
                                        <div class="d-flex justify-content-center mt-auto">
                                            <button class="btn btn-primary btn-pill">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xl-4">
                            <div class="card card-default">
                                <div class="card-header align-items-center flex-column">
                                    <h3 class="h2 mb-2">Logo</h3>
                                    <p class="text-center">Logo for the application </p>
                                </div>
                                <div class="card-body d-flex flex-column" style="min-height: 150px">
                                    <form action="{{ route('general.update.details') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="logo" class="form-control mb-2 mr-sm-2">
                                        @error('logo')
                                            <span class="badge badge badge-danger ">{{ $message }}</span>
                                        @enderror
                                        <div class="d-flex justify-content-center mt-auto">
                                            <button class="btn btn-primary btn-pill">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xl-4">
                            <div class="card card-default">
                                <div class="card-header align-items-center flex-column">
                                    <h3 class="h2 mb-2">Application Name</h3>
                                    <p class="text-center">Display application name</p>
                                </div>
                                <div class="card-body d-flex flex-column" style="min-height: 150px">
                                    <form action="{{ route('general.update.details') }}" method="POST">
                                        @csrf
                                        <input type="text" class="form-control mb-2 mr-sm-2" name="app_name"
                                            placeholder="{{ $appName[0] }}" value="{{ $appName[0] }}">
                                        @error('app_name')
                                            <span class="badge badge badge-danger ">{{ $message }}</span>
                                        @enderror
                                        <div class="d-flex justify-content-center mt-auto">
                                            <button class="btn btn-primary btn-pill">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


        </div>

    </div>
@endsection
