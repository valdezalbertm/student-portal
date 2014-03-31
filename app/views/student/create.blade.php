@extends('layout')

@section('head')
    <title>{{ Session::get('account_type') }}</title>

    <!-- Bootstrap core CSS -->
    @include('include.css')
@stop

@section('body')
    <div id="wrapper">

        <!-- Sidebar -->
        @include('administrator.sidebar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Student <small>Register</small></h1>

                    <!-- S: Breadcrumb -->
                    <ol class="breadcrumb">
                      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                      <li><a href="{{ route('stud.list') }}"><i class="fa fa-list"></i> List</a></li>
                      <li class="active"><i class="fa fa-plus"></i> Create</li>
                    </ol>
                    <!-- E: Breadcrumb -->

                    @include('admin.prompt')

                    <div class="table-responsive">

                        @include('include.error')

                        <table class="table table-hover table-striped tablesorter">
                        <!-- <table class="table table-hover tablesorter"> -->
                        {{ Form::open( array('route' => 'stud.store', 'method' => 'POST', 'files'=> true, 'enctype' => 'multipart/form-data')) }}
                        <tr>
                            <td>{{ Form::label('studno', 'Student Number:') }}</td>
                            <td>{{ Form::input('text', 'studno', $key, ['class' => 'form-control', 'readonly' => 'readonly']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('account_type', 'Account Type:') }}</td>
                            <td>{{ Form::input('text', 'account_type', 'Student', ['class' => 'form-control', 'readonly' => 'readonly']) }} </td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('fname', 'First Name:') }}</td>
                            <td>{{ Form::input('text', 'fname', '', ['class' => 'form-control', 'autofocus']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('mi', 'Middle Name:') }}</td>
                            <td>{{ Form::input('text', 'mi', '', ['class' => 'form-control', 'size' => '2']) }} </td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('lname', 'Last Name:') }}</td>
                            <td>{{ Form::input('text', 'lname', '', ['class' => 'form-control']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('gender', 'Gender:') }}</td>
                            <td>
                                <div class="col-lg-2">
                                    {{ Form::radio('gender', 'Male', true) }} Male
                                </div>
                                <div class="col-lg-2">
                                    {{ Form::radio('gender', 'Female') }} Female
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> {{ Form::label('bday', 'Birthday:') }} </td>
                            <td>
                                <div class="col-lg-2">
                                    {{ Form::select('bdate', $bdate, '1', ['class' => 'form-control']) }}
                                </div>
                                <div class="col-lg-3">
                                    {{ Form::select('bmonth', $bmonth, '1', ['class' => 'form-control']) }}
                                </div>
                                <div class="col-lg-3">
                                    {{ Form::select('byear', $byear, '1990', ['class' => 'form-control']) }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('yr', 'Year Level:') }}</td>
                            <td>
                                {{ Form::select('yr', $yr, '1', ['class' => 'form-control']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('password1', 'Password:') }}</td>
                            <td>{{ Form::input('password', 'password1', '',['class' => 'form-control']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('password2', 'Verify Password:') }}</td>
                            <td>{{ Form::input('password', 'password2', '', ['class' => 'form-control']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('contact', 'Contact Number:') }}</td>
                            <td>{{ Form::input('text', 'contact', '', ['class' => 'form-control']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('email', 'E-mail Address:') }}</td>
                            <td> {{ Form::input('email', 'email', '', ['class' => 'form-control']) }} </td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('picture', 'Browse Picture:') }}</td>
                            <td>{{ Form::file('picture', ['class' => 'form-control']) }}</td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td>
                                {{ Form::submit('Create', ['class' => 'btn btn-success']) }}
                                {{ link_to('administrator', 'Cancel', ['class' => 'btn btn-default']); }}
                            </td>
                        </tr>
                        {{ Form::close() }}
                        </table>
                    </div>
                </div>
            </div><!-- /.row -->

        </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    @include('include.javascript')

@stop