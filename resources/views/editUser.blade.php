@extends('master.master')

@section('content_main')

    <blockquote>
        <p>Laravel Crud</p>
    </blockquote>
    <hr>
    @if($errors->any())
        <ul class="alert alert-danger" id="messages">
            @foreach($errors->all() as $value)
                <li>{{$value}}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{route('editUserAction')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$userData->id}}">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{$userData->name}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{$userData->email}}">
        </div>
        <div class="form-group">
            <label for="profile-img">Image</label>
            <input type="file" id="profile-img" name="upload">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
        <textarea name="description" id="description" cols="20" rows="5" class="form-control">
            {{$userData->description}}
        </textarea>
        </div>
        <button class="btn btn-primary">Edit User</button>
        <a href="{{route('viewUsers')}}" class="btn btn-success pull-right">Back</a>
    </form>
@endsection
@section('content_aside')

    <img src="{{url('public/images/'.$userData->upload)}}" alt="image not found" id="profile-img-tag"
         class="img-responsive img-thumbnail" style="margin:100px 50px;">

@endsection