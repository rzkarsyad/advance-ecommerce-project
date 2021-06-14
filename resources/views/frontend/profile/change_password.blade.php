@extends('frontend.main_master')

@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2"><br><br>
                <img src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg') }}" height="100%" width="100%" class="card-img-top" style="border-radius: 50%;">
                <div class="card" style="width: 18rem;"><br>
                    <ul class="list-group list-group-flush">
                        <li><a href="{{ route('dashboard') }}" class="list-group-item">Home</a></li>
                        <li><a href="{{ route('user.profile') }}" class="list-group-item">Profile</a></li>
                        <li><a href="{{ route('change.password') }}" class="list-group-item">Change Password</a></li>
                        <li><a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block" style="margin-top: 10px;">Logout</a></li>
                    </ul>
                </div>
            </div>

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