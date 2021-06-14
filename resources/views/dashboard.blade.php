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
                        <li><a href="{{ route('user.profile') }}" class="list-group-item">Edit Profile</a></li>
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
                    <h4 class="text-center"><span>Hi </span><strong>{{ Auth::user()->name }}!</strong> Welcome to Shinee Online Shop</h4>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection