@extends('master.master')

@section('content_main')

    <blockquote>
        <p>Laravel Crud</p>
    </blockquote>
    <hr>
    @if(session('success'))
        <div class="alert alert-success" id="messages">
            {{session('success')}}
        </div>
    @endif

    @if($errors->any())
        <ul class="alert alert-danger" id="messages">
            @foreach($errors->all() as $value)
                <li>{{$value}}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{route('addUser')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}">
            <small class="text text-danger" id="messages">{{$errors->first('name')}}</small>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{old('email')}}">
            <small class="text text-danger" id="messages">{{$errors->first('email')}}</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control">
            <small class="text text-danger" id="messages">{{$errors->first('password')}}</small>
        </div>
        <div class="form-group">
            <label for="profile-img">Image</label>
            <input type="file" id="profile-img" name="upload">
            <small class="text text-danger" id="messages">{{$errors->first('upload')}}</small>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
        <textarea name="description" id="description" cols="20" rows="5" class="form-control">
{{old('description')}}
        </textarea>
            <small class="text text-danger" id="messages">{{$errors->first('description')}}</small>
        </div>
        <button class="btn btn-primary">Add User</button>
        <a href="{{route('viewUsers')}}" class="btn btn-success pull-right">View Users</a>
    </form>
@endsection
@section('content_aside')

    <img src="{{url('public/images/empty.jpg')}}" alt="image not found" id="profile-img-tag" class="img-responsive img-thumbnail"
         height="300" style="margin-top: 100px ;margin-left:80px">

@endsection