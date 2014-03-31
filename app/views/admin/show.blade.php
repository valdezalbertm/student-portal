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
                    <h1>Administrator <small>View</small></h1>

                    <!-- S: Breadcrumb -->
                    <ol class="breadcrumb">
                      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                      <li><a href="{{ route('prof.create') }}"><i class="fa fa-plus"></i> Instructor</a></li>
                      <li><a href="{{ route('stud.create') }}"><i class="fa fa-plus"></i> Student</a></li>
                      <li><a href="{{ route('admin.index') }}"><i class="fa fa-list"></i> List</a></li>
                      <li class="active"><i class="fa fa-pencil"></i> Show</li>
                    </ol>
                    <!-- E: Breadcrumb -->

                    <div class="table-responsive">

                        @include('include.error')

                      	<table class="table table-hover table-striped tablesorter">
                      	<!-- <table class="table table-hover tablesorter"> -->
        				<tr>
        					<td>Username:</td>
        					<td><strong>{{ $user->username }}</strong></td>
        				</tr>
        				<tr>
        					<td>Account Type</td>
        					<td><strong>Administrator</strong></td>
        				</tr>
        				<tr>
        					<td>Password:</td>
        					<td><strong>********************************</strong></td>
        				</tr>
        				<tr>
        					<td>Last Login:</td>
        					<td><strong>{{ $user->last_login }}</strong></td>
        				</tr>
        				</table>
        				<div align="center" class="col-lg-10">
        					<a href="{{ route('admin.edit', $user->id) }}" class='btn btn-warning'><i class="fa fa-lock"></i> Change Password</a>
        					<!-- <a href="{{ route('admin.delete', $user->id) }}" class='btn btn-info'><i class="fa fa-eraser"></i> Delete</a> -->
        				</div>
                    </div>
                </div>
            </div><!-- /.row -->

        </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    @include('include.javascript')
@stop