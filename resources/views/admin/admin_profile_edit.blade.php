@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-content">
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Edit profile page</h2>
            <form action="{{ route('store.profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name" value="{{ $edituser->name }}" id="name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="email" name="email" value="{{ $edituser->email }}" id="eamil">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Profile image:</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" value="{{ $edituser->email }}" id="image" name="image">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <img class="rounded avatar-lg" src="{{ (!empty(Auth::user()->profile_image))? asset('storage/'.Auth::user()->profile_image): asset('storage/profile_image.Preworkscreen COVID-19 Screening Default Avatar.png') }}" alt="" class="avatar-md rounded-circle">
                    </div>
                </div>
                {{-- <div class="row mb-3">
                    {!! Form::label('Update Image:') !!}
                    {!! Form::file('buildingpics',array('onchange'=>'previewFile()','required')) !!}
                    <br/>
                    <img class="rounded avatar-lg" src="{{ asset('logo/jisoo.jpeg') }}" id="previewImg" style="height:300px; width:300px;" alt="">
                </div> --}}
                <input type="submit" value="Update Profile" class="btn btn-info wave-effect wave-light">
            </form>
            
        </div>
    </div>
<script type="text/javascript">
    // function previewFile() {
    // var preview = document.querySelector('#previewImg');
    // var file    = document.querySelector('input[type=file]').files[0];
    // var reader  = new FileReader();

    // reader.addEventListener("load", function () {
    //     preview.src = reader.result;
    // }, false);

    // if (file) {
    //     reader.readAsDataURL(file);
    //     }
    // }

    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#viewimage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0'])
        })
    })
</script>
@endsection