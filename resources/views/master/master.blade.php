<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel Crud</title>
</head>
<link rel="stylesheet" href="{{url('public/bootstrap/css/bootstrap.css')}}">
<style>
    body{
        background: ghostwhite;
        top:0;
        margin:auto;
    }
    blockquote{
        margin:auto;
        text-align: center;
        color:red;
        border:2px solid coral;
        margin-top:5px;

    }
    textarea{
        resize: none;
    }
    td,th{
        text-align: center;
    }
</style>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            @yield('content_main')
        </div>
        <div class="col-md-2">

            @yield('content_aside')
        </div>
    </div>
</div>
<script src="{{url('public/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{url('public/bootstrap/js/jquery.js')}}"></script>
<script src="{{url('public/bootstrap/js/custom.js')}}"></script>
</body>
</html>