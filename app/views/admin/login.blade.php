@extends('layout')

@section('head')
    <title>User Login</title>

    <link href="{{ URL::asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/font-awesome/css/font-awesome.min.css') }}">
    <link href="{{ URL::asset('assets/css/signin.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/sb-admin.css') }}" rel="stylesheet">
@stop

@section('body')
    <div class="container">       
        {{ Form::open( ['method' => 'POST', 'route' => 'admin.login', 'class' => 'form-signin', 'role' => 'form'] ) }}
        <h2 class="form-signin-heading">Sign-in</h2>

       <!-- S: SHOW FORM VALIDATION ERRORS -->
        @if($errors->has() or Session::has('message'))
            <div class="alert alert-danger alert-dismissable fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ HTML::ul($errors->all()) }}
                {{ Session::get('message') }}
            </div>
        @endif
        <!-- E: SHOW FORM VALIDATION ERRORS -->

        <!-- S: prompt if login failed -->
        @if (Session::get('action') == 'LOGIN_FAILED')
            {{ Form::label('', 'Username/password did not match!', ['class' => 'input-block-level']) }}
        @endif
        <!-- E: prompt if login failed -->

        {{ Form::input('text', 'username', '' , ['class' => 'form-control', 'placeholder' => 'Username', 'required', 'autofocus']) }}
        {{ Form::input('password', 'password', '', ['class' => 'form-control', 'placeholder' => 'Password', 'required']) }}
        {{ Form::checkbox('remember', 'remember-me', ['class' => 'checkbox']) }} {{ Form::label('remember', 'Remember me') }}
        {{ Form::submit('Signin', ['class' => 'btn btn-lg btn-primary btn-block']) }}
      {{ Form::close() }}

    </div> <!-- /container -->
@stop