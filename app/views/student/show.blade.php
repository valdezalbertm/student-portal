@extends('layout')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

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
                    <h2>Student <small>View</small></h2>
                    <div class="table-responsive">

                        @include('include.error')
                        <center>
                            <img src="..\..\public\uploads\{{ $user->username }}.jpg" width="150" height="150" /><br /><br />
                        </center>

                        <table class="table table-hover table-striped tablesorter">
                        <!-- <table class="table table-hover tablesorter"> -->
                        <tr>
                            <td>Username:</td>
                            <td><strong>{{ $user->username }}</strong></td>
                        </tr>
                        <tr>
                            <td>Account Type</td>
                            <td><strong>Student</strong></td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td><strong>{{ $user->last_name }}, {{ $user->first_name }} y {{ $user->middle_name }}</strong></td>
                        </tr>
                        <tr>
                            <td>Gender:</td>
                            <td><strong>{{ $user->gender }}</strong></td>
                        </tr>
                        <tr>
                            <td>Birthday:</td>
                            <td><strong>{{ $user->birthdate }}</strong></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><strong>********************************</strong></td>
                        </tr>
                        <tr>
                            <td>Year Level:</td>
                            <td><strong>{{ $user->year_name }}</strong></td>
                        </tr>
                        <tr>
                            <td>Contact Number:</td>
                            <td><strong>{{ $user->contact }}</strong></td>
                        </tr>
                        <tr>
                            <td>E-mail Address:</td>
                            <td><strong>{{ $user->email }}</strong></td>
                        </tr>
                        </table>
                        <div align="center" class="col-lg-10">
                            <a href="{{ route('administrator.student.scholarship.index', $user->id) }}" class='btn btn-success'><i class="fa fa-certificate"></i> Scholarships</a>
                            <a href="{{ route('administrator.student.penalty.index', $user->id) }}" class='btn btn-default'><i class="fa fa-pencil"></i> Violations</a>
                            <a href="{{ route('stud.edit', $user->id) }}" class='btn btn-warning'><i class="fa fa-pencil"></i> Edit</a>
                            <a href="{{ route('stud.delete', $user->id) }}" class='btn btn-info'><i class="fa fa-eraser"></i> Delete</a>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->

        </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    @include('include.javascript')
@stop