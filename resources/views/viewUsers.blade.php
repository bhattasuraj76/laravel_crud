@extends('master.master')

@section('content_main')

    <blockquote>
        <p>Laravel Crud</p>
    </blockquote>
    <hr>
    @if(session('success'))
        <div class="alert alert-danger" id="messages">
            {{session('success')}}
        </div>
    @endif
    @if($errors->any())
        <ul class="alert alert-success" id="messages">
            @foreach($errors->all() as $value)
                <li>{{$value}}</li>
            @endforeach
        </ul>
    @endif

    <table class="table table-hover table-bordered">`
        <tr>
            <th>S.N</th>
            <th>Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        @forelse($userData as $key=>$value)
            <tr>
                <td>{{++$key}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->email}}</td>
                <td><img src="{{url('public/images/'.$value->upload)}}" alt="not found" width="50"></td>
                <td>
                    <a href="{{route('editUser').'/'.$value->id}}" class="btn btn-primary btn-xs">Edit User</a>
                    <a href="{{route('deleteUser').'/'.$value->id}}" class="btn btn-danger btn-xs" onclick="return(confirm('are you aure to delete'))">Delete User</a>
                </td>
            </tr>
        @empty
        @endforelse
    </table>
    {{$userData->render()}}
    {{--or links()can be used--}}
    <hr>
    <a href="{{route('index')}}" class="btn btn-primary pull-right">Add User</a>
@endsection
