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
                    <h4 class="text-center"><strong>Update Profile</strong></h4>
                    <div class="card-body create-new-account">
                        <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="phone">Phone Number</label>
                                <input type="number" id="phone" name="phone" class="form-control" value="{{ $user->phone }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="profile_photo_path">User Image</label>
                                <input type="file" id="profile_photo_path" name="profile_photo_path" class="form-control">
                                @error('profile_photo_path')
                                <span class="invalid-feedback" role="alert">
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