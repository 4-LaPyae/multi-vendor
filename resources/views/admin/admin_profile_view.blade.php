@extends('admin.admin_master')
@section('admin')
<div class="page-content">
<div class="container-fluid">
<div class="col-lg-6">       
    <!-- Simple card -->
    <div class="card">
        <img class="rounded avatar-lg" src="{{ (!empty(Auth::user()->profile_image))? asset('storage/'.Auth::user()->profile_image): asset('storage/profile_image.Preworkscreen COVID-19 Screening Default Avatar.png') }}" alt="" class="avatar-md rounded-circle">
        <div class="card-body">
            <h4 class="card-title">Name:{{ $user->name }}</h4>
            <hr>
            <h4 class="card-title">Email:{{ $user->email }}</h4>
            <hr>
            <a href="{{ route('edit.profile') }}" class="btn btn-info">Edit profile</a>
            <a href="{{ route('dashboard') }}" class="btn btn-info">Back</a>
        </div>
    </div>

</div>

@endsection