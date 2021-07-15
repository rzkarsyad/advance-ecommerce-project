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
                    <h4 class="text-center"><span>Hi </span><strong>{{ Auth::user()->name }}!</strong> Welcome to Shinee Online Shop</h4>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection