@php
$id = Auth::user()->id;
$user = App\Models\User::find($id);
@endphp
<div class="col-md-2"><br><br>
    <img src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg') }}" height="100%" width="100%" class="card-img-top" style="border-radius: 50%;">
    <div class="card" style="width: 18rem;"><br>
        <ul class="list-group list-group-flush">
            <li><a href="{{ route('dashboard') }}" class="list-group-item">Home</a></li>
            <li><a href="{{ route('user.profile') }}" class="list-group-item">Edit Profile</a></li>
            <li><a href="{{ route('change.password') }}" class="list-group-item">Change Password</a></li>
            <li><a href="{{ route('my.orders') }}" class="list-group-item">Orders</a></li>
            <li><a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block" style="margin-top: 10px;">Logout</a></li>
        </ul>
    </div>
</div>