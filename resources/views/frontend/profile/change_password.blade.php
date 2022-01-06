@extends('frontend.main_master')

@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')

            <div class="col-md-2">

            </div>

            <div class="col-md-6">
                <br>
                <div class="card">
                    <h4 class="text-center"><strong>Change Password</strong></h4>
                    <div class="card-body create-new-account">
                        <form action="{{ route('user.password.update') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="current_password">Current Password</label>
                                <input type="password" id="current_password" name="oldpassword" class="form-control">
                                @error('oldpassword')
                                <span class=" invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password">New Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                                @error('password')
                                <span class=" invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                @error('password_confirmation')
                                <span class=" invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection